<html>
  <head>
    <title>Sistema de Cadastro de Turmas e Alunos</title>
    <meta charset="UTF-8">
  </head>
  <body>
    <h1>Inclusão de Alunos</h1>
    <?php
      $ra= $_REQUEST["ra"];
      $nome = $_REQUEST["nome"];
      $telefone = $_REQUEST["telefone"];
      $turma = $_REQUEST["turma"];
      $conexao =  mysqli_connect('localhost','root','','turmas') or die("ERRO: Sem conexão.");
      $sql = "INSERT INTO ".
        "aluno (ra, nome, telefone, turma) ".
        "VALUES ('$ra', '$nome', '$telefone', '$turma')";
      mysqli_query($conexao, $sql)
        or die("A inclusão falhou: ".mysqli_error($conexao)."<br>SQL:". $sql);
      mysqli_close($conexao);
    ?>
    <h2>Cadastro realizado com sucesso!</h2>
    <a href="index.php">
      Voltar a página inicial!
    </a>
    <br />
