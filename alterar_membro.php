<?php
include("conexao.php");
include("protect.php");

$novaDatBatEsp = $_POST['novodatbatism'];
$novaSituacao = $_POST['novasituacao'];
$gestor = $_POST['gestor'];
$cpf = $_POST['identificador'];
$fotoAtual = $_POST['fotoatual'];

$sql_codigo_membros = "SELECT * FROM usuarios WHERE cpf = '$cpf'";
$sql_executar_membros = $mysqli->query($sql_codigo_membros);
$dados = $sql_executar_membros->fetch_assoc();

if (isset($_FILES['novafoto'])) {

    $arquivo = $_FILES["novafoto"]; //recebe o arquivo
    $nomedoArquivo = $arquivo['name']; //revebe o nome do arquivo
    $extensao = strtolower(pathinfo($nomedoArquivo, PATHINFO_EXTENSION)); //recebe a extensão do arquivo
    $novoNome = uniqid(); // recebe o novo nome do arquivo 
    $pasta = 'fotos/'; //recebe a pasta onde vai ser salvo



    if ($extensao != "png" && $extensao != "jpg" && $extensao != "jpeg") { //verifica o formato do arquivo

        if ($extensao == '') {
            $mysqli->query("UPDATE membros SET situacao = $novaSituacao, data_batism_aguas = $novaDatBatEsp WHERE gestor = '$gestor' and cpf = '$cpf'");
            header("Location: painel.php");
        }
    } else {
        $path = $pasta . $novoNome . "." . $extensao; //recebe a pasta, o novo nome do arquivo e a extensão
        if (move_uploaded_file($arquivo["tmp_name"], $path)) { //move o arquivo para a pasta
            $mysqli->query("UPDATE membros SET foto = '$path', situacao = '$novaSituacao', data_batism_aguas = '$novaDatBatEsp' WHERE gestor = '$gestor' and cpf = '$cpf'");
            if ($dados['tipo'] == 1) {
                header("Location: painel.php");
            } else {
                header("Location: painel.php");
            }
            
        } else {
            die("FALHA AO ENVIAR O ARQUIVO");
        }
    }
} 
