<?php 

echo 'chegou aq';
if (!isset($_SESSION)) {//cria uma sessao caso n exista
    session_start();
}
session_destroy();//destroi a sessao
header('location: login.php');//redireciona para a pagina de login
