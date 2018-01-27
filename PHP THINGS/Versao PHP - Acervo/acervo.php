<!DOCTYPE HTML>
<html>
<head>
<title>Acervo :: Gamehouse</title>
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

<!-- CARREGA AS INFORMAÇÕES COM OS COOKIES -->
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
			header("Location:index.php");
		}

		function Encerrar(){
			setcookie('login');
			header("Location:index.php");
		}
		if(isset($_POST['encerrar']) and $_POST['encerrar'] == "Sair"){
			Encerrar();
		}
		function conectarBd(){
		$con = mysqli_connect('localhost','root','','BdAcervo')or die (mysqli_error() + " <span class='erro'> Erro ao se conectar ao banco de dados! </span> ");
		return $con;
	}
	function seReservado($c, $isbn){
		
		$rs = mysqli_query($c, "SELECT * FROM RESERVADOS WHERE ID_LIVRO = $isbn");
		if(mysqli_num_rows($rs) == 0){
			return "Disponível";
		}else{
			return "Já Reservado";
		}
	}
	?>

</head>
<body>

<!-- INÍCIO DO CABEÇALHO -->
<div class="header">
	<div class="container">
		<span class="menu"></span>
		<div class="navigation">
			<ul class="navig cl-effect-3" >
				<li><a href="index.html">Home</a></li>
				<li>Bem Vindo! <?php  echo $nome; ?> </li>
				<li> E-mail: <?php  echo $email; ?></li>
			</ul>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- FIM DO CABEÇALHO -->	

<!-- Games BOOK Starts here -->
<div class="games">
	<div class="container">
		<div class="main">
			<br>
			<div class="loginbox">
				<form method="post">
					<div class="text">
						<input class="login" type="submit" value="pesquisar" style="width: 140px;" name="buscarCat" />
						<input class="login" name="pesquisarCat" type="text" placeholder="Insira a categoria desejada aqui" style="width: 650px;margin-right: 25px;" required list="list-Categ" />
						<datalist id="list-Categ">
							<?php 
							$c = conectarBd();
							$buscaCategs = mysqli_query($c, "SELECT CATEGORIA FROM LIVROS");
							while ($rCateg = mysqli_fetch_array($buscaCategs)) {
								echo "<option value = '". $rCateg['CATEGORIA'] ."'>";	
							}
						?>
						</datalist>
						
						<span class="login" style="margin-right: 25px;">Filtro de <font color="#68BEED">
						<strong id="cad">Categoria</strong></font></span>
				  </div>
				</form>
			</div>
			<br><br><br>

			<h3 id="destaques" class="page-header">Categoria: <?php echo filtroPesquisado(); ?></h3>

<!--TRECHO PHP QUE GERAR AS DIVIS COM OS CONTEUDOS DO BANCO DE DADOS-->
<?php
	if(isset($_POST['buscarCat']) and $_POST['buscarCat'] == "pesquisar"){
		$categoria = $_POST['pesquisarCat'];
		$con = conectarBd();
		//$sql = mysqli_query($con, "SELECT * FROM LIVROS WHERE CATEGORIA = '$categoria'");
		$sql = mysqli_query($con, "SELECT * FROM LIVROS WHERE  CATEGORIA = '$categoria'");
		if(mysqli_num_rows($sql) != 0){
			while($r = mysqli_fetch_array($sql)){
				echo " <form method='post' action='livroSelec.php' onclick='submit()'> ";
				echo " <div class='book'> ";
				echo " <div class='view view-first'> ";
				echo " <img src='".$r['IMAGEM']."' /> ";
				echo " <div class='mask'> ";
				echo "<br><br><br>";
				echo " <h2>";
				echo seReservado($con, $r['ISBN']) ;
				echo "</h2>";
				echo " <h2>". $r['TITULO'] ."</h2>";
				echo " <h2>". $r['CATEGORIA'] ."</h2>";
				/* BUSCA DOS AUTORES */
				$buscaAut = mysqli_query($con, "SELECT * FROM AUTORES WHERE ISBN_L = '".$r['ISBN']."'");
				while($rAut = mysqli_fetch_array($buscaAut)){
					echo " <h2>";
					echo $rAut['NOME'];
					echo "</h2>";
				} 
				echo " <h2>". $r['ANOPUBLICACAO'] ."</h2>";
				echo "<input type='hidden' name='isbn' value='". $r['ISBN'] ."' >";
				echo " </div> </div> </div> </form>";
			}
		}else{
			echo "<span class='consultas'> Nenhum registro encontrado! </span>";
		}
		mysqli_close($con);
	}
	function filtroPesquisado(){
		$f = isset($_POST['pesquisarCat']) ? $_POST['pesquisarCat'] : "Sem filtro";
		return $f; 
	}
?>
			</div>
		</div>	
		<div class="clearfix"></div>	
	</div>
</div>

<!-- Games BOOK Ends here -->

<!-- INÍCIO DO RODAPÉ -->
<div class="footer">
	<table class="center">
		<tr>
			<td align="right">
				<a href="http://www.fatecjd.edu.br/site"><img src="images/fatec_logo.png" alt="Logo FATEC" width="158px" height="78px"></a>
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
<!-- FIM DO RODAPÉ -->

</body>
</html>
