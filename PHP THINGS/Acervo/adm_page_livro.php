<!DOCTYPE html>
<html>
<head>
    <?php
        include_once "funcoes.php"; 
        complements();
        checkAdmCookie();
    ?>
    <title>Livro: 
    <?php
    	if(isset($_COOKIE['adm']) ){
            $c = conectarBd(); 
            $isbn = isset($_POST['isbn']) ? $_POST['isbn'] : "vazio";

            if($isbn == "vazio"){
                if(isset($_COOKIE['ISBN'])){
                    $isbn = $_COOKIE['ISBN'];
                }
            }else{
                setcookie("ISBN", $isbn, (time()+360));
            }
            
            $buscaTitL = mysqli_query($c, "SELECT * FROM LIVROS L WHERE L.ISBN = $isbn ");
            if(mysqli_num_rows($buscaTitL) != 0){
                $r = mysqli_fetch_array($buscaTitL);
                echo $r['TITULO'];
            }
        } else {
            header("Location:index.php");
        }

    ?> :: Bookhouse</title>
</head>
<body>
<!-- COMEÇO DA PÁGINA -->
<div class="games">
	<div class="container">
                <h3 class="page-header"><?php echo $r['TITULO']; ?></h3>
		<div class="blog-content">
			<div class="contact-box">
				<br><br>
				<figure>
				<!--IMAGEM DO LIVRO SELECIONADO-->
					<IMG src=" <?php echo $r['IMAGEM']; ?> " width="500px" height="650px">
				</figure>
			</div>
<!--DADOS DO LIVRO SELECIONADO-->
			<div class="blog-sidebar">
				<br><br>
                                <form method="post" onload="verfReser()">
				<div class="text-but">
					<!--variável-->
					<input type="submit" name="alterar" value="alterar">
					<input type="submit" name="deletar" value="deletar">

					<br><br>

					<script type="text/javascript">
						function verfReser(){
							var b = document.getElementById('bntR');
							if(b.value == "Livro Reservado"){
								b.disabled = true;
							}
						}
					</script>
				
				</div>
			
				<h4>Título do livro </h4> 
                                <li> <input type="text" name="titulo" value="<?php echo $r['TITULO']; ?>"></li><br>

				<h4>ISBN</h4>
				<li> <input type="text" name="isbn" value="<?php echo $r['ISBN']; ?>" disabled="true"></li><br>
				
				<h4>Autores</h4>
                                
				<?php
                                    $buscaAut = mysqli_query($c, "SELECT * FROM AUTORES WHERE ISBN_L = '".$isbn."'");
                                    $i = 0;
                                            while($rAut = mysqli_fetch_array($buscaAut)){
						echo "<li> <input type='text' name='inp$i' value='".$rAut['NOME']. "'>";
						echo "<input type='hidden' name='id$i' value='".$rAut['ID']."'>";
						echo "<select name='nac$i'>";
												
						if($rAut['NACIONALIDADE'] == "Brasileiro"){
                                                    echo "<option selected> Brasileiro </option>";
                                                    echo "<option> Estrangeiro </option>";
						}else{
                                                    echo "<option selected> Estrangeiro </option>";
                                                    echo "<option> Brasileiro </option>";
						} 
						echo "</select></li><br>";
						$i++;
                                            }
				 ?>				
				
				<h4>Categoria</h4>
					<li> <input type="text" name="Categoria" value="<?php echo $r['CATEGORIA']; ?>"></li><br>
				
				<h4>Edição</h4>
					<li> <input type="text" name="edicao" value="<?php echo $r['EDICAO']; ?>"></li><br>

				<h4>Ano de Publicação</h4>
					<li> <input type="text" name="anopublicacao" value="<?php echo $r['ANOPUBLICACAO']; ?>"></li><br>
				
				<h4>Preço</h4>
					<li> <input type="text" name="preco" id="price" value="<?php echo "R$ ".number_format(floatval($r['PRECO']),2,',','.'); ?>">
					</li><br><script>
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
				
			</form>
                                <?php 
                                    if (isset($_POST['deletar']) and $_POST['deletar'] == "deletar") {
										deletar($isbn);
                                    }else if(isset($_POST['alterar']) and $_POST['alterar']== "alterar"){
                                    	alterar($isbn,$i);
                                    }

                                    function deletar ($isbn){
                                            $con1 = conectarBd();
                                            $consultarRe = mysqli_query($con1, "SELECT * FROM RESERVADOS WHERE ID_LIVRO=$isbn");
                                            echo $isbn;
                                            if(mysqli_num_rows($consultarRe)>0){
                                                    $deletar = "DELETE FROM RESERVADOS WHERE ID_LIVRO = $isbn"; 
                                                    mysqli_query($con1,$deletar);
                                            }

                                            $consultarAut = mysqli_query($con1, "SELECT * FROM AUTORES WHERE ISBN_L = $isbn");

                                            if(mysqli_num_rows($consultarAut)>0){
                                                    $deletar = "DELETE FROM AUTORES WHERE ISBN_L = $isbn"; 
                                                    mysqli_query($con1,$deletar);
                                            }

                                            $deletar = "DELETE FROM LIVROS WHERE ISBN = $isbn"; 
                                            mysqli_query($con1,$deletar);
                                            echo "livro deletado";

                                            /* MUDEI AKI PARA QUE APOS O DELETE O USU SERA DIRECIONADO AO ACERVO NOVAMENTE*/
                                            header("Location:adm_listar_livros.php");
                                    }

                                    function alterar ($isbn,$i){
                                            $con1 = conectarBd();

                                            $titulo = $_POST['titulo'];
                                            $edicao = $_POST['edicao'];
                                            $categoria = $_POST['Categoria'];
                                            $anopublicacao = $_POST['anopublicacao'];
                                            $preco = convNum($_POST['preco']);

                                            mysqli_query($con1, "UPDATE LIVROS SET TITULO = '$titulo', EDICAO = '$edicao', CATEGORIA = '$categoria', ANOPUBLICACAO = '$anopublicacao', PRECO = $preco WHERE ISBN = $isbn");	

                                            for($a = 0; $a<$i ;$a++){
                                            	$nome = $_POST['inp'.$a];
                                            	$nac= $_POST['nac'.$a];
                                            	$id = $_POST['id'.$a];
                                            	mysqli_query($con1, "UPDATE AUTORES SET NOME = '$nome', NACIONALIDADE = '$nac' WHERE ID = $id AND ISBN_L = $isbn");
                                            }

                                            mysqli_close($con1);
                                            header("Location:adm_page_livro.php");
                                    }
				
                                ?>
			</div>
		</div>
	</div>
</div>
<?php footer(); ?>
</body>
</html>