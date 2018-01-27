<!DOCTYPE HTML>
<html>
<head>
<?php include "funcoes.php" ?>
<!-- CARREGANDO NOME DO LIVRO COMO TITULO DA PAGE-->
  <title>Livro: 
<?php
	if(isset($_COOKIE['login'])){
			$login = $_COOKIE['login'];
			$nome = $_COOKIE['nome'];
			$email = $_COOKIE['email'];
			$id = $_COOKIE['id'];
		}
		if(isset($login)){
			$dadosUsuario = "<p> Bem vindo: $nome </p>";
			$dadosUsuario .= "<p> E-mail: $email </p> ";
		}else{
			header("Location:index_1.php");
		}

	$c = conectarBD(); 
	$isbn = isset($_POST['isbn']) ? $_POST['isbn'] : "vazio";
	echo "isbn = $isbn";
	if($isbn == "vazio"){
		if(isset($_COOKIE['ISBN'])){
			$isbn = $_COOKIE['ISBN'];
		}
	}else{
		setcookie("ISBN", $isbn, (time()+360));
	}
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
				<li><a href="acervo.php">Voltar</a></li>
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
					<input type="submit" id="bntR" name="reservar" value="<?php echo seReservado($c, $isbn); ?>"/>
					<br><br>
					<script type="text/javascript">
                                            function verfReser(){
						var b = document.getElementById('bntR');
						if(b.value == "Livro Reservado"){
                                                	b.disabled = true;
						}
                                            }
					</script>
				</form>
				
<!--TRECHO PHP PARA CADASTRAR A RESERVA DO LIVRO-->
<?php 
	if(isset($_POST['reservar']) and $_POST['reservar'] == "Reservar livro"){
		$reservar = mysqli_query($c, "INSERT INTO RESERVADOS(ID_LIVRO, ID_USUARIO)VALUES($isbn, $id)")or die(mysqli_error());
		echo "<script> alert('Livro Reservado com Sucesso!');
		document.getElementById('bntR').value = 'Livro Reservado'; </script>";
	}
?>
				</div>
			
				<h4>Título do livro </h4> 
				<p> <?php echo $r['TITULO']; ?> </p><br>
				<h4>ISBN</h4>
				<p> <?php echo $r['ISBN']; ?>  </p><br>
				<h4>Autores</h4>
				<p> <?php
					$buscaAut = mysqli_query($c, "SELECT * FROM AUTORES WHERE ISBN_L = '".$isbn."'");
					while($rAut = mysqli_fetch_array($buscaAut)){
						echo $rAut['NOME']." - ".$rAut['NACIONALIDADE'];
					}
				?> </p><br>
				<h4>Categoria</h4>
				<p> <?php echo $r['CATEGORIA']; ?> </p><br>
				<h4>Edição</h4>
				<p> <?php echo $r['EDICAO']; ?> </p><br>
				<h4>Ano de Publicação</h4>
				<p> <?php echo $r['ANOPUBLICACAO']; ?> </p><br>
				<h4>Preço</h4>
				<?php $preco = str_replace(",","",$r['PRECO']); ?>
				<p> <?php echo "R$ ".number_format(floatval($preco),2,',','.'); ?> </p>
			</div>

			<div class="clearfix"></div>

		</div>
	</div>
</div>
<!-- FIM DA PÁGINA -->

<?php footer(); ?>

</body>
</html>

