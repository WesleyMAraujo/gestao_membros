<?php 
if (!isset($_SESSION)) { //cria uma sessão caso ela não exista
    session_start();
}
if (!isset($_SESSION['email'])) { //verifica se a sessão existe
    header("Location: login.php");
}



