<?php
include("conexao.php");

if ( $_SERVER['REQUEST_METHOD'] == 'POST') { //verifica se o formulario existe

    require 'autenticacao.php';
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        $erros = checarUsuario($_POST);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        #login {
            max-width: 600px;
            margin: auto;
        }
    </style>
</head>

<body>
    <header>

    </header>

    <main>
        <section id="login">
            <h1>Login</h1>
            <form action="" method="post">
                <span class="text-danger"><?= isset($erros['login']) ? $erros['login'] : '' ?></span>
                <div class="form-group"> <!-- Email -->
                    <label for="email">Endereço de email</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Seu email" name="email">
                    <small id="emailHelp" class="form-text text-muted">Use apenas informações fantasia, não coloque seus dados neste site, é apenas um projeto.</small>
                    <span class="text-danger"><?= isset($erros['email']) ? $erros['email'] : '' ?></span>
                </div>

                <div class="form-group"> <!-- Senha -->
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control" id="senha" placeholder="senha" name="senha">
                    <span class="text-danger"><?= isset($erros['senha']) ? $erros['senha'] : '' ?></span>
                </div>

                <button type="submit" class="btn btn-primary">Entrar</button><!-- Enviar -->
                <button type="button" class="btn btn-primary"><a style="text-decoration: none; color: white;" href="cadastrar.php">Cadastrar</a></button>
            </form>
        </section>
    </main>
    <footer>

    </footer>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</html>