<!DOCTYPE html>
<html>
<head>
		<?php 
	function conectarBd(){
		$con = mysqli_connect('localhost','root','','BdAcervo')or die (mysqli_error() + " <span class='erro'> Erro ao se conectar ao banco de dados! </span> ");
		return $con;
}?>
	<title>Livro: 
<?php

	/**/ $c = conectarBD(); 
	$isbn = isset($_POST['isbn']) ? $_POST['isbn'] : "vazio";

	if($isbn == "vazio"){
		if(isset($_COOKIE['ISBN'])){
			$isbn = $_COOKIE['ISBN'];
		}
	}else{
		setcookie("ISBN", $isbn, (time()+360));
	}
	$isbn = 7;
	echo "<br> isbn final $isbn";
	$buscaTitL = mysqli_query($c, "SELECT * FROM LIVROS L WHERE L.ISBN = $isbn ");
	if(mysqli_num_rows($buscaTitL) != 0){
		$r = mysqli_fetch_array($buscaTitL);
		echo $r['TITULO'];
	}	
	function seReservado($c, $isbn){
		
		$rs = mysqli_query($c, "SELECT * FROM RESERVADOS WHERE ID_LIVRO = $isbn");
		if(mysqli_num_rows($rs) == 0){
			return "Reservar livro";
		}else{
			return "Livro Reservado";
		}
	}

?></title>

</head>
<body>
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
</head>
<body>

<!-- INÍCIO DO CABEÇALHO -->
<div class="header">
	<div class="container">
		<span class="menu"></span>
		<div class="navigation">
			<ul class="navig cl-effect-3" >
				<li><a href="../index.html">Home</a></li>
				<li> <?php  echo $nome; ?> </li>
				<li> E-mail: <?php  echo $email; ?></li>
			</ul>
			<div class="clearfix"></div>

		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- FIM DO CABEÇALHO -->	

<!-- COMEÇO DA PÁGINA -->
<div class="games">
	<div class="container">
		<div class="blog-content">
			<div class="contact-box">
				<br><br>
				<figure>
				<!--IMAGEM DO LIVRO SELECIONADO-->
					<IMG src=" <?php echo $r['IMAGEM']; ?> " width="500px" height="650px">
				</figure>
			</div>
<!--DADOS DO LIVRO SELECIONADO-->
			<div class="blog-sidebar">
				<br><br>
				<div class="text-but">
				<form method="post" onload="verfReser()">
					<!--variável-->
					<input type="submit" name="alterar" value="alterar">
					<input type="submit" name="deletar" value="deletar">

					<br><br>

					<script type="text/javascript">
						function verfReser(){
							var b = document.getElementById('bntR');
							if(b.value == "Livro Reservado"){
								b.disabled = true;
							}
						}
					</script>
				
				</div>
			
				<h4>Título do livro </h4> 
					<p> <input type="text" name="titulo" value="<?php echo $r['TITULO']; ?>"></p><br>

				<h4>ISBN</h4>
					<p> <input type="text" name="isbn" value="<?php echo $r['ISBN']; ?>" disabled="true"></p><br>
				
				<h4>Autores</h4>
					<?php gerarAut($c, $isbn) ?>
				
				<?php 
					if (isset($_POST['deletar']) and $_POST['deletar'] == "deletar") {
						deletar($isbn);
					}

				function deletar ($isbn){
					$con1 = conectarBd();
					$consultarRe = mysqli_query($con1, "SELECT * FROM RESERVADOS WHERE ID_LIVRO=$isbn");
					echo $isbn;
					if(mysqli_num_rows($consultarRe)>0){
						$deletar = "DELETE FROM RESERVADOS WHERE ID_LIVRO = $isbn"; 
						mysqli_query($con1,$deletar);
					}

					$consultarAut = mysqli_query($con1, "SELECT * FROM AUTORES WHERE ISBN_L = $isbn");

					if(mysqli_num_rows($consultarAut)>0){
						$deletar = "DELETE FROM AUTORES WHERE ISBN_L = $isbn"; 
						mysqli_query($con1,$deletar);
					}

					$deletar = "DELETE FROM LIVROS WHERE ISBN = $isbn"; 
					mysqli_query($con1,$deletar);
					echo "livro deletado";

					/*REDIRECIONAR PARA PAGINA DE CONSULTA QNDO CRIA-LA
					header("Location:consultaadm.php");*/
				}
				

				function gerarAut($c, $isbn){
					$buscaAut = mysqli_query($c, "SELECT * FROM AUTORES WHERE ISBN_L = '".$isbn."'");
					$i =1;
					while($rAut = mysqli_fetch_array($buscaAut)){
						echo "<p> <input type='text' name='inp$i' value=".$rAut['NOME']."> </p>"
						;
						echo "<select name='nac$i'>";
						if($rAut['NACIONALIDADE'] == "Brasileiro"){
							echo "<option selected> Brasileiro </option>";
							echo "<option> Estrangeiro </option>";
						}else{
							echo "<option selected> Estrangeiro </option>";
							echo "<option> Brasileiro </option>";
						} 
						echo "</select>";
						$i++;

					}
				} ?>
				
				
				<h4>Categoria</h4>
					<p> <input type="text" name="Categoria" value="<?php echo $r['CATEGORIA']; ?>"></p><br>
				
				<h4>Edição</h4>
					<p> <input type="text" name="edicao" value="<?php echo $r['EDICAO']; ?>"></p><br>

				<h4>Ano de Publicação</h4>
					<p> <input type="text" name="anopublicacao" value="<?php echo $r['ANOPUBLICACAO']; ?>"></p><br>
				
				<h4>Preço</h4>
					<p> <input type="text" name="preco" value=" <?php echo "R$ ".number_format(floatval($preco),2,',','.'); ?> "></p><br>

				<?php /*function convNum($num){
					if($num=="")$num=0;
					else{
						$num=str_replace(".","",$num);
						$num=str_replace(",",".",$num);
						$num=str_replace("R$ ","",$num);
					}
					$num=number_format($num,2);
					return $num;
				}*/
				?>
				
			</form>
			</div>

			<div class="clearfix"></div>

		</div>
	</div>
</div>
<!-- FIM DA PÁGINA -->

<!-- INÍCIO DO RODAPÉ -->
<div class="footer">
	<table class="center">
		<tr>
			<td align="right">
				<a href="http://www.fatecjd.edu.br/site"><img src="fatec_logo.png" alt="Logo FATEC" width="158px" height="78px"></a>
			</td>
			<td>
				<span>
					FATEC Jundiaí Deputado Ary Fossen<br>
					Av. União dos Ferroviários, 1760<br>
					Ponte de Campinas, Jundiaí - SP<br>
					Telefone: +55 (11) 4321-1234<br>
					E-mail: fatec@fatec.com<br>
				</span>
			</td> 
		</tr>
	</table>
</div>
</body>
</html>