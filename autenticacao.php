<?php


//checa se o usuario existe no sistema
function checarUsuario($formulario)
{
    include("conexao.php");

    //caracteres especiais não afetarão o sistema
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


    if (false == isset($erros[0])) // verificando se não ha erros
    {
        $sql_busca_usuario = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha'";
        $sql_executar_busca = $mysqli->query($sql_busca_usuario);
        $linhas = $sql_executar_busca->num_rows; //se usuario existir atribui 1 se não 0
        if ($linhas == 1) {
            $usuario = $sql_executar_busca->fetch_assoc();
            if (!isset($_SESSION)) {
                session_start();
            }

            //criando as sessoes
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
}


//função para cadastrar o usuario
function cadastrar($formulario)
{
    include("conexao.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $formulario['email'];
        $senha = $formulario['senha'];
        $cpf = $formulario['cpf'];
        $aniversario = $formulario['nascimento'];
        $nome = $formulario['nomeusuario'];

        if (isset($formulario['tipo'])) {
            $tipo = $formulario['tipo'];
        } else {
            $tipo = '';
        }


        $tamanho_email = strlen($email);
        $tamanho_senha = strlen($senha);
        $tamanho_nome = strlen($nome);
        $tamanho_cpf = strlen($cpf);
        $tamanho_aniversario = strlen($aniversario);
        $tamanho_tipo = strlen($tipo);

        $erros = [];
        if ($tamanho_email == 0) {
            $erros['email'] = 'O campo de email esta vazio';
        } else {
            $query = "SELECT * FROM usuarios WHERE email = '$email'";
            $sql_query = $mysqli->query($query);
            if ($sql_query->num_rows > 0)
                $erros['email'] = 'Este email ja esta em uso';
        }
        if ($tamanho_senha == 0)
            $erros['senha'] = 'O campo de senha esta vazio';

        if ($tamanho_nome == 0)
            $erros['nome'] = 'O campo de nome esta vazio';

        if ($tamanho_cpf == 0) {
            $erros['cpf'] = 'O campo de cpf esta vazio';
        } else {
            $query = "SELECT * FROM usuarios WHERE cpf = '$cpf'";
            $sql_query = $mysqli->query($query);
            if ($sql_query->num_rows > 0)
                $erros['cpf'] = 'Este cpf ja esta em uso';
        }



        if ($tamanho_aniversario == 0)
            $erros['aniversario'] = 'O campo de data de nascimento esta vazio';

        if ($tamanho_tipo == 0)
            $erros['tipo'] = 'O campo de tipo de cadastro esta vazio';

        if (!empty($erros)) return $erros;

        if (false == isset($erros[0])) {
            $mysqli->query("INSERT INTO `usuarios`(`nome`, `cpf`, `email`, `senha`, `tipo`, `data_nascimento`) VALUES ('$nome','$cpf','$email','$senha','$tipo','$aniversario')");
            header("Location:login.php");
        }
    }
}
