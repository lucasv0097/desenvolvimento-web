<html>
<head>
	<title>Upload de arquivo</title>
	<meta charset="utf-8">
	<?php include_once "funcoes.php"
	?>
</head>
<body>

<?php
	$tamanho_maximo = 100000; // em bytes
	$tipos_aceitos = array("image/gif","image/jpeg","image/png","image/bmp");
	// Valida o arquivo enviado
	$arquivo = $_FILES['ARQUIVO'];
	if($arquivo['error'] != 0) {
		echo '<p><b><font color="red">Erro no Upload do arquivo<br>';
		switch($arquivo['error']) {
		case  UPLOAD_ERR_INI_SIZE:
				echo 'O Arquivo excede o tamanho máximo permitido';
				break;
		case UPLOAD_ERR_FORM_SIZE:
				echo 'O Arquivo enviado é muito grande';
				break;
		case  UPLOAD_ERR_PARTIAL:
				echo 'O upload não foi completo';
				break;
		case UPLOAD_ERR_NO_FILE:
				echo 'Nenhum arquivo foi informado para upload';	
				break;
		}
		echo	'</font></b></p>';
	  	exit;
	}
	if($arquivo['size']==0 OR $arquivo['tmp_name']==NULL) {
		echo '<p><b><font color="red">Nenhum arquivo enviado
				</font></b></p>';
		exit;
	}
	if($arquivo['size']>$tamanho_maximo) {
		echo '<p><b><font color="red">O Arquivo enviado é muito grande
			(Tamanho Máximo = ' . $tamaho_maximo .	'</font></b></p>';
		exit;
	}
	if(array_search($arquivo['type'],$tipos_aceitos)===FALSE) {
		echo '<p><b><font color="red">O Arquivo enviado não é do tipo (' . 
				$arquivo['type'] . ') aceito para upload. 
				Os Tipos Aceitos São:	</font></b></p>';
		echo '<pre>';
		print_r($tipos_aceitos);
		echo '</pre>';
		exit;
	}
	// Copia o arquivo enviado
	$destino = 'C:\\xampp\\htdocs\\Upload_Arquivo\\Imagens\\'.$arquivo['name'];
	if(move_uploaded_file($arquivo['tmp_name'],$destino)) {
		// Mostramos  
		echo  '<p><font color="navy"><b>';
		echo 'O Arquivo foi carregado com sucesso!</b></font></p>';
		echo '<img src= "Imagens\\'.$arquivo['name']. '" border=0>';
	}
	else {
		echo '<p><b><font color="red">Ocorreu um erro durante o upload </font></b></p>';
	}
	$arquivo_img = $arquivo['name'];

	if(isset($_POST['enviar']) and $_POST['enviar'] == "CADASTRAR"){
		$con = conectarBd();

		$isbn = $_POST['isbn']; $titulo =($_POST['titulo']);

		$edicao = $_POST['edicao'];	$Categoria = $_POST['categoria'];
		
		$preco =$_POST['preco']; $anopub= $_POST['anopub'];

		$nome=$_POST['inp1']; $nac=$_POST['nac1'];

		$sql ="INSERT INTO livros (ISBN, TITULO, EDICAO, CATEGORIA, PRECO, ANOPUBLICACAO, IMAGEM) VALUES ('$isbn','$titulo','$edicao','$Categoria','$preco','$anopub', '$arquivo_img') ";

		$sqlautor ="INSERT INTO autores (NOME, NACIONALIDADE, ISBN_L)
		VALUES ('$nome', '$nac', '$isbn')";

		mysqli_query($con, $sql);

		mysqli_close($con);

		mysqli_query($con, $sqlautor);

		mysqli_close($con);
		/*dando erro ao cadastrar na tabela autores */
	}
			
?>
</body>
</html>