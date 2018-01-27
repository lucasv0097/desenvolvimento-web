<!DOCTYPE HTML>
<html>
<head>
<title>Administrador :: Gamehouse</title>
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
</head>
<?php include "funcoes.php";

/*IF RESPONSAVEL POR VERIFICAR SE O COOKIE DO ADM ESTA ATIVO, SE TIVER MANTEI O ACESSO DISPONIVEL SE NAO REDIRECIONA PARA INDEX_1.PHP*/
	if(isset($_COOKIE['adm']) ){
				
	}else{
		header("Location:index_1.php");	
	} ?>
<body>

<!-- INÍCIO DO CABEÇALHO -->
<div class="header">
	<div class="container">
		<span class="menu"></span>
		<div class="navigation">
			<ul class="navig cl-effect-3" >
				<li><a href="index_1.php">Home</a></li>
			</ul>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- FIM DO CABEÇALHO -->	

<!-- Games Page Starts here -->
<div class="games">
	<div class="container">

		<div class="main">
                        <h3 class="page-header">Administrador</h3>		
			<br><br><br><br><br>
                	<!-- ADD OS RESPECTIVOS LINKES -->
                        <div style="text-align: center;">
                             <a href="cadastro.php">  <div class="admask">
                                   <h2>Cadastrar livro</h2> 
                            </div> </a>

                            <a href="acervo.php"> <div class="admask">
                                    <h2>Listar livros</h2>
                            </div>  </a>


                            <div class="admask">
                                    <h2>Listar usuários</h2>
                            </div>


                            <div class="admask">
                                    <h2>Listar empréstimos</h2>
                            </div>
                        </div>
                </div>
        </div>
</div>

<!-- Games Page Ends here -->

<?php footer() ?>

</body>
</html>