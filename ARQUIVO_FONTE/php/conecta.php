<?php
$servidor = 'localhost'; 
$user = 'root';
$password =  '';
$bd ='restaurante';

$conexao=mysqli_connect($servidor,$user,$password,$bd);
if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}

?>