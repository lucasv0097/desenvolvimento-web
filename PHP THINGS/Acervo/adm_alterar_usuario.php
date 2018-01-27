<!DOCTYPE HTML>
<html>
<head>
    <?php
        include_once "funcoes.php"; 
        complements();
        checkAdmCookie();
    ?>
<title>Edição de Usuário :: Bookhouse</title>
</head>
<body>
<div class="games">
	<div class="container">
		<div class="contact">
			<br><br><br><br><br><br>
<?php
	$con = conectarBd();
	$id = isset($_POST['idU']) ? $_POST['idU'] : "vazio";
	if($id == "vazio"){
		if(isset($_COOKIE['IDU'])){
			$id = $_COOKIE['IDU'];
		}
	}else{
		setcookie("IDU", $id, (time()+360));
	}

	$sqlvalores = mysqli_query($con, "SELECT*FROM USUARIOS WHERE ID =".$id);
		$r = mysqli_fetch_array($sqlvalores);
			$nome = $r['NOME'];
			$email = $r['EMAIL'];
			$login = $r['LOGIN'];		
?>
			
			<div class="loginbox">
				<div class="text">
					<form method="post" action="#">
						<fieldset>
							<legend>
								<span class="login" style="width: 94.8%;font-size:30px;">Alterar Usuário<font color="#68BEED">
									
								</span>
							</legend>
							<div class="contact-box">
								<div class="text">
									<br><h4>Informações pessoais</h4><br>
									<p>Nome completo:</p><br>
									<input name="nome" type="text" required="" value="<?php echo $nome; ?>" />
							  </div>
							</div>
							
							<div class="contact-box">
								<div class="text">
									<br><h4 style="margin-bottom:25px">Informações de contato</h4>
									<p>E-mail:</p><br>
									<input name="email" type="email" required value="<?php echo $email; ?>"/>
								</div>
							</div>
							
							<div class="contact-box">
							
								<div class="text">
									<br><h4 style="margin-bottom:25px">Informações da conta</h4>
									<p>Usuário:</p><br>
									<input name="usuario" type="text" maxlength=10 required value="<?php echo $login; ?>"><br>
									<br>
									<p>Senha:</p><br>
									<input name="senhaC" type="password" disabled maxlength=10 required value="********"><br>
									<br/><br>
								</div>
							</div>
							<div class="text-but" style="width:100%;">
								<input name="btnCadastrar" type="submit" value="Alterar" style="width:305px;"/>
								<input name="btnCadastrar" type="submit" value="Deletar" style="width:305px;"/>
							</div>
						</fieldset>
					</form>
<!--TRECHO PHP PARA CADASTRAR NOVO USUARIO-->
<?php
	mysqli_close($con);
	if(isset($_POST['btnCadastrar']) and $_POST['btnCadastrar'] == "Alterar"){
		$con = conectarBd();

		$login = $_POST['usuario']; /*$senha = MD5($_POST['senhaC']);*/
		$nome = $_POST['nome'];	$email = $_POST['email'];

		mysqli_query($con, "UPDATE USUARIOS SET NOME = '$nome',EMAIL = '$email',LOGIN = '$login' WHERE ID = ".$id);
		
		echo "<span> Informações do usuário alteradas!</span>";

		mysqli_close($con);
		
		header("Location:adm_alterar_usuario.php");
	}else if(isset($_POST['btnCadastrar']) and $_POST['btnCadastrar'] == "Deletar"){
		$con = conectarBd();

		mysqli_query($con, "DELETE FROM USUARIOS WHERE ID=".$id);
		
		mysqli_close($con);
		
		header("Location:adm_listar_usuarios.php");
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