<?php

function alterar($formulario)
{
    include("conexao.php");
    include("protect.php");

    $gestor = $formulario['gestor'];
    $cpf = $formulario['identificador'];
    $novafoto = $_FILES['novafoto'];
    $novaDatBatEsp = $formulario['novodatbatism'];
    $novaSituacao = $formulario['novasituacao'];

    $query = "SELECT * FROM membros WHERE gestor = '$gestor' and cpf = '$cpf'";
    $sql_query = $mysqli->query($query);
    $dados = $sql_query->fetch_assoc();

    if (strlen($novafoto['name']) == 0) {
        $mysqli->query("UPDATE membros SET situacao = '$novaSituacao', data_batism_esp = '$novaDatBatEsp' WHERE gestor = '$gestor' and cpf = '$cpf'");
    } else {
        if (file_exists($dados['foto'])) {
            if (unlink($dados['foto'])) {
            }
        }
        echo 'chegou errado';
        $arquivo = $_FILES["novafoto"]; //recebe o  novo arquivo
        $nomedoArquivo = $arquivo['name']; //revebe o nome do arquivo
        $extensao = strtolower(pathinfo($nomedoArquivo, PATHINFO_EXTENSION)); //recebe a extensão do arquivo
        $novoNome = uniqid(); // recebe o novo nome do arquivo 
        $pasta = 'fotos/'; //recebe a pasta onde vai ser salvo
        $path = $pasta . $novoNome . "." . $extensao; //recebe a pasta, o novo nome do arquivo e a extensão

        $erros = [];
        if ($extensao != "png" && $extensao != "jpg" && $extensao != "jpeg") //verifica o formato do arquivo
            $erros['foto'] = 'FORMATO DE ARQUIVO INVALIDO';

        if (!empty($erros)) return $erros;

        if (false == isset($erros[0])) {
            if (move_uploaded_file($arquivo["tmp_name"], $path)) { //move o arquivo para a pasta
                $mysqli->query("UPDATE membros SET foto = '$path', situacao = '$novaSituacao', data_batism_esp = '$novaDatBatEsp' WHERE gestor = '$gestor' and cpf = '$cpf'");

                //voltar para a pagina anterior
                header("Location: {$_SERVER['HTTP_REFERER']}");
                exit();
                //----------------------------------------------

            } else {
                $erros = 'FALHA AO ENVIAR O ARQUIVO ESCOLHA OUTRO';
                if (!empty($erros)) return $erros;
            }
        }
    }
}
