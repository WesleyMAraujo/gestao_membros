<?php 
//atribuindo as informações do banco de dados a variaveis
$host = 'localhost';
$user = 'root';
$pass = '';
$datab = 'getao_de_membros';

//criando um objeto mysqli e conectando usando a função mymysqli_connect().
$mysqli = mysqli_connect($host, $user, $pass, $datab);


//caso tenha algum erro acontece essa mensagem
if ($mysqli->errno) {
    die("Erro ao conectar ao banco de dados: $datab");
}




