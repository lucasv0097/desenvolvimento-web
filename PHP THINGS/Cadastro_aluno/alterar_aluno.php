<html>
  <head>
    <title>Sistema de Gerenciamento de Vendas</title>
    <meta charset="UTF-8">
  </head>
  <body>
    <h1>Alteração de Cliente</h1>
    <?php
      $ra = $_REQUEST["ra"];
      $nome = $_REQUEST["nome"];
      $telefone = $_REQUEST["telefone"];
      $turma = $_REQUEST["turma"];
      $conexao = mysqli_connect('localhost','root', '', 'turmas') 
        or die("ERRO: Sem conexão.");
      $sql = "UPDATE aluno SET nome = '$nome', ". "telefone = '$telefone', "."turma = '$turma' WHERE ra = '$ra'";
      mysqli_query($conexao, $sql)or die("A alteração falhou: ".
        mysqli_error($conexao). "<br>SQL:".$sql);
      mysqli_close($conexao);
    ?>
    <h2>Alteração realizada com sucesso!</h2>
    <br />
    <a href="relacao_aluno.php">Voltar</a>
  </body>
</html>

