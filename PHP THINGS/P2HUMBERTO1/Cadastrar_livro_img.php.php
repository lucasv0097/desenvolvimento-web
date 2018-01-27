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
<?php include_once "funcoes.php"; 
	
?>

</head>
<body>

<!-- Games Page Starts here -->
<div class="games">
	<div class="container">
		<div class="contact">
			<br><br><br><br><br><br>

			<div class="loginbox">
				<div class="text">
					<form method="post" enctype="multipart/form-data" action="upload.php">
						<fieldset>
							<legend>
								<span class="login" style="width: 405px;font-size:30px;"><font color="#68BEED">
									<strong id="cad">Cadastre o  Livro Abaixo</strong></font>
								</span>
							</legend>
							<div class="contact-box">
								<div class="text">
									<br>
									<p>ISBN: </p><br>
									<input name="isbn" type="text" placeholder="isbn" required="">
									<br>

									<p>Título: </p><br>
									<input name="titulo" type="text" placeholder="titulo do livro" required>

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
							  </div>
							</div>
							
							<div class="contact-box">
								<div class="text">
									<br>
									<p>Edição:</p><br>
									<input name="edicao" type="text" placeholder="edicao do livro" required/>
									<br>

									<p> Categoria:<br><br> <select name="categoria" type="text" required>
									<option value="Programação">Programação</option>
									<option value="Ficção">Ficção</option>
									<option value="Romance">Romance</option>
									<option value="Aventura">Aventura</option>
									<option value="Terror">Terror</option>
						</select> </p>
									<br><br>
									
									<input type="text" placeholder="Autor principal" id="inp1" name="inp1" required>
						<select name="nac1">
							<option>Brasileiro</option>
							<option>Estrangeiro</option>
						</select>
								</div>
							</div>
							
							<div class="contact-box">
							
								<div class="text">
									<br>
									<p>Preço:</p><br>
									<input name="preco" id="price" type="text" placeholder="ex 25.55" required><br>
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

									<p>Ano de Publicação:</p><br>
									<input name="anopub" type="text" placeholder="ex 1999" required><br>
								</div>
							</div>

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
					
							<div class="contact-box">
								<div class="text">
									<p>Imagem:</p>
									<input type="hidden" name="MAX_FILE_SIZE" value="100000"><br>
									<input type="FILE" name="ARQUIVO" size="50">
									
								</div>
							</div>
							<div class="contact-box">
							<div class="text-but" style="width:100%; margin-top: 100px" >
								<input name="enviar" type="submit" value="CADASTRAR" style="width:305px;"/>
							</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php footer(); ?>

</body>
</html>