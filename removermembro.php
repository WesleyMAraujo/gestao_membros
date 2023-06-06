<?php 
include("conexao.php");
include("protect.php");
$cpfRemover = $mysqli->real_escape_string($_POST["remover"]);
$query = "DELETE FROM membros WHERE cpf = $cpfRemover";
$mysqli->query($query);
header("Location:painel.php");
