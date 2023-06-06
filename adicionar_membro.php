<?php
/* include("conexao.php");
include("protect.php");

$gestor = $_SESSION['email']; //recebe o usuario */



function adicionarUsuario($formulario)
{
    include("conexao.php");
    include("protect.php");

    $gestor = $_SESSION['email']; //recebe o usuario

    $nome = $formulario['nome']; //recebe nome
    $data_nasc = $formulario['aniversario']; //recebe data
    $data_conv = $formulario['data_conversao']; //recebe data
    $data_batism_agua = $formulario['data_batism_agua']; //recebe data
    $data_batism_esp = $formulario['data_batism_esp']; //recebe data
    $arquivo = $_FILES["foto"]; //recebe o arquivo
    $cpf = $formulario['cpf']; //recebe cpf



    if (isset($formulario['situacao'])) {
        $situacao = $formulario['situacao'];
    } else {
        $situacao = '';
    }


    if (isset($formulario['sexo'])) {
        $sexo = $formulario['sexo'];
    } else {
        $sexo = '';
    }




    $erros = [];
    //verifica se as variaveis tem tamanho menor que 0, caso sim empilha um erro
    if (strlen($nome) == 0)
        $erros['nome'] = 'campo de nome vazio';
    if (strlen($cpf) == 0) {
        $erros['cpf'] = 'campo de cpf vazio';
    } else {
        //verifica se o cpf ja esta em uso
        $query = "SELECT * FROM membros WHERE cpf = '$cpf'";
        $sql_query = $mysqli->query($query);
        if ($sql_query->num_rows > 0)
            $erros['cpf'] = 'Este cpf ja esta em uso';

        $query = "SELECT * FROM usuarios WHERE cpf = '$cpf'";
        $sql_query = $mysqli->query($query);
        if ($sql_query->num_rows > 0)
            $erros['cpf'] = 'Este cpf ja esta em uso';
        //--------------------------------------------------     
    }
    if (strlen($data_nasc) == 0)
        $erros['nascimento'] = 'campo de data de nascimento vazio';
    if (strlen($sexo || !isset($sexo)) == 0)
        $erros['sexo'] = 'campo de sexo vazio';
    if (strlen($data_conv) == 0)
        $erros['data_conversao'] = 'campo de data de conversão vazio';
    if (strlen($data_batism_agua) == 0)
        $erros['data_batism_agua'] = 'campo de data de batismo nas aguas vazio';
    if (strlen($data_batism_esp) == 0)
        $erros['data_batism_esp'] = 'campo de data de batismo no espirito santo vazio';
    if (strlen($situacao) == 0)
        $erros['situacao'] = 'campo de situação vazio';
    if (strlen($arquivo['name'])  == 0)
        $erros['arquivo'] = 'campo de foto vazio';
    //------------------------------------------------------------------------------------

    if (!empty($erros)) return $erros; //caso exista erros retorna para o painel a variavel $erros para apresentar um span na tela

    if (false == isset($erros[0])) // se não existir ao menos um erro. equivalente a !empty($erros)
    {
        $nomedoArquivo = $arquivo['name']; //revebe o nome do arquivo
        $extensao = strtolower(pathinfo($nomedoArquivo, PATHINFO_EXTENSION)); //recebe a extensão do arquivo
        $novoNome = uniqid(); // recebe o novo nome do arquivo 
        $pasta = 'fotos/'; //recebe a pasta onde vai ser salvo

        if ($extensao != "png" && $extensao != "jpg" && $extensao != "jpeg" && $extensao != "") { //verifica o formato do arquivo

            $erros['foto'] = 'o formato de foto não é suportado'; //caso não seja um formato suportado retorna esse erro
            return $erros;
        } else {
            $path = $pasta . $novoNome . "." . $extensao; //recebe a pasta, o novo nome do arquivo e a extensão
            if (move_uploaded_file($arquivo["tmp_name"], $path)) { //move o arquivo para a pasta
                echo '<br>salvou a foto';
                $mysqli->query("INSERT INTO membros VALUES('$gestor', '$path', '$nome', '$cpf', '$data_nasc', '$sexo', '$data_conv', '$data_batism_agua', '$data_batism_esp', '$situacao')");
                header('Location: painel.php');
                exit();
            } else {
                $erros['foto'] = 'Tamanho de arquivo grande de mais';
                return $erros;
            }
        }
    }
}
