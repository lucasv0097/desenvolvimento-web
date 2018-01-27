<?php

function footer(){
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

function conectarBd(){
    $con = mysqli_connect('localhost','root','','BdAcervo')or die (mysqli_error() + " <span class='erro'> Erro ao se conectar ao banco de dados! </span> ");
    return $con;
}

function convNum($num){
    if($num=="")$num=0;
    else{
        $num=str_replace(".","",$num);
	$num=str_replace(",",".",$num);
	$num=str_replace("R$ ","",$num);
    }
    $num=number_format($num,2);
    return $num;
}

?>
