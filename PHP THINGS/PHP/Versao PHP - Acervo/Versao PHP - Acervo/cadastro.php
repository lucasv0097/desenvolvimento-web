<!DOCTYPE HTML>
<html>
<head>
<?php
		function conectarBd(){
		$con = mysqli_connect('localhost','root','','bdacervo')or die (mysqli_error() + " <span class='erro'> Erro ao se conectar ao banco de dados! </span> ");
		return $con;
	}
?>

<title>Cadastro de livros :: Gamehouse</title>
<meta charset="utf-8">
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.0.min.js"></script>
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
</head>
<body>

<!-- INÍCIO DO CABEÇALHO -->
<div class="header">
	<div class="container">
		<div class="logo">
			<a href="index.html"><img src="images/logo.png" alt="Gamehouse Logo"></a>
		</div>
		<span class="menu"></span>
		<div class="navigation">
			<ul class="navig cl-effect-3" >
				<li><a href="index.html">Home</a></li>
				<li><a href="acervo.html">Acervo</a></li>
				<li><a href="ajuda.html">Ajuda</a></li>
				<li><a href="cadastro.html">Cadastro</a></li>
				<li><a href="sobre.html">Sobre</a></li>
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
<!-- FIM DO CABEÇALHO -->	

<!-- Games Page Starts here -->
<div class="games">
	<div class="container">
		<div class="page-path">
			<ul class="path-list">
        <li><a href="index.html">Home</a></li>&nbsp;&nbsp;&rarr;&nbsp;&nbsp;
				<li class="act">Cadastro</li>
			</ul>
			<div class="clearfix"></div>
		</div>
		<div class="contact">
			<form method="post">
			  <h3 class="page-header">Cadastrar novo livro</h3>
			  <h5><small>Atenção: todos os campos são obrigatórios!</small></h5><br>
				<div class="contact-box">
					<div class="text">
						
						<h4>Informações pessoais</h4><br>
						<p>ISBN:<br><br>
							<input type="text" name="isbn" required></p><br>
						
						<p> Título:<br><br> <input name="tt" type="text" required> </p><br>
						
						<p> Edição:<br><br> <input name="ed" type="text" required> </p><br>
						<br><br>
							
					</div>
				</div>
				
				<div class="contact-box">
					<div class="text">
						<h4 style="margin-bottom:25px">Informações de contato</h4>
						<p> Categoria:<br><br> <select name="categ" type="text" required>
							<option value="Programação">Programação</option>
							<option value="Ficção">Ficção</option>
							<option value="Romance">Romance</option>
							<option value="Aventura">Aventura</option>
							<option value="Terror">Terror</option>
						</select> </p>
						
						
					</div>
					
					<p> Preço:<br><br> <input name="preco" id="price" required> </p>
					<script>
						$("#price").inputmask("numeric", {
							radixPoint: ",",
							groupSeparator: ".",
							digits: 2,
							autoGroup: true,
							prefix: 'R$ ',
							placeholder: "0",
							digitsOptional: false,
							allowMinus: false,
							min: "0",
							rightAlign: false,
							oncleared: function () { self.Value(''); }
						});
					</script>
					
					<br><p> Ano de publicação:<br><br> <input name="anop" type="number" min="0" max="2017" required> </p><br>
					
				</div>
				
				<div class="contact-box">
				
					<div class="text">
						<h4 style="margin-bottom:25px">Informações da conta</h4>
							<p> Número de autores: <br><br>
								<select id="NUM" name="nAut">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
								</select></p>
						<input type="text" placeholder="Autor principal" id="inp1" name="inp1" required>
						<select name="nac1">
							<option>Brasileiro</option>
							<option>Estrangeiro</option>
						</select>
						<br>

						<div id="CAMPOS">
						</div><br>
						<script>var div = document.getElementById('CAMPOS');
var slec = document.getElementById('NUM');
var cnt = 1;

slec.onchange = function(){
	var qtd = slec.value;
	var i = cnt;
	if(qtd > cnt){;
		while(i<qtd){
			var txt = document.createElement("span");
			txt.innerHTML = "Autor "+(i+1)+": ";
			txt.id = "cp"+(i+1);

			var inp = document.createElement('input');
			inp.setAttribute('type', 'text');
			inp.placeholder = 'Co-Autor '+(i+1);
			inp.id = 'inp'+(i+1);
			inp.name = 'inp'+(i+1);

			var slc = document.createElement('select');
			slc.innerHTML = "<option> Brasileiro </option>";
			slc.innerHTML += "<option> Estrangeiro </option>";
			slc.name = "nac"+(i+1);
			slc.id = "slc"+(i+1);

			var br = document.createElement('br');
			br.id = 'br'+(i+1);

			div.appendChild(txt);
			div.appendChild(inp);
			div.appendChild(slc);
			div.appendChild(br);
			var o = document.getElementById('inp'+(i+1));
			o.required = true;
			i++;
		}
	}else if(qtd < cnt){
		while(i>qtd){
			var cprm = document.getElementById("cp"+i);
			var inprm = document.getElementById("inp"+i);
			var slcrm = document.getElementById("slc"+i);
			var brrm = document.getElementById("br"+i);
			div.removeChild(cprm);
			div.removeChild(inprm);
			div.removeChild(slcrm);
			div.removeChild(brrm);
			i--;
		}
	}cnt = i;
}</script>
					</div>
				</div>
				<div class="text-but" style="width:100%;">
					<input type="submit" name="cadastrar" value="CADASTRAR" style="width:304.5px;"/>
				</div>
			</form>
		</div>
	</div>
</div>
<?php

	if(isset($_POST['cadastrar']) and $_POST['cadastrar'] == "CADASTRAR"){
		inserir();
	}

	function inserir() {
		$isbn = $_POST['isbn'];
		$titulo = $_POST['tt'];
		$edicao = $_POST['ed'];
		$categoria = $_POST['categ'];
		$preco = convNum($_POST['preco']);
		$anopub = $_POST['anop'];
		$img = "img/nome.jpg";
		$con1 = conectarBd();

			$inserir = "INSERT INTO LIVROS (ISBN, TITULO, EDICAO, CATEGORIA, PRECO, ANOPUBLICACAO, IMAGEM)VALUES($isbn, '$titulo', '$edicao', '$categoria', '$preco', '$anopub', '$img')";
			mysqli_query($con1, $inserir);

			$autor = $_POST['nAut'];
			
			for($i=1; $i <= $autor; $i++){
					autor($con1, $isbn, $_POST['inp'. $i], $_POST['nac'.$i]);
					echo "autor: $i";
			}
			echo "Livro cadastrado";
		
		mysqli_close($con1);
	}

	function autor($con1, $isbn, $nome, $nacionalidade){
		$con1 = conectarBd();
		$autor = "INSERT INTO AUTORES (NOME, NACIONALIDADE, ISBN_L) VALUES('$nome', '$nacionalidade', $isbn)";

		
		echo $autor;
		mysqli_query($con1, $autor);
	}

	function convNum($num){
		if($num=="")$num=0;
		else{
			$num=str_replace(".","",$num);
			$num=str_replace(",",".",$num);
			$num=str_replace("R$ ","",$num);
		}
		$num=number_format($num,2);
		return $num;
	}
?>
<!-- INÍCIO DO RODAPÉ -->
<div class="footer">
  <a href="http://www.fatecjd.edu.br/site"><img src="images/fatec_logo.png" alt="Logo FATEC" width=10%></a>
</div>
<!-- FIM DO RODAPÉ -->

</body>
</html>