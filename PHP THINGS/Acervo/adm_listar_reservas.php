<!DOCTYPE HTML>
<html>
<head>
    <?php
        include_once "funcoes.php"; 
        complements();
        checkAdmCookie();
    ?>
<title>Reservas :: Bookhouse</title>
</head>
<body>
<div class="games">
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
	<div class="contact">
            <h3 class="page-header">Lista de livros reservados</h3>
            <table class="usuarios">
		<tr class='headeruser'>
			<td>USUÁRIO</td>
			<td>LIVRO RESERVADO</td>
		</tr>
            </table>
            <?php
                $con = conectarBd();
                $sqlReserv = mysqli_query($con, "SELECT U.NOME, L.TITULO, L.ISBN, U.ID FROM RESERVADOS R, USUARIOS U, LIVROS L WHERE U.ID = R.ID_USUARIO AND R.ID_LIVRO = L.ISBN");
		while($us = mysqli_fetch_array($sqlReserv)){
                    echo "<table class='usuarios'>";
                            echo "<tr class='rownonuser'>";
                                    echo "<td class = 'rowuser'>";
                                        echo "<form method = 'post' action='adm_alterar_usuario.php' onclick='submit()'>";
                                            echo $us['NOME'];
                                            echo "<input type = 'hidden' name='idU' value='".$us['ID']."'>";
                                    echo "</form></td>";
                                    
                                    echo "<td class = 'rowuser'>";
                                        echo "<form method = 'post' action='adm_page_livro.php' onclick='submit()'>";
                                            echo $us['TITULO'];
                                            echo "<input type = 'hidden' name='isbn' value='".$us['ISBN']."'>";
                                    echo "</form></td>";
                    echo "</table>";
		}
            ?>
        </div>
    </div>
</div>
<?php footer(); ?>
</body>
</html>