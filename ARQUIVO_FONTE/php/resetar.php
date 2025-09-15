<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesas Atendidas</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/fontawesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<style>
.hidden{
    opacity: 0;
    filter: blur(12px);
    transition: all 0.8s;
    transform: translateY(-100%);
}
.show{
    opacity: 1;
    filter: blur(0px);
    transition: all 0.8s;
    transform: translateY(0);
}
    </style>
<header class="header">
        <h1>Gerenciamento Mesas</h1>
        <div class="botoes">
            <form action="logout.php" method="post">
                <button type="submit" class="btn">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
 
            <a href="reset.php" class="btn" style="background:white">
                <i class="fas fa-utensils"></i>
            </a>
        </div>
    </header>
</div>
<?php


if(count( $_POST) > 0)
{
    include 'conecta.php';

    $num_mesa= $_POST['txtMesa'];
    $query1 = "SELECT * FROM tbmesas where num_mesa = '$num_mesa' ";
    $resultcomando = mysqli_query($conexao, $query1);
    if($resultcomando){
    $dados = mysqli_fetch_assoc($resultcomando);
    $boolean = $dados['solicitado'];

        if( $boolean == true){
        $query = "UPDATE tbmesas set solicitado = 'false'
        WHERE num_mesa = '$num_mesa'";
        $executar = mysqli_query($conexao , $query);
        /* PREENCHER TABELA PARA REGISTRO DE ATENDIMENTOS DO GARÇOM */
        session_start();
        $stmt = $conexao ->prepare("INSERT INTO tbatendimento(num_mesa,codFun) VALUES (?,?)");
        $stmt-> bind_param("ii",$num_mesa,$_SESSION['id']);
        $stmt-> execute();
        $stmt-> close();
        echo "<div class='alert alert-success hidden' role='alert' style='margin-top: 30px; text-align: center;'>A mesa agora está livre!</div>";
    } else {
        echo "<div class='alert alert-success hidden' role='alert' style='margin-top: 30px; text-align: center;'>A mesa já estava livre!</div>";
        }
    } else {
    echo "<div class='alert alert-danger hidden' role='alert' style='margin-top: 30px;text-align: center;>Mesa não encontrada!</div>";
        }
    }
?>
<center>
    <main>
    <form action="reset.php" method="post">
                <button type="submit" class="btn-res">
                    Voltar
                </button>
            </form>
    </main>
</center>

<footer>
    <p>&copy; 2024. Todos os direitos reservados.</p>
</footer>

<script>
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('show');
                } else {
                    entry.target.classList.remove('show');
                }
            });
        });

        document.querySelectorAll('.hidden').forEach((el) => observer.observe(el));
</script>