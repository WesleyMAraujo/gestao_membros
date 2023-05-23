<?php
include("conexao.php");
include("protect.php");

$gestor = $_SESSION['email']; //recebe o usuario
/* $arquivo = $_FILES['foto']; */
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$data_nasc = $_POST['aniversario'];
$sexo = $_POST['sexo'];
$data_conv = $_POST['data_conversao'];
$data_batism_agua = $_POST['data_batism_agua'];
$data_batism_esp = $_POST['data_batism_esp'];
$situacao = $_POST['situacao'];

if (!isset($_FILES["foto"])) { //verifica se existe algo enviado no formulario
    $path = 'fotos/sem-foto.png';
    $mysqli->query("INSERT INTO membros VALUES('$gestor', '$path', '$nome', '$cpf', '$data_nasc', '$sexo', '$data_conv', '$data_batism_agua', '$data_batism_esp', '$situacao')");
    echo "Sucesso ao salvar arquivo";
} else {
    $arquivo = $_FILES["foto"]; //recebe o arquivo
    $nomedoArquivo = $arquivo['name']; //revebe o nome do arquivo
    $extensao = strtolower(pathinfo($nomedoArquivo, PATHINFO_EXTENSION)); //recebe a extensão do arquivo
    $novoNome = uniqid(); // recebe o novo nome do arquivo 
    $pasta = 'fotos/'; //recebe a pasta onde vai ser salvo
    if ($extensao != "png" && $extensao != "jpg" && $extensao != "jpeg") { //verifica o formato do arquivo
        die("FORMATO DE ARQUIVO INVALIDO");
    } else {
        $path = $pasta . $novoNome . "." . $extensao; //recebe a pasta, o novo nome do arquivo e a extensão
        if (move_uploaded_file($arquivo["tmp_name"], $path)) { //move o arquivo para a pasta
            $mysqli->query("INSERT INTO membros VALUES('$gestor', '$path', '$nome', '$cpf', '$data_nasc', '$sexo', '$data_conv', '$data_batism_agua', '$data_batism_esp', '$situacao')");
            echo "Sucesso ao salvar arquivo <br> <a href=\"painel.php\">Voltar ao painel</a>";
        } else {
            die("FALHA AO ENVIAR O ARQUIVO");
        }
    }
}
