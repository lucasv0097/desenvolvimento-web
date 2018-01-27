<html>
  <head>
    <title>Sistema de Cadastro de Turmas e Alunos</title>
    <meta charset="UTF-8">
  </head>
  <body>
    <h1>Exclusão de Aluno</h1>
    <?php
      $ra = $_REQUEST["ra"];
      $conexao = mysqli_connect('localhost','root', '', 'turmas') 
        or die("ERRO: Sem conexão.");
      $sql = "DELETE FROM aluno WHERE ra = '$ra'";
      mysqli_query($conexao, $sql)
        or die("A exclusão falhou: ".
        mysqli_error($conexao). "<br>SQL:".
        $sql);
      mysqli_close($conexao);
    ?>
    <h2>Aluno excluído com sucesso!</h2>
    <br />
    <a href="index.php">Voltar</a>
  </body>
</html>
