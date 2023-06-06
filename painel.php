<?php
include("conexao.php");
include("protect.php");


$cpf = $_SESSION['cpf'];
$sql_codigo_membros = "SELECT * FROM usuarios WHERE cpf = '$cpf'";
$sql_executar_membros = $mysqli->query($sql_codigo_membros);
$dadoss = $sql_executar_membros->fetch_assoc();

if ($dadoss['tipo'] == 2) {
    header("Location:painel-membro.php");
} elseif ($dadoss['tipo'] == 0) {
    header("Location: login.php");
}

if (isset($_POST['tipo_formulario'])) //verifica o tipo do formulario se sera o de formulario
    $tipo_formulario = $_POST['tipo_formulario'];// 1 adicionar membro, 2 mudar informações

if (isset($tipo_formulario) ) {
    if ($tipo_formulario  == 1) { //verifica se o formulario existe
    
        require 'adicionar_membro.php';
        if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
            $erros =  adicionarUsuario($_POST);
        }
    }
    
    if ($tipo_formulario == 2) { //verifica se o formulario existe
        
        require 'alterar_membro.php';
        if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
            $erros =  alterar($_POST);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        #foto3x4 {
            width: 3cm;
            height: 4cm;
            padding: 10px;
            display: inline-block;
            margin-bottom: 20px;
        }

        #lista {
            max-width: 80vw;

        }

        #cartao {
            padding-top: 50px;
            padding: 10px;
            display: inline-block;
            columns: 2;
            font-weight: bolder;
        }
    </style>
</head>

