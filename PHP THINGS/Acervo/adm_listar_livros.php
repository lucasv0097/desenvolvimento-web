<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <?php
        include_once "funcoes.php"; 
        complements();
        checkCookie();
    ?>
<title>Acervo :: Bookhouse</title>
</head>
<body>

<div class="games" style="padding: 0 0 2em;">
	<div class="container"><br><br>
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
                                    	<?php 
                                    	/*CONDIÇÃO PARA CRIAR INPUT DE BUSCA POR PRECO SO SE FOR ADM*/
                                    		if(isset($_COOKIE['adm'])){
                                    			echo "<input class='login' type='submit' value='pesquisar preço' style='width: 195px;' name='buscarPreco' />";
                                    			echo "<input class='login' id='precoB' placeholder='Insira o preço aqui' name='pesquisarPreco' type='text' style='width: 600px;margin-right: 25px;' required />";
                                    		
                                    			echo "<select name='imm' style='width: 122px;height: 50px; float:right;'>
                                                        <option>igual a</option>
                                                        <option>menor que</option>
                                                        <option>maior que</option>
                                                    </select>";
                                                echo " <span class='login' style='margin-right: 2%;'>Filtro por <font color='#68BEED'>
                                                    <strong id='cad'>Preço</strong></font></span>";
                                    		}
                                    	?>                                                             
                                                    <!--<input class="login" type="submit" value="pesquisar preço" style="width: 195px;" name="buscarCat" />
                                                    <input class="login" id="precoB" placeholder="Insira o preço aqui" name="pesquisarPreco" type="text" style="width: 600px;margin-right: 25px;" required />-->
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
                
                else if(isset($_POST['buscarPreco']) and $_POST['buscarPreco'] == "pesquisar preço"){
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
					echo " <form method='post' action='adm_page_livro.php' onclick='submit()'> ";
				}else if(isset($_COOKIE['login'])){
					echo " <form method='post' action='user_page_livro.php' onclick='submit()'> ";
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
<?php footer(); ?>
</body>
</html>
