<?php 
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['email'])) { //verifica se a sessão existe
    die("Você não esta logado, portanto não pode acessar esta área <br> <a href=\"login.php\">Logar</a>");
}



