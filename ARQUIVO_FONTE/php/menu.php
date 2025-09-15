<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        setInterval(function(){
            location.reload();
        }, 5000);
    </script>
</head>
<body> 
    <?php
// Exemplo de validação de permissão
session_start();

// onde "admin" é o administrador e "user" é um usuário comum
if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] !== 'Administrador'){
    echo '
    <header>
        <div class="header">
            <h1>Gerenciamento Mesas</h1>
            <div class="botoes">
                <a href="reset.php" class="btn">
                    <i class="fas fa-home"></i>
                </a>
                <a href="menu.php" class="btn">
                    <i class="fas fa-utensils"></i>
                </a>
                <form action="logout.php" method="post">
                    <button type="submit" class="btn">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </header>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card text-center shadow-lg" style="width: 28rem; border-radius: 1rem;">
            <div class="card-body">
                <h3 class="card-title text-danger mb-3">Acesso Negado 🚫</h3>
                <p class="card-text fs-5">
                    Você não tem permissão para acessar esta página.
                </p>
                <button style="border-radius: 15px; padding:20px;"><a style="text-decoration:none; color: black;"  href="reset.php">Voltar</a></button>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Sua Empresa. Todos os direitos reservados.</p>
    </footer>
    ';
    exit; // impede o restante da página de carregar
}
?>
    <header>
        <div class="header">
            <h1>Gerenciamento Mesas</h1>
            <div class="botoes">
                <a href="reset.php" class="btn">
                    <i class="fas fa-home"></i>
                </a>
                <a href="menu.php" class="btn">
                    <i class="fas fa-utensils"></i>
                </a>
                <form action="logout.php" method="post">
                    <button type="submit" class="btn">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <div class="grid">
        <div class="status">
            <center>
            <h1>Status das Mesas</h2><br>
            </center>
            <?php 
            include 'conecta.php';
            $sql = "SELECT * FROM tbmesas";
            $result = mysqli_query($conexao,$sql);
            if ($result && $result->num_rows > 0): 
                while($row = $result->fetch_assoc()): ?>
                    <div class="mesa">
                        <span style="font-weight:bolder;font-size:22px;">Mesa <?php echo $row['num_mesa']; ?>:</span>
                        <div class="cadeira cadeira1"></div>
                        <div class="cadeira cadeira2"></div>
                        <div class="cadeira cadeira3"></div>
                        <div class="cadeira cadeira4"></div>
                        <div class="status">
                            <center>
                            <?php if ($row['solicitado'] == 0): ?>
                                <span class="atendida">&#x1F7E2;</span>
                                <p>Mesa livre</p> 
                            <?php else: ?>
                                <span class="solicitada">&#x1F534;</span>
                                <p>Precisa atendimento</p> 
                            <?php endif; ?>
                            </center>
                        </div>
                    </div>
                <?php endwhile; 
            else: ?>
                <p>Nenhuma mesa encontrada.</p>
            <?php endif; ?>
        </div>

        <div class="historico">
            <center>
            <h1>Histórico</h2><br>
            </center>
            <?php 
            $sql= "SELECT * FROM tbmesas ORDER BY data_ultima";
            $executa= mysqli_query($conexao,$sql);
            if($executa){
                while($dados=mysqli_fetch_assoc($executa)){
                    if($dados['solicitado']== true){
                        echo "<center><p style='font-size: 28px; font-weight:bold; border-bottom:outset 1px '>Mesa " . $dados['num_mesa'] . "</p></center><br>";
                    }
                }
            }
            ?>
        </div>
    </div>
    <footer>
        <p>&copy; 2024. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
