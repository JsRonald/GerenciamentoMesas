from flask import Flask, request, jsonify
import mysql.connector
from datetime import datetime

app = Flask(__name__)

# Configurações do banco de dados MySQL
db_config = {
    'user': 'root',
    'password': '',
    'host': '127.0.0.1',
    'database': 'restaurante',
    'raise_on_warnings': True
}

# Função para conectar ao banco de dados
def get_db_connection():
    return mysql.connector.connect(**db_config)

@app.route('/', methods=['GET'])
def home():
    return "Servidor Flask Online!", 200

@app.route('/api/receive_data', methods=['GET'])
def receive_data():
    solicitado = request.args.get('solicitado')
    num_mesa = request.args.get('num_mesa')

    if not solicitado or not num_mesa:
        return jsonify({
            "status": "error",
            "message": "Missing 'solicitado' or 'num_mesa' parameters"
        }), 400

    try:
        num_mesa = int(num_mesa)  # Valida se num_mesa é um número inteiro
    except ValueError:
        return jsonify({
            "status": "error",
            "message": "'num_mesa' must be an integer"
        }), 400

    try:
        # Conectar ao banco de dados
        conn = get_db_connection()
        cursor = conn.cursor()

        # Capturar data e hora atual
        data_solicitado = datetime.now()

        # Atualizar dados na tabela
        cursor.execute(
            'UPDATE tbmesas SET solicitado = %s, data_solicitado = %s WHERE num_mesa = %s',
            (solicitado, data_solicitado, num_mesa)
        )
        
        # Confirmar a transação
        conn.commit()

        # Verifica se alguma linha foi atualizada
        if cursor.rowcount == 0:
            return jsonify({
                "status": "error",
                "message": f"No record found for num_mesa = {num_mesa}"
            }), 404

        return jsonify({
            "status": "success",
            "message": f"Data updated for num_mesa = {num_mesa}",
            "solicitado": solicitado,
            "data_solicitado": data_solicitado.strftime('%Y-%m-%d %H:%M:%S')
        }), 200

    except mysql.connector.Error as err:
        print(f"Erro ao acessar o banco de dados: {err}")
        return jsonify({
            "status": "error",
            "message": f"Database error: {err}"
        }), 500

    finally:
        # Garante que a conexão seja fechada
        if 'cursor' in locals() and cursor:
            cursor.close()
        if 'conn' in locals() and conn:
            conn.close()

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
