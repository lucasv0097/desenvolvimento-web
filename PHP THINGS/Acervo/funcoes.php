<?php
//===================================================================
//                 FUNÇÕES PARA CHECAGEM DE COOKIES
//===================================================================

function checkCookie(){ //FUNÇÃO PARA A CHECAGEM DE COOKIES DE PÁGINAS ONDE TANTO USUÁRIOS COMUNS QUANTO ADM'S UTILIZAM (EXEMPLO: ADM_LISTAR_LIVROS.PHP)
    if(isset($_COOKIE['adm'])){
	   headeradm();
    }else if(isset($_COOKIE['login'])){
	   headeruser();
    }
    else header("Location:index.php");
}

function checkAdmCookie(){ //FUNÇÃO PARA A CHECAGEM DE COOKIES DE PÁGINAS UTILIZADAS APENAS POR ADM'S (EXEMPLO: ADM_LISTAR_RESERVAS.PHP
    if(isset($_COOKIE['adm'])) headeradm();
    else header("Location:index.php");
}

//===================================================================
//    FUNÇÕES PARA GERAÇÃO DE CABEÇALHO, RODAPÉ E COMPLEMENTOS
//===================================================================

function headeradm(){ //FUNÇÃO PARA A GERAÇÃO DE CABEÇALHO DE ADM'S
    echo "<div class='header'>
	<div class='container'>
		<div class='navigation'>
			<ul class='navig cl-effect-3'>
                                <li><a href='adm_home.php'>Home</a></li>
                                <li><a href='adm_cadastrar_livro.php'>Cadastrar livro</a></li>
                                <li><a href='adm_listar_livros.php'>Listar livros</a></li>
                                <li><a href='adm_listar_reservas.php'>Listar empréstimos</a></li>
                                <li><a href='adm_listar_usuarios.php'>Listar usuários</a></li>
				<li><a href='index.php'>Sair</a></li>
			</ul>
		</div>
	</div>
</div>";
}

function headeruser(){ //FUNÇÃO PARA A GERAÇÃO DE CABEÇALHO DE USUÁRIOS COMUNS
     echo "<div class='header'>
	<div class='container'>
		<div class='navigation'>
			<ul class='navig cl-effect-3'>
                                <li><a href='adm_listar_livros.php'>Home</a></li>
                                <li> Usuário: ".$_COOKIE['nome']."</li>
                                <li>Email: ".$_COOKIE['email']."</li>
				<li><a href='index.php'>Sair</a></li>
			</ul>
		</div>
	</div>
</div>";
}

function footer(){ ////FUNÇÃO PARA A GERAÇÃO DE RODAPÉS
    echo "<div class='footer'>
            <table class='center'>
		<tr>
                    <td align='right'>
                    	<a href='http://www.fatecjd.edu.br/site'><img src='images/fatec_logo.png' alt='Logo FATEC' width='158px' height='78px'></a>
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
        </div>";
}

function complements(){ //FUNÇÃO PARA A GERAÇÃO DE COMPLEMENTOS JAVASCRIPT, CSS E TAGS HEAD
    echo "<meta charset='utf-8'>
        <link href='css/bootstrap.css' rel='stylesheet' type='text/css' />
        <script src='js/jquery-1.11.0.min.js'></script>
        <link href='css/style.css' rel='stylesheet' type='text/css' />
        <script src='js/jquery.inputmask.bundle.js'></script>
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>";
}

//===================================================================
//                       FUNÇÕES DE CONEXÃO
//===================================================================

function conectarBd(){ //FUNÇÃO PARA O ESTABELECIMENTO DE CONEXÃO COM O BD
    $con = mysqli_connect('localhost','root','','BdAcervo')or die (mysqli_error() + " <span class='erro'> Erro ao se conectar ao banco de dados! </span> ");
    return $con;
}

function logoff(){ //FUNÇÃO PARA ENCERRAR O COOKIE ATUAL
    //TEMOS DE FAZER UMA FUNÇÃO PRA ENCERRAR O COOKIE VIGENTE, NEM PRECISA UTILIZAR ESTA FUNÇÃO "LOGOFF" PRA ISSO NECESSARIAMENTE, É APENAS UM LEMBRETE
    /*setcookie('login');
    header("Location:index.php");*/
}

//===================================================================
//                      FUNÇÕES UTILITÁRIAS
//===================================================================

function convNum($num){ //CONVERTE NÚMERO DO FORMATO INPUTMASK (EXEMPLO: R$ 1.500,25) PARA FLOAT (1500.25)
    if($num=="")$num=0;
    else{
        $num=str_replace(".","",$num);
	$num=str_replace(",",".",$num);
	$num=str_replace("R$ ","",$num);
    }
    $num=number_format($num,2);
    return $num;
}

function seReservado($c, $isbn){ //FUNÇÃO PARA CHECAGEM DE RESERVA DE LIVRO E ALTERAÇÃO DE VALUE DO BOTÃO DE RESERVA
    $rs = mysqli_query($c, "SELECT * FROM RESERVADOS WHERE ID_LIVRO = $isbn");
    if(mysqli_num_rows($rs) == 0){
        return "Reservar livro";
    }else{
        return "Livro Reservado";
    }
}

?>
