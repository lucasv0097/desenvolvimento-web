<!DOCTYPE HTML>
<html>
<head>
    <?php
        include_once "funcoes.php"; 
        complements();
        checkAdmCookie();
    ?>
<title>Cadastro de Livros :: Bookhouse</title>
</head>
<body>
<div class="games">

		

        <form method="post" enctype="multipart/form-data">
	<div class="container">
	<?php 
    /*RESPONSAVEL PELO INDICE DE NAVEGACAO*/
            session_start();
            $_SESSION['cnt'] = count($_SESSION['pageA']);
            $cntp = 0;
            for($j = 0; $j <= count($_SESSION['pageA'])-1 ; $j++){

                if($_SESSION['pageA'][$j] == basename( __FILE__)){
                    $_SESSION['cnt'] = $j;
                    break;
                }
                if(!isset($_SESSION['pageA'][$_SESSION['cnt']])){
                    $_SESSION['pageA'][$_SESSION['cnt']] = basename( __FILE__ );
                }
                if($_SESSION['pageA'][$_SESSION['cnt']] != $_SESSION['pageA'][$_SESSION['cnt']-1]){
                    
                }else{
                    $p = $_SESSION['cnt'];
                    unset($_SESSION['pageA'][$p]);
                }
                
            }

            for($k = count($_SESSION['pageA'])-1; $k >= $_SESSION['cnt']+1; $k--){
                unset($_SESSION['pageA'][$k]);
            }
           
           
            for($i = 0; $i<=$_SESSION['cnt']; $i++){
                switch ($_SESSION['pageA'][$i]) {
                case 'adm_home.php':
                    $nomep = 'Home'; 
                    break;
                case 'adm_cadastrar_livro.php';
                    $nomep = 'Cadastrar Livro'; 
                    break;
                case 'adm_listar_livros.php':
                    $nomep = "Listar Livros"; 
                    break;
                case 'adm_listar_usuarios.php':
                    $nomep = 'Listar Usuários';
                    break;
                case 'adm_listar_reservas.php':
                    $nomep = 'Listar Empréstimos';
                    break;
                }
                echo "<a href='". $_SESSION['pageA'][$i]. "' style='color:#fff' > $nomep </a>";
                if($i < $_SESSION['cnt']){
                    echo " -> ";
                }
            }
        ?><br><br>
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
							<input type="file" id="img" name="img"> </p><br>
                                            
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
		$img = "img/".$_FILES['img']['name'];
		$con1 = conectarBd();

		upload_Img($_FILES['img']);

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

	function upload_Img($img){
		$tamanho_maximo = 100000; // em bytes
		$tipos_aceitos = array("image/gif","image/jpeg","image/png","image/bmp","image/pjpg");
		$arquivo = $img;
		if($arquivo['error'] != 0) {
			echo '<p><b><font color="red">Erro no Upload do arquivo<br>';
			switch($arquivo['erro']) {
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
		$destino = './img/'.$arquivo['name'];
		if(move_uploaded_file($arquivo['tmp_name'],$destino)) {
			echo '<span> O Arquivo foi carregado com sucesso!</span>';
		}
		else {
			echo '<p><b><font color="red">Ocorreu um erro durante o upload </font></b></p>';
		}
	}
?>
<?php footer(); ?>
</body>
</html>