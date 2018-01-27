<html>
  <head>
    <title>Sistema de Gerenciamento de Vendas</title>
    <meta charset="UTF-8">
  </head>
<body>
    <h1>Alteração de Clientes</h1>
    <?php
      $ra = $_REQUEST["ra"];
      $conexao = mysqli_connect('localhost', 'root', '', 'turmas') or die("ERRO: Sem conexão.");
      $sql = "SELECT nome, telefone, turma FROM aluno WHERE ra = '$ra'";
      $res = mysqli_query($conexao, $sql)
        or die("A consulta falhou: ". mysqli_error($conexao). "<br>SQL:". $sql);
      if ($campo = mysqli_fetch_array($res)) {
    ?>
    <form action="alterar_aluno.php" method="post">
      <p>
        RA: <input type="text" name="ra" 
          value="<?php echo $ra;?>"
          readonly />
      </p>
      <p>
        Nome: <input type="text" name="nome" 
          value="<?php echo utf8_encode($campo["nome"]);?>" />
      </p>
      <p>
        Telefone: <input type="text" 
          name="telefone" 
          value="<?php echo $campo["telefone"];?>" />
      </p>
      <p>
        Telefone: <input type="text" 
          name="turma" 
          value="<?php echo $campo["turma"];?>" />
      </p>
      <p><input value="Salvar" 
        type="submit" />
      </p>
    </form>
    <?php
      }
      mysqli_free_result($res); 
      mysqli_close($conexao);
    ?>
  </body>
</html>
