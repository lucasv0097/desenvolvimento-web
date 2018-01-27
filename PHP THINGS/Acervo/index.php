<!DOCTYPE HTML>
<html>
<head>
    <?php
        include_once "funcoes.php"; 
        complements();
        /*Zera os cookies quando inicia a pagina se alguem clicar em SAIR, sera redirecionado e seu cookie zerado*/
        if(isset($_COOKIE['login'])){
			setcookie('login', null, -1);
		}else if(isset($_COOKIE['adm'])){
			setcookie('adm', null, -1);
		}
		session_start();
		if(isset($_SESSION['pageA'])){
			session_unset($_SESSION);
		}
    ?>
<title>Início :: Bookhouse</title>
</head>
<body>
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
		if((isset($_POST['login']) and $_POST['login'] == "adm") and (isset($_POST['senha']) == "adm")){
			setcookie("adm", "adm", (time()+600));
			header("Location:adm_home.php");
		}else{
			$login = $_POST['login']; $senha = MD5($_POST['senha']);
			$c = conectarBd();
			$buscaUsuario = mysqli_query($c, "SELECT * FROM USUARIOS WHERE LOGIN = '$login' AND SENHA = '$senha'");
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
				header("Location:adm_listar_livros.php");	
			}else{
				echo "Login ou senha inválido!";
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
			echo "Usuário cadastrado com sucesso!";
			
		}else{
			$res = mysqli_fetch_array($sqlQuery);
			if($res['LOGIN'] == $login and $res['EMAIL'] == $email){
				echo "Usuário previamente cadastrado!";
			}
			if($res['LOGIN'] == $login){
				echo "<br> Login já cadastrado! Escolha outro.";
			}
			if($res['EMAIL'] == $email){
				echo "<br> E-mail já registrado! Informe outro.";
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
<?php footer(); ?>
</body>
</html>

