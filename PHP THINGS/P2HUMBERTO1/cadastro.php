<!DOCTYPE HTML>
<html>
<head>
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
<?php include "funcoes.php";
	/*IF RESPONSAVEL POR VERIFICAR SE O COOKIE DO ADM ESTA ATIVO, SE TIVER MANTEI O ACESSO DISPONIVEL SE NAO REDIRECIONA PARA INDEX_1.PHP*/
	if(isset($_COOKIE['adm']) ){
				
	}else{
		header("Location:index_1.php");	
	} ?>
?>
<body>

<!-- INÍCIO DO CABEÇALHO -->
<div class="header">
	<div class="container">
		<div class="logo">
		</div>
		<span class="menu"></span>
		<div class="navigation">
			<ul class="navig cl-effect-3" >
				<li><a href="adm_home.php">Home</a></li>
				<li><a href="acervo.php">Acervo</a></li>
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
        <form method="post">
	<div class="container">
		<div class="contact">
			  <h3 class="page-header">Cadastrar novo livro</h3>
			  <h5 style="margin-bottom: 0px;"><small>Atenção: todos os campos são obrigatórios!</small></h5><br>
				<div class="contact-box" style="width:33.33%;">
					<div class="text">
						
						<p>ISBN:<br><br>
							<input type="text" name="isbn" required></p><br>
						
						<p> Título:<br><br> <input name="tt" type="text" required> </p><br>
						
						<p> Edição:<br><br> <input name="ed" type="text" required> </p>
                                                <br>
						<br><br>
							
					</div>
				</div>
				
				<div class="contact-box" style="width:33.33%;">
					<div class="text">
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
				
				<div class="contact-box" style="width:33.33%;">
				
					<div class="text">
                                            <p>Imagem:<br><br>
							<input type="file" id="imagem" name="imagem"> </p><br>
                                            
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
								</select></p><br>
						<input type="text" placeholder="Autor principal" id="inp1" name="inp1" required>
						<select name="nac1">
							<option>Brasileiro</option>
							<option>Estrangeiro</option>
						</select>
                                                <br><br>

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
                                                                            txt.id = "cp"+(i+1);

                                                                            var inp = document.createElement('input');
                                                                            inp.setAttribute('type', 'text');
                                                                            inp.placeholder = i+'º Coautor';
                                                                            inp.id = 'inp'+(i+1);
                                                                            inp.name = 'inp'+(i+1);

                                                                            var slc = document.createElement('select');
                                                                            slc.innerHTML = "<option> Brasileiro </option>";
                                                                            slc.innerHTML += "<option> Estrangeiro </option>";
                                                                            slc.name = "nac"+(i+1);
                                                                            slc.id = "slc"+(i+1);

                                                                            var br = document.createElement('br');
                                                                            br.id = 'br'+(i+1);
                                                                            
                                                                            var br2 = document.createElement('br');
                                                                            br2.id = 'br2'+(i+1);

                                                                            div.appendChild(txt);
                                                                            div.appendChild(inp);
                                                                            div.appendChild(slc);
                                                                            div.appendChild(br);
                                                                            div.appendChild(br2);
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
                                                                            var brrm2 = document.getElementById("br2"+i);
                                                                            div.removeChild(cprm);
                                                                            div.removeChild(inprm);
                                                                            div.removeChild(slcrm);
                                                                            div.removeChild(brrm);
                                                                            div.removeChild(brrm2);
                                                                            i--;
                                                                    }
                                                            }cnt = i;
                                                    }
                                                </script>
					</div>
				</div>
		</div>
	</div>
        <div class="container">
            <div class="text-but" style="width:100%;">
                <input type="submit" name="cadastrar" value="CADASTRAR" style="width:304.5px;"/>
            </div>
        </div>
    </form>
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
?>

<?php footer(); ?>

</body>
</html>