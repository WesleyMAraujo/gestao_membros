<?php 
include("conexao.php");
include("protect.php");

$remover = $_POST["remover"];

$mysqli->query("DELETE FROM `membros` WHERE cpf LIKE $remover");

header("Location:painel.php");
