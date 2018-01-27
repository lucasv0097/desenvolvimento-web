<!DOCTYPE HTML>
<html>
<head>
    <?php
        include_once "funcoes.php"; 
        complements();
        checkAdmCookie();
    ?>
<title>Usuários :: Bookhouse</title>
</head>
<body>
<div class="games">
	<div class="container">
    <br><br>
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
                    <h3 class="page-header">Lista de usuários cadastrados</h3>
                    <table class="usuarios">
                        <tr class='headeruser'>
                                <td>Nome</td>
                                <td> email</td>
                                <td> login</td>
                                <td> senha </td>
                        </tr>
                    </table>
                    <?php  
                    /* TRECHO PHP QUE LISTA OS USUARIOS CADASTRADOS*/
                            $con = conectarBd();
                            $sqlUsuarios = mysqli_query($con, "SELECT*FROM USUARIOS");
                            while($us = mysqli_fetch_array($sqlUsuarios)){
                                    echo "<form method='post' action='adm_alterar_usuario.php' onclick='submit()'> ";
                                        echo "<table class='usuarios'>";
                                            echo "<tr class='rowuser'>";
                                                echo "<td>". $us['NOME'] . "</td>"; 
                                                echo "<td>". $us['EMAIL'] . "</td>"; 
                                                echo "<td>". $us['LOGIN'] . "</td>"; 
                                                echo "<td> ******** </td>"; 
                                        echo "</table>";
                                        echo "<input type='hidden' name='idU' value='".$us['ID']."'>";
                                    echo "</form>";
                            }
                    ?>		
	

		</div>
	</div>
</div>
<?php footer(); ?>
</body>
</html>