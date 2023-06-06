<?php
include("conexao.php");
include("protect.php");
$cpfRemover = $mysqli->real_escape_string($_POST["remover"]);

$query = "SELECT * FROM membros WHERE cpf = $cpfRemover";
$dados = $mysqli->query($query)->fetch_assoc();

$path = $dados['foto'];


if (file_exists($path)) {
    if (unlink($path)) {
    } 
} 

$query = "DELETE FROM membros WHERE cpf = $cpfRemover";
$mysqli->query($query);
header("Location:painel.php");
