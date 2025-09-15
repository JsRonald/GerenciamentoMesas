<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/Login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <?php
    include "php/conecta.php";
    ?>
        <style>
body {
    background-image: url('ttcei.jpg');
    background-size: cover;
    background-position: center;
    margin: 0;
    height: 100vh;
    display: flex;
    flex-direction: column; /* Organiza os elementos em coluna */
    justify-content: center; /* Centraliza o conteúdo verticalmente */
    align-items: center; /* Centraliza horizontalmente */
}
    </style>
</head>
<body>
    <form action="form.php" method="post" id="formlogin" >
    <h4><i class="fa-solid fa-user"></i></h4>    
    <div id="Login">
            <label for="txtlogin"><h6>Login:</h6></label>
            <input type="text" name="txtlogin" placeholder="Login" required>
        </div>
        <div id="Password">
            <label for="txtpassword"><h6>Senha:</h6></label>
            <input type="password" name="txtpassword" placeholder="Senha" required>
        </div>
        <h6>Ainda não tem uma conta?<br> <a style="color:#c2792e;" href="cadastro.php">Criar Conta</a></h6><br>
        <div class="botoes">
        <button type="submit" style="border-radius: 15px;">Entrar</button>
        </div>   
    </form>
    
    <?php 
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Atribuição de dados do formulário com proteção contra SQL Injection
    $loginuser = mysqli_real_escape_string($conexao, $_POST['txtlogin']);
    $senhauser = mysqli_real_escape_string($conexao, $_POST['txtpassword']);

    // Verifica se os campos estão preenchidos
    if (!empty($loginuser) && !empty($senhauser)) {
        // Prepara consulta para verificar usuário
        $sql = "SELECT * FROM tbfuncionarios WHERE usuario = '$loginuser'";
        $comandosql = mysqli_query($conexao, $sql);

        // Verifica se o usuário existe
        if ($comandosql && mysqli_num_rows($comandosql) == 1) {
            $dadosbd = mysqli_fetch_assoc($comandosql);
            $passwordbd = $dadosbd['senha'];

            if ($dadosbd['permissao'] == 1) {
                // Verifica a senha
                if (password_verify($senhauser, $passwordbd)) {
                    // Regenera ID de sessão após login bem-sucedido
                    session_regenerate_id(true);
                    
                    // Armazena login na sessão e redireciona
                    $_SESSION['login'] = $dadosbd['usuario'];
                    $_SESSION['id'] = $dadosbd['codFun'];
                    $_SESSION['cargo'] = $dadosbd['cargo'];
                    header('Location: php/reset.php');
                    exit();
                } else {
                    echo "<div class='alert alert-danger text-center'>Senha inválida!</div>";
                }
            } else {
                echo "<div class='alert alert-warning text-center'>Usuário aguardando aprovação do administrador!</div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center'>Usuário não encontrado!</div>";
        }
    } else {
        echo "<div class='alert alert-info text-center'>Por favor, preencha todos os campos.</div>";
    }
}

?>

<footer>
    <p>&copy; 2024. Todos os direitos reservados.</p>
</footer>
</body>
</html>