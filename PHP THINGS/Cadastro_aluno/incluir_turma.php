<html>
  <head>
    <title>Sistema de Cadastro de Turmas e Alunos</title>
    <meta charset="UTF-8">
  </head>
  <body>
    <h1>Inclusão de Alunos</h1>
    <?php
      $cod= $_REQUEST["codigo"];
      $curso = $_REQUEST["curso"];
      $semestre = $_REQUEST["semestre"];
      $ano = $_REQUEST["ano"];
      $conexao =  mysqli_connect('localhost','root','','turmas') or die("ERRO: Sem conexão.");
      $sql = "INSERT INTO ".
        "turma (cod, curso, semestre, ano) ".
        "VALUES ('$cod', '$curso', '$semestre', '$ano')";
      mysqli_query($conexao, $sql)
        or die("A inclusão falhou: ".
        mysqli_error($conexao). 
        "<br>SQL:". $sql);
      mysqli_close($conexao);
    ?>
    <h2>Cadastro realizado com sucesso!</h2>
    <a href="index.php">
      Voltar a página inicial!
    </a>
    <br />
