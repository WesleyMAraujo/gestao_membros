<?php
include("conexao.php");

function checarUsuario($formulario)
{
    include("conexao.php");
    $email = $mysqli->real_escape_string($formulario["email"]);
    $senha = $mysqli->real_escape_string($formulario["senha"]);

    $tamanho_email = strlen($formulario['email']);
    $tamanho_senha = strlen($formulario['senha']);

     //verifica se os campos de email e senha estão vazios
     $erros = [];
     if ($tamanho_email == 0) {
         $erros['email'] = 'O campo de email esta vazio';
     } elseif ($tamanho_senha == 0) {
         $erros['senha'] = 'O campo de senha esta vazio';
     }
     //---------------------------------------------------

    //caso não tenha erros inicia a verificação do usuario
    if (!empty($erros)) return $erros;

    $sql_busca_usuario = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha'";
    $sql_executar_busca = $mysqli->query($sql_busca_usuario);
    $linhas = $sql_executar_busca->num_rows; //se usuario existir atribui 1 se não 0
    if ($linhas == 1) {
        $usuario = $sql_executar_busca->fetch_assoc();
        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['email'] = $usuario['email'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['cpf'] = $usuario['cpf'];


        if ($usuario['tipo'] == 1) {
            header("Location: painel.php");
        } else if ($usuario['tipo'] == 2) {
            header("Location: painel-membro.php");
        }
    } else {
        echo "Falha ao logar, Email ou senha incorretos";
    }

    header("Location: painel.php");
}