<body>
    <header>
        <ul class="nav justify-content-center" style="border: 1px solid black;">
            <li class="nav-item">
                <a class="nav-link active" href="#"><?php echo $_SESSION['nome'] ?></a>
            </li>
            <li class="nav-item">
                <a href="logout.php">sair</a>
            </li>
        </ul>
        <div class="row">
            <div class="col-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Seus membros</a>
                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Adicionar Membros</a>
                </div>
            </div>
            <div class="col-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <!-- DIGITAR AS LINHAS AQUI -->
                        <?php
                        $gestor = $_SESSION['email'];
                        $sql_codigo_membros = "SELECT * FROM membros WHERE gestor = '$gestor'";
                        $sql_executar_membros = $mysqli->query($sql_codigo_membros);
                        if ($sql_executar_membros->num_rows == 0) {
                        ?>
                            <h2>Nenhum membro cadastrado</h2>
                        <?php
                        } else {
                        ?>
                            <?php
                            while ($dados = $sql_executar_membros->fetch_assoc()) {
                                $foto = $dados['foto'];
                                $nome = $dados['nome'];
                                $CPF = $dados['cpf'];
                                $nascimento = $dados['data_nascimento'];
                                if ($dados['sexo'] == 1) {
                                    $sexo = "Masculino";
                                } else if ($dados['sexo'] == 2) {
                                    $sexo = "Feminino";
                                }

                                $data_conversao = $dados['data_conversao'];
                                $data_batismo_aguas = $dados['data_batism_aguas'];
                                $data_batismo_esp = $dados['data_batism_esp'];
                                if ($dados['situacao'] == 1) {
                                    $situacao = 'Em comunhão';
                                } else if ($dados['situacao'] == 2) {
                                    $situacao = 'Em disciplina';
                                } else {
                                    $situacao = "Sem informação";
                                }

                            ?>

                                <div id="lista">
                                    <?php echo "<img id=\"foto3x4\" src=\"$foto\" alt=\"\"> " ?>

                                    <ul id="cartao">

                                        <li>
                                            <p>
                                                Nome: <?php echo $nome ?>
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                CPF: <?php echo $CPF ?>
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                Data de nascimento: <?php echo $nascimento ?>
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                Sexo: <?php echo $sexo ?>
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                Data de conversão: <?php echo $data_conversao ?>
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                Data de Batismo nas águas: <?php echo $data_batismo_aguas ?>
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                Data de batismo com Espirito Santo: <?php echo $data_batismo_esp ?>
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                Situação: <?php echo $situacao ?>
                                            </p>
                                        </li>
                                    </ul>
                                    <!-- remover membro -->
                                    <?php

                                    ?>
                                    <form style="padding: 10px;" action="removermembro.php" method="post">
                                        <input type="hidden" name="remover" value="<?php echo $CPF ?>">
                                        <button type="submit" class="btn btn-primary">Remover membro</button>
                                    </form>
                                    <!--  -->

                                    <div class="dropdown">
                                        <button style="padding: 10px;" class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Mudar informações
                                        </button>
                                        <div style="padding: 10px;" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <form action="" enctype="multipart/form-data" method="post">
                                                <input type="hidden" name="tipo_formulario" value="2">
                                                <input type="hidden" name="fotoatual" value="<?php echo $foto ?>">
                                                <input type="hidden" name="gestor" value="<?php echo $gestor ?>">
                                                <input type="hidden" name="identificador" value="<?php echo $CPF ?>">

                                                <label for="novafoto"><strong>Nova Foto:</strong></label>
                                                <input type="file" name="novafoto" id="novafoto"> <br>

                                                <label for="novodatbatism"><strong>Batismo com espirito santo:</strong></label>
                                                <input type="date" name="novodatbatism" id="novodatbatism" value="<?php echo $data_batismo_esp ?>"> <br>

                                                <label for=""><strong>Situação:</strong></label>


                                                <label for="1">Em comunhão</label>
                                                <input type="radio" name="novasituacao" id="1" value="1" <?php echo ($dados['situacao'] == 1) ? 'checked' : ''; ?>>
                                                <label for="2">Em disciplina</label>
                                                <input type="radio" name="novasituacao" id="2" value="2" <?php echo ($dados['situacao'] == 2) ? 'checked' : ''; ?>> <br>


                                                <input type="submit" value="Atualizar">


                                            </form>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>

                    </div>
                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <!-- DIGITAR AS LINHAS AQUI -->
                        <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="tipo_formulario" value="1">
                            <ul>
                                <span class="text-danger"><?= isset($erros['arquivo']) ? $erros['arquivo'] : '' ?></span>
                                <li>
                                    <label for="foto"><strong>Foto 3x4:</strong></label>
                                    <input type="file" name="foto" id="foto">

                                </li>
                                <span class="text-danger"><?= isset($erros['nome']) ? $erros['nome'] : '' ?></span>
                                <li>
                                    <label for="nome"><strong>Nome:</strong></label>
                                    <input type="text" name="nome" id="nome">
                                </li>
                                <span class="text-danger"><?= isset($erros['cpf']) ? $erros['cpf'] : '' ?></span>
                                <li>
                                    <label for="cpf"><strong>CPF</strong></label>
                                    <input type="text" name="cpf" id="cpf">
                                </li>
                                <span class="text-danger"><?= isset($erros['nascimento']) ? $erros['nascimento'] : '' ?></span>
                                <li>
                                    <label for="aniversario"><strong>Data de Nascimento:</strong></label>
                                    <input type="date" name="aniversario" id="aniversario">
                                </li>
                                <span class="text-danger"><?= isset($erros['sexo']) ? $erros['sexo'] : '' ?></span>
                                <li>
                                    <p><strong>Sexo:</strong></p>
                                    <p>
                                        <label for="masculino">Masculino</label>
                                        <input type="radio" name="sexo" id="masculino" value="1">
                                    </p>
                                    <p>
                                        <label for="feminino">Feminino</label>
                                        <input type="radio" name="sexo" id="feminino" value="2">
                                    </p>

                                </li>
                                <span class="text-danger"><?= isset($erros['data_conversao']) ? $erros['data_conversao'] : '' ?></span>
                                <li>
                                    <label for="data_conversao"><strong>Data de conversão</strong></label>
                                    <input type="date" name="data_conversao" id="data_conversao">
                                </li>
                                <span class="text-danger"><?= isset($erros['data_batism_aguas']) ? $erros['data_batism_aguas'] : '' ?></span>
                                <li>
                                    <label for="data_batism_agua"><strong>Data de batismo nas águas:</strong></label>
                                    <input type="date" name="data_batism_agua" id="data_batism_agua">
                                </li>
                                <span class="text-danger"><?= isset($erros['data_batism_esp']) ? $erros['data_batism_esp'] : '' ?></span>
                                <li>
                                    <label for="data_batism_esp"><strong>Data de batismo com espirito santo:</strong></label>
                                    <input type="date" name="data_batism_esp" id="data_batism_esp">
                                </li>
                                <span class="text-danger"><?= isset($erros['situacao']) ? $erros['situacao'] : '' ?></span>
                                <li>
                                    <p><strong>Situação:</strong></p>
                                    <p>
                                        <label for="comunhão"><strong>Em comunhão</strong></label>
                                        <input type="radio" name="situacao" id="comunhao" value="1">
                                    </p>
                                    <p>
                                        <label for="disciplina"><strong>Em disciplina</strong></label>
                                        <input type="radio" name="situacao" id="disciplina" value="2">
                                    </p>
                                </li>
                            </ul>

                            <input type="submit" value="Enviar">


                        </form>

                    </div>
                    
                </div>
            </div>
        </div>
    </header>






</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Verifique se há uma seleção de aba armazenada no localStorage
        var selecaoAba = localStorage.getItem('selecaoAba');

        // Ativar a aba selecionada, se existir
        if (selecaoAba) {
            var abaAtiva = document.querySelector(selecaoAba);
            if (abaAtiva) {
                abaAtiva.classList.add('active');
                var conteudoAtivo = document.querySelector(abaAtiva.getAttribute('href'));
                if (conteudoAtivo) {
                    conteudoAtivo.classList.add('show', 'active');
                }
            }
        }

        // Armazenar a seleção da aba quando ela for clicada
        var abas = document.querySelectorAll('.nav-link');
        abas.forEach(function(aba) {
            aba.addEventListener('click', function(event) {
                event.preventDefault();

                // Remover classes 'active' e 'show' de todas as abas e conteúdos
                abas.forEach(function(aba) {
                    aba.classList.remove('active');
                });

                var conteudos = document.querySelectorAll('.tab-pane');
                conteudos.forEach(function(conteudo) {
                    conteudo.classList.remove('active', 'show');
                });

                // Adicionar classes 'active' e 'show' à aba e ao conteúdo selecionados
                this.classList.add('active');
                var conteudoSelecionado = document.querySelector(this.getAttribute('href'));
                if (conteudoSelecionado) {
                    conteudoSelecionado.classList.add('show', 'active');
                }

                // Armazenar a seleção da aba no localStorage
                var selecaoAbaId = '#' + this.getAttribute('id');
                localStorage.setItem('selecaoAba', selecaoAbaId);
            });
        });
    });
</script>


</html>