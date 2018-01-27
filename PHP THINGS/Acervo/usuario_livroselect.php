<!DOCTYPE html>
<html>
<?php include "funcoes.php" ?>
<head>
    <title>Livro: 
    <?php
    /* MUDEI AKI OND CASO ACABE O TEMPO DO COOKIE DO ADM ELE VAI SER REDIRECIONADO*/
    	if(isset($_COOKIE['adm']) ){
            $c = conectarBD(); 
            $isbn = isset($_POST['isbn']) ? $_POST['isbn'] : "vazio";

            if($isbn == "vazio"){
                if(isset($_COOKIE['ISBN'])){
                    $isbn = $_COOKIE['ISBN'];
                }
            }else{
                setcookie("ISBN", $isbn, (time()+360));
            }
            echo "<br> isbn final $isbn";
            $buscaTitL = mysqli_query($c, "SELECT * FROM LIVROS L WHERE L.ISBN = $isbn ");
            if(mysqli_num_rows($buscaTitL) != 0){
                $r = mysqli_fetch_array($buscaTitL);
                echo $r['TITULO'];
            }	
            function seReservado($c, $isbn){

                $rs = mysqli_query($c, "SELECT * FROM RESERVADOS WHERE ID_LIVRO = $isbn");
                if(mysqli_num_rows($rs) == 0){
                    return "Reservar livro";
                }else{
                    return "Livro Reservado";
                }
            }
		}else{
			header("Location:index_1.php");	
		}

    ?></title>
    <meta charset="utf-8">
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.0.min.js"></script>
    <!-- Custom Theme files -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <!-- Custom Theme files -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
</head>
<body>

    
<!-- INÍCIO DO CABEÇALHO -->
<div class="header">
	<div class="container">
		<span class="menu"></span>
		<div class="navigation">
			<ul class="navig cl-effect-3" >
			<!-- MUDEI AKI ADD LINK PRA VOLTAR E SE ESSA PAGINAFOR ACESSADO POR ADM NAO APRACE NOME SE FOR ACESSADA POR OUTRO USU APARECE NOME E EMAIL-->
				<li><a href="acervo.php">Voltar</a></li>
				<li> <?php  echo isset($email) ? "Usuário: $email" : ""; ?> </li>
				<li>  <?php  echo isset($email) ? "E-mail: $email" : ""; ?></li>
			</ul> 
			<div class="clearfix"></div>

		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- FIM DO CABEÇALHO -->	

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
				<div class="text-but">
                                    <form method="post" onload="verfReser()">
                                        
                                        <input type="submit" name="reservar" id="bntR" value=<<?php checkLivro() ?>>
					<br><br>
                                        <!-- SÓ QDO TERMINEI ISSO FUI VER O seReservado, tu que vê qual função funciona melhor,
                                        se não for essa, basta apagar o checkLivro() e o value do submit q volta do jto q estava-->
                                        <?php function checkLivro(){
                                                $teste = mysqli_query($c, "SELECT * FROM reservados WHERE ID_LIVRO = ".$r['ISBN']);
                                            if(mysqli_num_rows($teste) != 0)return "LIVRO RESERVADO";
                                                else return "RESERVAR LIVRO";
                                            }
                                        ?>
					<script type="text/javascript">
						function verfReser(){
							var b = document.getElementById('bntR');
							if(b.value == "RESERVADO"){
								b.disabled = true;
							}
						}
					</script>
                                        
                                    </form>
				
				</div>
			
				<h4>Título do livro </h4> 
                                <li style="color: #fff;"> <?php echo $r['TITULO']; ?>"></li><br>

				<h4>ISBN</h4>
				<li style="color: #fff;"> <?php echo $r['ISBN']; ?>"></li><br>
				
				<h4>Autores</h4>
                                
                                <?php
                                    $buscaAut = mysqli_query($c, "SELECT * FROM AUTORES WHERE ISBN_L = '".$isbn."'");
                                    $i =1;
                                    while($rAut = mysqli_fetch_array($buscaAut)){
                                    	echo "<li style='color: #fff;'>".$rAut['NOME']."</li>";
                                        echo "<li style='color: #fff;'>".$rAut['NACIONALIDADE']."</li>";
					$i++;
                                    }
				 ?>
				
				
				<h4>Categoria</h4>
					<li style="color: #fff;"> <?php echo $r['CATEGORIA']; ?></li><br>
				
				<h4>Edição</h4>
					<li style="color: #fff;"><?php echo $r['EDICAO']; ?></li><br>

				<h4>Ano de Publicação</h4>
					<li style="color: #fff;"> <?php echo $r['ANOPUBLICACAO']; ?></li><br>
				
				<h4>Preço</h4>

					<li style="color: #fff;"><?php echo "R$ ".number_format(floatval($r['PRECO']),2,',','.'); ?></li><br>
			</div>

			<div class="clearfix"></div>

		</div>
	</div>
</div>
<!-- FIM DA PÁGINA -->
<?php footer(); ?>
</body>
</html>