<!DOCTYPE HTML>
<html lang="pt-br">
<head>
<title>Acervo :: Gamehouse</title>
<meta charset="utf-8">
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.0.min.js"></script>
<script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
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
		}else if(isset($_COOKIE['adm'])){

		}else{
			header("Location:index_1.php");
		}

		function Encerrar(){
			setcookie('login');
			header("Location:index_1.php");
		}
		if(isset($_POST['encerrar']) and $_POST['encerrar'] == "Sair"){
			Encerrar();
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
<?php include_once "funcoes.php" ?>
<body>
	
<!-- INÍCIO DO CABEÇALHO -->
<div class="header">
	<div class="container">
		<span class="menu"></span>
		<div class="navigation">
			<ul class="navig cl-effect-3" >
				<li><?php 
					if(isset($_COOKIE['adm'])){
						echo "<a href='adm_home.php'> Voltar </a>";
					}else if(isset($login)){
						echo "<a href='index_1.php'> Voltar </a>";
					}
				?></a></li>
				<!-- MUDEI AKI ADD LINK PRA VOLTAR E SE ESSA PAGINA FOR ACESSADO POR ADM NAO APaRACE NOME SE FOR ACESSADA POR OUTRO USU APARECE NOME E EMAIL-->
				<li> <?php  echo isset($nome) ? "Usuário: $nome" : ""; ?> </li>
				<li>  <?php  echo isset($email) ? "E-mail: $email" : ""; ?></li>
			</ul>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- FIM DO CABEÇALHO -->	

<!-- Games BOOK Starts here -->
<div class="games" style="padding: 0 0 2em;">
	<div class="container">
		<div class="main">
			<br>
                        <form method="post">
                            <div class="loginbox">
                                            <div class="text">
                                                    <input class="login" type="submit" value="pesquisar categoria" style="width: 230px;" name="buscarCat" />
                                                    <input class="login" name="pesquisarCat" type="text" placeholder="Insira a categoria desejada aqui" style="width: 600px;margin-right: 25px;" required list="list-Categ" />
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
                            </div>
                        </form>
                         
                        <form method="post">
                            <div class="loginbox">   
                                    <div class="text" style="width: 1100px;">                                                                                                                                              
                                                    <input class="login" type="submit" value="pesquisar preço" style="width: 195px;" name="buscarCat" />
                                                    <input class="login" id="precoB" placeholder="Insira o preço aqui" name="pesquisarPreco" type="text" style="width: 600px;margin-right: 25px;" required />
                                                    <script>
                                                        $("#precoB").inputmask("numeric", {
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

                                                    <select name="imm" style="width: 122px;height: 50px; float:right;">
                                                        <option>igual a</option>
                                                        <option>menor que</option>
                                                        <option>maior que</option>
                                                    </select>

                                                    <span class="login" style="margin-right: 2%;">Filtro por <font color="#68BEED">
                                                    <strong id="cad">Preço</strong></font></span>
                                      </div>
                            </div>
                        </form>
			<br><br><br>

			<h3 id="destaques" class="page-header"><?php echo filtroPesquisado(); ?></h3>

<!--TRECHO PHP QUE GERAR AS DIVIS COM OS CONTEUDOS DO BANCO DE DADOS-->
<?php
        $con = conectarBd();
                if(isset($_POST['buscarCat']) and $_POST['buscarCat'] == "pesquisar categoria"){
                    $categoria = $_POST['pesquisarCat'];
                    $res = "SELECT * FROM LIVROS WHERE  CATEGORIA = '$categoria'";
                    imprimirQuery($con,$res);
                }
                
                else if(isset($_POST['buscarCat']) and $_POST['buscarCat'] == "pesquisar preço"){
                    $preco=$_POST['pesquisarPreco'];
                    if($preco=="")$preco="R$ 0,00";
                    $imm = isset($_POST['imm']) ? $_POST['imm'] : '';
                    $preco=str_replace(",","",convNum($preco));
                    if($imm == "igual a"){
                        $res = "SELECT * FROM LIVROS WHERE PRECO = $preco";
                        imprimirQuery($con,$res);
                    }
                    else if($imm == "maior que"){
                        $res = "SELECT * FROM LIVROS WHERE PRECO > $preco";
                        imprimirQuery($con,$res);
                    }
                    else if ($imm == "menor que"){
                        $res = "SELECT * FROM LIVROS WHERE PRECO < $preco";
                        imprimirQuery($con,$res);
                    }
                }
                
	mysqli_close($con);
        
        function imprimirQuery($con, $res){
            $sql = mysqli_query($con, $res);
            if(mysqli_num_rows($sql) != 0){
			while($r = mysqli_fetch_array($sql)){
				if(isset($_COOKIE['adm'])){
					echo " <form method='post' action='livrosselectadm.php' onclick='submit()'> ";
				}else if(isset($login)){
					echo " <form method='post' action='livroSelec.php' onclick='submit()'> ";
				}
				echo " <div class='book'> ";
                                echo " <h2>". $r['TITULO'] ."</h2>";
				echo " <div class='view view-first'> ";
				echo " <img src='".$r['IMAGEM']."' /> ";
				echo " <div class='mask'> ";
				echo "<br><br><br>";
				echo " <h2>";
				echo seReservado($con, $r['ISBN']) ;
				echo "</h2>";
				echo " <h2>". $r['CATEGORIA'] ."</h2>";
				/* BUSCA DOS AUTORES */
				$buscaAut = mysqli_query($con, "SELECT * FROM AUTORES WHERE ISBN_L = ".$r['ISBN']." LIMIT 1");
				while($rAut = mysqli_fetch_array($buscaAut)){
					echo " <h2>";
					echo $rAut['NOME'];
					echo "</h2>";
				}
				echo " <h2>". $r['ANOPUBLICACAO'] ."</h2>";
				echo "<input type='hidden' name='isbn' value='". $r['ISBN'] ."' >";
				echo " </div> </div> </div> </form>";
			}
            } else {
                echo "<span class='consultas' style='color: white;'> Nenhum registro encontrado! </span>";
            }
        }
        
	function filtroPesquisado(){
		if(isset($_POST['pesquisarCat'])) return "Categoria: ".$_POST['pesquisarCat'];
                else if(isset($_POST['pesquisarPreco'])) return "Preço ".$_POST['imm']." ".$_POST['pesquisarPreco'];
                else return;
	}
?>              
		</div>
		</div>	
	</div>
</div>

<!-- FIM DA PÁGINA -->

<?php footer(); ?>

</body>
</html>
