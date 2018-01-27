<!DOCTYPE HTML>
<html>
<head>
    <?php
        include_once "funcoes.php"; 
        complements();
        checkCookie();
    ?>
  <title>Livro: 
<?php
		if(isset($_COOKIE['login'])){
			$login = $_COOKIE['login'];
			$nome = $_COOKIE['nome'];
			$email = $_COOKIE['email'];
			$id = $_COOKIE['id'];
		}else{
			header("Location:index.php");
		}

		if(isset($login)){
			$dadosUsuario = "<p> Bem vindo: $nome </p>";
			$dadosUsuario .= "<p> E-mail: $email </p> ";
		}

	$c = conectarBd(); 
	$isbn = isset($_POST['isbn']) ? $_POST['isbn'] : "vazio";
	echo "isbn = $isbn";
	if($isbn == "vazio"){
		if(isset($_COOKIE['ISBN'])){
			$isbn = $_COOKIE['ISBN'];
		}
	}else{
		setcookie("ISBN", $isbn, (time()+600));
	}
	$buscaTitL = mysqli_query($c, "SELECT * FROM LIVROS L WHERE L.ISBN = $isbn ");
	if(mysqli_num_rows($buscaTitL) != 0){
		$r = mysqli_fetch_array($buscaTitL);
		echo $r['TITULO'];
	}
?> :: Bookhouse</title>
</head>
<body>
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
				<li style="color: #fff;padding:0;"> <?php echo $r['TITULO']; ?> </li><br>
				<h4>ISBN</h4>
				<li style="color: #fff;padding:0;"> <?php echo $r['ISBN']; ?>  </li><br>
				<h4>Autores</h4>
				<li style="color: #fff;padding:0;"> <?php
					$buscaAut = mysqli_query($c, "SELECT * FROM AUTORES WHERE ISBN_L = '".$isbn."'");
					if(mysqli_num_rows($buscaAut) == 0){
						echo "Livro sem autoria";
					}else{
						while($rAut = mysqli_fetch_array($buscaAut)){
							echo $rAut['NOME']." - ".$rAut['NACIONALIDADE']."<br>";
						}
					}
				?> </li><br>
				<h4>Categoria</h4>
				<li style="color: #fff;padding:0;"> <?php echo $r['CATEGORIA']; ?> </li><br>
				<h4>Edição</h4>
				<li style="color: #fff;padding:0;"> <?php echo $r['EDICAO']; ?> </li><br>
				<h4>Ano de Publicação</h4>
				<li style="color: #fff;padding:0;"> <?php echo $r['ANOPUBLICACAO']; ?> </li><br>
				<h4>Preço</h4>
				<?php $preco = str_replace(",","",$r['PRECO']); ?>
				<li style="color: #fff;padding:0;"> <?php echo "R$ ".number_format(floatval($preco),2,',','.'); ?> </li>
			</div>

		</div>
	</div>
</div>
<?php footer(); ?>
</body>
</html>

