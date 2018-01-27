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

<?php
	function conectarBd(){
		$con = mysqli_connect('localhost','root','','BdAcervo')or die (mysqli_error() + " <span class='erro'> Erro ao se conectar ao banco de dados! </span> ");
		return $con;
	}
?>

</head>
<body>

<!-- Games Page Starts here -->
<div class="games">
	<div class="container">
		<div class="contact">
			<br><br><br><br><br><br>
			<div class="loginbox">
				<form method="post" action="#">
					<div class="text">
						<input class="login" type="submit" value="login" name="btnLogin" />
						<input class="login" maxlength=10 name="senha" type="password" placeholder="Senha" required/>
						<input class="login" maxlength=10 name="login" type="text" placeholder="Login" required/>
						
						<span class="login">Login de <font color="#68BEED">
						<strong id="cad">Usuários</strong></font></span>
				  </div>
			  </form>
			</div>
			<br><br><br>

<!--TRECHO PHP PARA FAZER LOGIN-->
<?php
	if(isset($_POST['btnLogin']) and $_POST['btnLogin'] == "login"){
		if((isset($_POST['login']) and $_POST['login'] == "adm") and (isset($_POST['senha']) and $_POST['senha'] == "adm")){
			header("Location:livrosselectadm.php");
		}else{
			$login = $_POST['login']; $senha = MD5($_POST['senha']);
			$c = conectarBd();
			$buscaUsuario = mysqli_query($c, "SELECT * FROM USUARIOS WHERE LOGIN = '$login' AND SENHA = '$senha' ");
			if(mysqli_num_rows($buscaUsuario)==1){
				while ($res = mysqli_fetch_array($buscaUsuario)) {
					$id = $res['ID'];
					$nome = $res['NOME'];
					$email = $res['EMAIL'];
				}
				setcookie("login", $login, (time()+600));
				setcookie("nome", $nome);
				setcookie("email", $email);
				setcookie("id", $id);
				
				header("Location:acervo.php");
				
			}else{
				echo "Login ou senha iválido!";
			}mysqli_close($c);
		}
	}
?>
			
			<div class="loginbox">
				<div class="text">
					<form method="post" action="#">
						<fieldset>
							<legend>
								<span class="login" style="width: 405px;font-size:30px;">Primeiro acesso?<font color="#68BEED">
									<strong id="cad">Cadastre-se!</strong></font>
								</span>
							</legend>
							<div class="contact-box">
								<div class="text">
									<br><h4>Informações pessoais</h4><br>
									<p>Nome completo:</p><br>
									<input name="nome" type="text" placeholder="Nome" required="" />
							  </div>
							</div>
							
							<div class="contact-box">
								<div class="text">
									<br><h4 style="margin-bottom:25px">Informações de contato</h4>
									<p>E-mail:</p><br>
									<input name="email" type="email" placeholder="ex.: nome@email.com" required/>
								</div>
							</div>
							
							<div class="contact-box">
							
								<div class="text">
									<br><h4 style="margin-bottom:25px">Informações da conta</h4>
									<p>Usuário:</p><br>
									<input name="usuario" type="text" placeholder="Limite de 10 caracteres..." maxlength=10 required><br>
									<br>
									<p>Senha:</p><br>
									<input name="senhaC" type="password" placeholder="Limite de 10 caracteres..." maxlength=10 required><br>
									<br/><br>
								</div>
							</div>
							<div class="text-but" style="width:100%;">
								<input name="btnCadastrar" type="submit" value="CADASTRAR" style="width:305px;"/>
							</div>
						</fieldset>
					</form>
<!--TRECHO PHP PARA CADASTRAR NOVO USUARIO-->
<?php
	if(isset($_POST['btnCadastrar']) and $_POST['btnCadastrar'] == "CADASTRAR"){
		$con = conectarBd();

		$login = $_POST['usuario']; $senha = MD5($_POST['senhaC']);
		$nome = $_POST['nome'];	$email = $_POST['email'];

		$sql = "SELECT * FROM USUARIOS WHERE LOGIN = '$login' or EMAIL = '$email'";
		$sqlQuery = mysqli_query($con, $sql);

		if(mysqli_num_rows($sqlQuery)==0){
			$sqlQuery = mysqli_query($con, "INSERT INTO USUARIOS(NOME,EMAIL,LOGIN,SENHA)VALUES('$nome','$email','$login','$senha')");
			//FAZER SAIDAS COM CSS DIFERENTE 
			echo "Usuário cadastrado com sucesso!";
			
		}else{
			$res = mysqli_fetch_array($sqlQuery);
			if($res['LOGIN'] == $login and $res['EMAIL'] == $email){
				echo "Usuário ja cadastrado!";
			}
			if($res['LOGIN'] == $login){
				echo "<br> Esse login ja esta registrado! Escolha outro.";
			}
			if($res['EMAIL'] == $email){
				echo "<br> Esse e-mail ja esta registrado! Informe outro.";
			}
		}
		mysqli_close($con);
	}
?>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- INÍCIO DO RODAPÉ -->
<div class="footer">
	<table class="center">
		<tr>
			<td align="right">
				<a href="http://www.fatecjd.edu.br/site"><img src="images/fatec_logo.png" alt="Logo FATEC" width="158px" height="78px"></a>
			</td>
			<td>
				<span>
					FATEC Jundiaí Deputado Ary Fossen<br>
					Av. União dos Ferroviários, 1760<br>
					Ponte de Campinas, Jundiaí - SP<br>
					Telefone: +55 (11) 4321-1234<br>
					E-mail: fatec@fatec.com<br>
				</span>
			</td> 
		</tr>
	</table>
</div>
<!-- FIM DO RODAPÉ -->

</body>
</html>

