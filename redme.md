## login.php e cadastrar.php
1. adição da variavel $erros para empilhar os erros
2. adição de spans no html para erros no email ou senha
3. melhora no metodo de verificação do formulario usando ($_SERVER['REQUEST_METHOD'] == 'POST')
4. adição do arquivo autenticacao.php, com funções de checagem e cadastro de usuario
5. diminuição de redundancia de ifelse no codigo

## painel.php e painel-membro.php
1. correção da navegação por abas usando java-script, agora quando a pagina é atualizada a aba continua ativada
2. correção de bugs no formulario, 