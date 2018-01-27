<!DOCTYPE html>
<html>
<head>
	<title>deletar Livro</title>
	<link rel="stylesheet" type="text/css" href="">
	<meta charset="utf-8">
</head>
<body>

</body>
</html>

<?php
	
	function conectarBd(){
		$con = mysqli_connect('localhost','root','','BdAcervo')or die (mysqli_error() + " <span class='erro'> Erro ao se conectar ao banco de dados! </span> ");
		return $con;
	}

	function deletar ($isbn){
		$con1 = conectarBd();

		$consultar = "SELECT * FROM RESERVADOS WHERE ID=$isbn";


		if(mysql_num_rows($consultar)>0){
			$deletar = "DELETE * FROM RESERVADOS WHERE ID_LIVRO=$isbn"; 
			mysql_query($con1,$deletar);
		}

		$deletar = "DELETE * FROM LIVROS WHERE ISBN=$isbn"; 
		mysql_query($con1,$deletar);
		}
	}

	function inserir($isbn, $titulo, $edicao, $categoria, $preco, $anopub, $img){
		$con1 = conectarBd();

			if($isbn != 0){
				$inserir = "INSERT INTO LIVROS VALUES($isbn, '$titulo', '$edicao', '$categoria', $preco, $anopun, $img)";
			mysql_query($con1, $inserir);
		}
	}

	function autor($con1, $isbn){
		$con1 = conectarBd();
		$autor = "INSERT INTO AUTORES VALUES(ID, ID_LIVRO, ID_USUARIO)";
	}

	function alterar($titulo, $edicao, $categoria, $preco, $anopub, $img){
		$con1 = conectarBd();

			$alterar = "UPDATE LIVROS SET titulo='$titulo' edicao='$edicao' categoria='$categoria' preco='$preco' anopublicacao='$anopub' imagem='$img' where isbn='$isbn";
	}
	function listuser(){
		$con = conectarBd();
		$user = "SELECT * from usuarios";
		mysqli_query($con, $user);
		
		while(mysqli_num_rows()>0){
			echo "usuario".$nome.;

		}

	}
	}

?>