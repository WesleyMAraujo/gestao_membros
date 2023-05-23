<?php 
include("conexao.php");

if (isset($_POST["email"]) || isset($_POST["senha"])) { //verifica se o formulario existe

    //impede que caracteres especiais burlem o sistema
    $email = $mysqli->real_escape_string($_POST["email"]); 
    $senha = $mysqli->real_escape_string($_POST["senha"]);
    //
    $tamanho_email = strlen($email);
    $tamanho_senha = strlen($senha);
    if ($tamanho_email == 0 && $tamanho_senha == 0) {
        echo "Preencha os campos de email e senha";
        
    } else if ($tamanho_senha == 0) {
        echo "O campo de senha esta vazio";
    } else if ($tamanho_email == 0) {
        echo "O campo do email esta vazio";
    } else {
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

                <div class="form-group"> <!-- Email -->
                    <label for="email">Endereço de email</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Seu email" name="email">
                    <small id="emailHelp" class="form-text text-muted">Use apenas informações fantasia, não coloque seus dados neste site, é apenas um projeto.</small>
                </div>

                <div class="form-group"> <!-- Senha -->
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control" id="senha" placeholder="senha" name="senha">
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