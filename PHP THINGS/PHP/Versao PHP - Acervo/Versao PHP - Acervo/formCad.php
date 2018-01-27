<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST" action="#">
		<input type="text" name="isbn">
		<input type="text" name="tt">
		<input type="text" name="ed">
		<input type="text" name="anop">
		<input type="text" name="categ">
		<input type="text" name="preco">
		<input type="submit" name="btn" value="Cadastrar">
	</form>
	<?php 
	function conectarBd(){
		$con = mysqli_connect('localhost','root','','BdAcervo')or die (mysqli_error() + " <span class='erro'> Erro ao se conectar ao banco de dados! </span> ");
		return $con;
		echo "bd conectado";
	}

	if(isset($_POST['btn']) and  $_POST['btn'] == "Cadastrar"){
		inserir();
	}

	function inserir() {
		$isbn = $_POST['isbn'];
		$titulo = $_POST['tt'];
		$edicao = $_POST['ed'];
		$categoria = $_POST['categ'];
		$preco = $_POST['preco'];
		$anopub = $_POST['anop'];
		$img = "img/nome.jpg";
		$con1 = conectarBd();

			$inserir = "INSERT INTO LIVROS (ISBN, TITULO, EDICAO, CATEGORIA, PRECO, ANOPUBLICACAO, IMAGEM)VALUES($isbn, '$titulo', '$edicao', '$categoria', '$preco', '$anopub', '$img')";
			mysqli_query($con1, $inserir);

			/*$autor = $_POST['nAut'];
			
			for($i=1; $i <= $autor; $i++){
					autor($con1, $isbn, $_POST['inp'. $i], $_POST['nac'.$i]);
			}*/
			echo "Livro cadastrado";
		
		mysqli_close($con1);
	}
	 ?>
</body>
</html>