<?php
include("conexao.php");
include("protect.php");

$funcao = $_POST['funcao'];

if ($funcao == 0) {
    
}


function adicionar_membro(){
    include("conexao.php");
    $gestor = $_SESSION['email']; //recebe o usuario

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $data_nasc = $_POST['aniversario'];
    $sexo = $_POST['sexo'];
    $data_conv = $_POST['data_conversao'];
    $data_batism_agua = $_POST['data_batism_agua'];
    $data_batism_esp = $_POST['data_batism_esp'];
    $situacao = $_POST['situacao'];
    $arquivo = $_FILES["foto"]; //recebe o arquivo

    $erros = [];
    if (strlen($nome) == 0)
        $erros['nome'] = 'campo de nome vazio';
    if (strlen($cpf) == 0)
        $erros['cpf'] = 'campo de cpf vazio';
    if (strlen($data_nasc) == 0)
        $erros['nascimento'] = 'campo de data de nascimento vazio';
    if (strlen($sexo) == 0)
        $erros['data_conversao'] = 'campo de sexo vazio';
    if (strlen($data_conv) == 0)
        $erros['data_conversao'] = 'campo de data de conversão vazio';
    if (strlen($data_batism_agua) == 0)
        $erros['data_batism_agua'] = 'campo de data de batismo nas aguas vazio';
    if (strlen($data_batism_esp) == 0)
        $erros['data_batism_esp'] = 'campo de data de batismo no espirito santo vazio';
    if (strlen($situacao) == 0)
        $erros['situacao'] = 'campo de situação vazio';
    if ($arquivo == '')
        $erros['foto'] = 'campo de foto vazio';

    if (false == isset($erros[0])) // se não existir ao menos um erro. equivalente a !empty($erros)
    {
        
        $nomedoArquivo = $arquivo['name']; //revebe o nome do arquivo
        $extensao = strtolower(pathinfo($nomedoArquivo, PATHINFO_EXTENSION)); //recebe a extensão do arquivo
        $novoNome = uniqid(); // recebe o novo nome do arquivo 
        $pasta = 'fotos/'; //recebe a pasta onde vai ser salvo

        if ($extensao != "png" && $extensao != "jpg" && $extensao != "jpeg" && $extensao != "") { //verifica o formato do arquivo
            $erros['foto'] = 'o formato de foto não é suportado';
        }

        $path = $pasta . $novoNome . "." . $extensao; //recebe a pasta, o novo nome do arquivo e a extensão
        if (move_uploaded_file($arquivo["tmp_name"], $path)) { //move o arquivo para a pasta
            $mysqli->query("INSERT INTO membros VALUES('$gestor', '$path', '$nome', '$cpf', '$data_nasc', '$sexo', '$data_conv', '$data_batism_agua', '$data_batism_esp', '$situacao')");
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $erros['foto'] = 'Tamanho de arquivo grande de mais';
        }


    }
}
}

/* if (!isset($_FILES["foto"])) { //verifica se existe algo enviado no formulario
    $path = 'fotos/sem-foto.png';
    $mysqli->query("INSERT INTO membros VALUES('$gestor', '$path', '$nome', '$cpf', '$data_nasc', '$sexo', '$data_conv', '$data_batism_agua', '$data_batism_esp', '$situacao')");
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    $arquivo = $_FILES["foto"]; //recebe o arquivo
    $nomedoArquivo = $arquivo['name']; //revebe o nome do arquivo
    $extensao = strtolower(pathinfo($nomedoArquivo, PATHINFO_EXTENSION)); //recebe a extensão do arquivo
    $novoNome = uniqid(); // recebe o novo nome do arquivo 
    $pasta = 'fotos/'; //recebe a pasta onde vai ser salvo */


    

    /* if ($extensao == "") {
        $path = $pasta . "imagempadrao.png";
        $mysqli->query("INSERT INTO membros VALUES('$gestor', '$path', '$nome', '$cpf', '$data_nasc', '$sexo', '$data_conv', '$data_batism_agua', '$data_batism_esp', '$situacao')");
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        $path = $pasta . $novoNome . "." . $extensao; //recebe a pasta, o novo nome do arquivo e a extensão
        if (move_uploaded_file($arquivo["tmp_name"], $path)) { //move o arquivo para a pasta
            $mysqli->query("INSERT INTO membros VALUES('$gestor', '$path', '$nome', '$cpf', '$data_nasc', '$sexo', '$data_conv', '$data_batism_agua', '$data_batism_esp', '$situacao')");
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            die("FALHA AO ENVIAR O ARQUIVO");
        }
    } */

