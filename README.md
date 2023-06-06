# gestao_membros

## login.php e cadastrar.php
1. adição da variavel $erros para empilhar os erros
2. adição de spans no html para erros no email ou senha
3. melhora no metodo de verificação do formulario usando ($_SERVER['REQUEST_METHOD'] == 'POST')
4. adição do arquivo autenticacao.php, com funções de checagem e cadastro de usuario
5. diminuição de redundancia de ifelse no codigo
6. verificação do cpf para não ser cadastrado outro cpf ou email igual
7. o formulario html identifica se é um formato de email valido

## painel.php e painel-membro.php
1. correção da navegação por abas usando java-script, agora quando a pagina é atualizada a aba continua ativada
2. correção do bug de remoção de usuario, não excluia o primeiro membro da tabela
3. verificação da chave primaria cpf para não se repetir
3. remoção de membros agora tambem remove os arquivos de foto

