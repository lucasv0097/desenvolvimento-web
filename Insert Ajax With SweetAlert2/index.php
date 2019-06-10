<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Formulário de usuário</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.32.2/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.32.2/package.json"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.32.2/sweetalert2.d.ts"></script>

    <style>
    /* label{
                display: block;
            } */
    </style>
</head>

<body>
    <button class="btn btn-info" data-toggle="modal" data-target="#myModal">Novo Usuario</button>
    <!--        Tabela de exibição dos dados-->
    <div id="table">
        <table class="table">
            <tr style='padding: 10%;'>
                <td>Id</td>
                <td>Nome</td>
                <td>Email</td>
                <td>Senha</td>
            </tr>
            <?php
            //precisamos chamar esta página para realizarmos as queries com o banco
            include 'conexao.php';
            // Select que traz todos os usuario cadastrados no banco de dados
            $select = "SELECT * FROM USUARIO";
            $result = mysqli_query($conect, $select); //resultado do select
            //Enquanto existir usuários no banco ele insere uma nova linha e exibe os dados
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['ID_USUARIO'];
                $nome = $row['NOME'];
                $email = $row['EMAIL'];
                $senha = $row['SENHA'];

                echo "   <tr>
                <td>$id</td>
                <td>$nome</td>
                <td>$email</td>
                <td>$senha</td>
            </tr>";
            }
            ?>
        </table>

        <!--            Modal que é aberto ao clicar novo usuario-->
        <div class="container">
            <!-- Trigger the modal with a button -->
            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            <form id="cadUsuario" method="POST">
                                <label>Nome:</label><input type="text" name="nome" id="nome" />
                                <label>Email:</label><input type="text" name="email" id="email" />
                                <label>Senha:</label> <input type="text" name="senha" id="senha" />
                                <br /><br />
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" type="button" value="Salvar" id="salvar">salvar</button>

                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>


</body>

</html>
<script type="text/javascript" language="javascript">
function reload() {
    location.reload();
}
$(document).ready(function() {
    /// Quando usuário clicar em salvar será feito todos os passo abaixo
    $('#salvar').click(function(e) {
        e.preventDefault();
        var dados = $('#cadUsuario').serialize();
        var nome = document.getElementById("nome").value;
        var email = document.getElementById("email").value;
        var senha = document.getElementById("senha").value;
        if (nome == "" || email == "" || senha == "") {
            Swal({
                position: 'md',
                type: 'error',
                title: 'Campo Invalido',
                showConfirmButton: false,
                timer: 1500
            })

        } else {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'salvar.php',
                async: true,
                data: dados,
                success: function(response) {
                    Swal({
                        position: 'md',
                        type: 'success',
                        title: 'Dados Cadastrados',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    setTimeout(reload, 2000);
                }

            });
        }

        return false;
    });
});
</script>