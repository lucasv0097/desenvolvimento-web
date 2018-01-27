<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistema de Cadastro de Turmas e Alunos</title>
    </head>
    <body>
            <h1>Alunos Cadastrados</h1>
    <?php
      $conexao = mysqli_connect('localhost','root', '', 'turmas')or die("ERRO: Sem conexão.");
      $sql = "SELECT ra, nome, telefone FROM aluno";
      $res = mysqli_query($conexao, $sql)or die("A consulta falhou: ".mysqli_error($conexao). "<br>SQL:".$sql);
      echo "<table border='1'><tr>".
           "<td>&nbsp;</td><td>RA</td><td>Nome</td>".
            "<td>Telefone</td></tr>";
      while ($campo = mysqli_fetch_array($res)) {
        echo "<tr><td>".
        "<a href='editar_aluno.php?ra=".$campo["ra"].
        "'><img src='imagens/editar.jpg' width='15' height='15'></a>".
        "<a href='excluir_aluno.php?ra=".
        $campo["ra"].
        "'><img src='imagens/delete.png' width='15' height='15'></a>".
        "</td>".
        "<td>". $campo["ra"]. "</td><td>". 
        utf8_encode($campo["nome"]). "</td><td>". 
        $campo["telefone"]. "</td></tr>";
      }
      echo "</table>";
	 mysqli_free_result($res); 
      mysqli_close($conexao);
    ?>
    <br />
    <a href="cadastro_aluno.php">
      Cadastrar novo aluno...
    </a>
   

    </body>
</html>