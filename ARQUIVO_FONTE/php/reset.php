<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesas Atendidas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <?php
    include "conecta.php";
    include "restrito.php";
    ?>
    <script>
    setInterval(function(){
        location.reload();
    },5000)
    </script>
</head>
<body>
<!--barraemcima-->
<header class="header">
        <h1>Gerenciamento Mesas</h1>
        <div class="botoes">
            <form action="logout.php" method="post">
                <button type="submit" class="btn">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
            <a href="menu.php" class="btn">
                <i class="fas fa-utensils"></i>
            </a>
            <a href="reset.php" class="btn">
                    <i class="fas fa-home"></i>
            </a>
        </div>
    </header>
<!--barraemcima--> 
    <main>
        <center>
        <h1>Status das Mesas</h2>
        </center>
        <div class="status">
    <?php 
    $sql = "SELECT * FROM tbmesas";
    $result = mysqli_query($conexao, $sql);
    if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="mesa <?php echo $row['solicitado'] == 0 ? 'atendida' : 'solicitada'; ?>">
                <span>Mesa <?php echo $row['num_mesa']; ?>:</span>
                <p>
                    <?php echo $row['solicitado'] == 0 ? 'Atendida' : 'Precisa atendimento'; ?>
                </p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Nenhuma mesa encontrada.</p>
    <?php endif; ?>
</div>
</div>
        <!--fomulariozinho-->
        <div class="formulario">
        <h5>Reset as mesas aqui</h5>
        <form action="resetar.php" method="post" id="mesareset">
    <div>
        <input type="text" placeholder="Digite o numero da mesa:" name="txtMesa" required>
    </div>
    <div class="center">    
        <button type="submit" class="btn-res">Resetar</button>
    </div>   
    </div>
    </form>
    </main>
    <footer>
    <p>&copy; 2024. Todos os direitos reservados.</p>
    </footer>
</body>
</html>


