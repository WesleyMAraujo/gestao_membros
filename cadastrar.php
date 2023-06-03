<?php
include("conexao.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') { //verifica se o formulario existe

    require 'autenticacao.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $erros = cadastrar($_POST);
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        #cadastrar {
            max-width: 600px;
            margin: auto;
        }
    </style>
</head>

<body>
    <main>
        <section id="cadastrar">
            <h1>Cadastrar</h1>
            <form action="" method="post">

                <div class="form-group"> <!-- Email -->
                    <span class="text-danger"><?= isset($erros['email']) ? $erros['email'] : '' ?></span>
                    <label for="email">Endereço de email</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Seu email" name="email">
                    <small id="emailHelp" class="form-text text-muted">Use apenas informações fantasia, não coloque seus dados neste site, é apenas um projeto.</small>
                </div>

                <div class="form-group"> <!-- Senha -->
                    <span class="text-danger"><?= isset($erros['senha']) ? $erros['senha'] : '' ?></span>
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control" id="senha" placeholder="senha" name="senha">
                </div>

                <div class="form-group"> <!-- CPF -->
                    <span class="text-danger"><?= isset($erros['cpf']) ? $erros['cpf'] : '' ?></span>
                    <label for="text">Seu CPF</label>
                    <input type="text" class="form-control" id="cpf" placeholder="CPF" name="cpf">
                    <small id="emailHelp" class="form-text text-muted">Use apenas informações fantasia, não coloque seus dados neste site, é apenas um projeto.</small>
                </div>

                <div class="form-group"> <!-- CPF -->
                    <span class="text-danger"><?= isset($erros['nome']) ? $erros['nome'] : '' ?></span>
                    <label for="text">Nome de Usuario</label>
                    <input type="text" class="form-control" id="nomeusuario" placeholder="Nome de Usuario" name="nomeusuario">
                    <small id="" class="form-text text-muted">Use apenas informações fantasia, não coloque seus dados neste site, é apenas um projeto.</small>
                </div>

                <span class="text-danger"><?= isset($erros['aniversario']) ? $erros['aniversario'] : '' ?></span>
                <label for="nascimento"><strong>Data de nascimento:</strong></label> <br>
                <input type="date" name="nascimento" id="nascimento">

                <span class="text-danger"><?= isset($erros['tipo']) ? $erros['tipo'] : '' ?></span>
                <p>Tipo de cadastro</p>
                <label for="pastor">Pastor</label>
                <input type="radio" name="tipo" id="pastor" value="1">
                <label for="membro">Membro</label>
                <input type="radio" name="tipo" id="membro" value="2">
                <br>
                
                <button type="submit" class="btn btn-primary">Cadastrar</button><!-- Enviar -->
                <button type="submit" class="btn btn-primary"><a href="login.php">Voltar ao login</a></button><!-- Enviar -->

            </form>
        </section>
    </main>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</html>