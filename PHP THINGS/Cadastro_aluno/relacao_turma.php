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
      $sql = "SELECT cod, curso, semestre, ano FROM turma";
      $res = mysqli_query($conexao, $sql)or die("A consulta falhou: ".mysqli_error($conexao). "<br>SQL:".$sql);
      echo "<table border='1'><tr>".
           "<td>&nbsp;</td><td>Código</td><td>Curso</td>".
            "<td>Semestre</td><td>Ano</td></tr>";
      while ($campo = mysqli_fetch_array($res)) {
        echo "<tr><td>".
        "<a href='editar_turma.php?cod=". 
        $campo["cod"].
        "'><img src='imagens/editar.jpg' width='15' height='15'></a>".
        "<a href='excluir_turma.php?cpf=".
        $campo["cod"].
        "'><img src='imagens/delete.png' width='15' height='15'></a>".
        "</td>".
        "<td>". $campo["cod"]. "</td><td>". 
        utf8_encode($campo["curso"]). "</td><td>". 
        $campo["semestre"]."</td><td>".$campo["ano"]."</td></tr>";
      }
      echo "</table>";
	 mysqli_free_result($res); 
      mysqli_close($conexao);
    ?>
    <br />
    <a href="cadastro_turma.php">
      Cadastrar novo turma...
    </a>
   

    </body>
</html>