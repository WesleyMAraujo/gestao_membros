<?php 
$host = 'localhost';
$user = 'root';
$pass = '';
$datab = 'getao_de_membros';

$mysqli = mysqli_connect($host, $user, $pass, $datab);

if ($mysqli->errno) {
    die("Erro ao conectar ao banco de dados: $datab");
} else {
    /* echo "conexão bem sucessida no banco de dados: <strong>$datab</strong> <br>";
    echo "<a href=\"index.php\">voltar</a>"; */
}
?>



