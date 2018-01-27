<!DOCTYPE HTML>
<html>
<head>
    <?php
        include_once "funcoes.php"; 
        complements();
        checkAdmCookie();
    ?>
<title>Administrador :: Bookhouse</title>
</head>
<body>
<div class="games">
	<div class="container">

		<div class="main">
                        <h3 class="page-header">Administrador</h3>		
			<br><br>
			<?php 
				session_start();
				session_unset('pageA');

				if(!isset($_SESSION['cnt'])){
					$_SESSION['cnt'] = 0;
				}
				if(!isset($_SESSION['pageA'])){
					$_SESSION['pageA'] = array();
				}

				if(empty($_SESSION['pageA'][$_SESSION['cnt']])) {
					$_SESSION['pageA'][$_SESSION['cnt']] = basename( __FILE__ );
				}
				for($i = 0; $i<=count($_SESSION['pageA'])-1; $i++){
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
				echo "<a href='". $_SESSION['pageA'][count($_SESSION['pageA'])-1]. "' style='color:#fff' > $nomep </a>";
				if($i < $_SESSION['cnt']){
					echo " -> ";
				}
			}
				
			?><br><br><br>

                	<!-- ADD OS RESPECTIVOS LINKES -->
                        <div style="text-align: center;">
                             <a href="adm_cadastrar_livro.php">  <div class="admask">
                                   <h2>Cadastrar livro</h2> 
                            </div> </a>

                            <a href="adm_listar_livros.php"> <div class="admask">
                                    <h2>Listar livros</h2>
                            </div>  </a>


                            <a href="adm_listar_usuarios.php"><div class="admask">
                                    <h2>Listar usuários</h2>
                            </div> </a>

                            <a href="adm_listar_reservas.php"><div class="admask">
                                    <h2>Listar reservas</h2>
                                </div> </a>
                        </div>
                </div>
        </div>
</div>
<?php footer() ?>
</body>
</html>