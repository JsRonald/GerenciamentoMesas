<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/cadastroi.css?v=1.1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body{
            background-image: url('ttcei.jpg');
            background-size: cover;  /* Faz a imagem cobrir toda a tela */
            background-position: center; /* Centraliza a imagem */
            margin: 0;
            height: 100vh;
        }
    </style>
</head>
<body>
    <header>

    </header>

    <main>
    <form action="cadastro.php" method="post" id="formlogin" >
        <h4><i class="fa-solid fa-user"></i></h4>
        <h5>Crie sua conta aqui</h5>
        <div id="nome" >
            <label for="txtNome"><h6>Nome:</h6></label>
            <input placeholder="Coloque seu nome completo aqui" type="text" name="txtNome" required>
        </div>
        <div id="usuario">    
            <label for="txtUsuario"><h6>Nome de usuario:</h6></label>
            <input placeholder="Coloque seu login aqui" type="text" name="txtUsuario" required>
        </div>
        <div id="cargo">    
            <label for="txtCargo"><h6>Cargo:</h6></label>
            <input  placeholder="Coloque seu cargo aqui" type="text" name="txtCargo" required>
        </div>
        <div id="Password">
            <label for="txtpassword"><h6>Senha:</h6></label>
            <input  placeholder="Coloque seu sua senha aqui" type="password" name="txtpassword" required>
        </div>
        <h6>Já tem uma conta? <a style="color:#c2792e;" href="form.php">Entrar</a></h6><br>
        <button type="submit" style="border-radius: 15px;">Criar conta</button>
        <button style="border-radius: 15px;"><a style="text-decoration:none; color: white;"  href="form.php">Voltar</a></button>
    </form>
    </main>

<?php
    include 'php/conecta.php';
    ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = $_POST['txtNome'];
    $usuario = $_POST['txtUsuario'];
    $cargo = $_POST['txtCargo'];
    $senha = password_hash($_POST['txtpassword'],PASSWORD_DEFAULT);
    $permissao = '0';   
    $sqlcheck= "SELECT * FROM tbfuncionarios WHERE usuario = '$usuario'";
    $comandocheck= mysqli_query($conexao, $sqlcheck);
    if(mysqli_num_rows($comandocheck)==0){
    $sql ="INSERT INTO `tbfuncionarios`( `nome`, `cargo`, `usuario`, `senha`, `permissao`) VALUES ('$nome','$cargo','$usuario','$senha','$permissao')";
    $comando= mysqli_query($conexao , $sql);
        if ($comando){ 
            echo '
            <center>
            <div class="alert alert-success" role="alert">
            Usuario Cadastrado, Aguardando aprovação do administrador!
            </div>

            <center>';}
        else {
            echo '<center>
        <div class="alert alert-danger" role="alert">
        Falha ao cadastrar
        </div>

        <center>';
        }
    }
    else{
        echo '<center>
        <div class="alert alert-danger" role="alert">
        Usuario ja existe, tente novamente!!
        </div>
        <center>';
    }
}

?>
<footer>
    <p>&copy; 2024. Todos os direitos reservados.</p>
</footer>
</body>
</html>