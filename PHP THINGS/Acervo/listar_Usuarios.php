<!DOCTYPE HTML>
<html>
<head>
<title>Home :: Gamehouse</title>
<meta charset="utf-8">
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.0.min.js"></script>
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
<!-- MUDEI O NOME POR QUE OS ACENTO TAVA BUGADO NO MEU PC-->
<?php 
	include_once "funcoes.php"; 
	/*IF RESPONSAVEL POR VERIFICAR SE O COOKIE DO ADM ESTA ATIVO, SE TIVER MANTEI O ACESSO DISPONIVEL SE NAO REDIRECIONA PARA INDEX_1.PHP*/
	if(isset($_COOKIE['adm']) ){
				
	}else{
		header("Location:index_1.php");	
	}
?>

</head>
<body>

v<!--INICIO CABECALHO-->
<div class="header">
	<div class="container">
	
		<div class="logo">
		</div>
		<span class="menu"></span>
		<div class="navigation">
			<ul class="navig cl-effect-3" >
				<li><a href="adm_home.php">Home</a></li>
			</ul>
			<div class="clearfix"></div>
			<script>
				$( "span.menu" ).click(function() {
				  $( ".navigation" ).slideToggle( "slow", function() {
				    // Animação do menu.
				  });
				});
			</script>

		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!--FIM CABECALHO-->

<!-- Games Page Starts here -->
<div class="games">
	<div class="container">
		<div class="contact">
	<table class="usuarios">
		<tr class='headeruser'>
			<td>Nome</td>
			<td> email</td>
			<td> login</td>
			<td> senha </td>
		</tr>
	</table>
		<?php  
		/* TRECHO PHP QUE LISTA OS USUARIOS CADASTRADOS*/
			$con = conectarBd();
			$sqlUsuarios = mysqli_query($con, "SELECT*FROM USUARIOS");
			while($us = mysqli_fetch_array($sqlUsuarios)){
				echo "<form method='post' action='alteracoes_Usuario.php' onclick='submit()'> ";
				echo "<table class='usuarios'>";
				echo "<tr class='rowuser'>";
				echo "<td>". $us['NOME'] . "</td>"; 
				echo "<td>". $us['EMAIL'] . "</td>"; 
				echo "<td>". $us['LOGIN'] . "</td>"; 
				echo "<td> ******** </td>"; 
				echo "</table>";
				echo "<input type='hidden' name='idU' value='".$us['ID']."'>";
				echo "</form>";
			}
		?>		
	

				</div>
			</div>
		</div>
<?php footer(); ?>
</body>
</html>