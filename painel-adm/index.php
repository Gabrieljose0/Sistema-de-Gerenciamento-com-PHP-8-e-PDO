<?php

@session_start();

require_once('../conexao/conexao.php');

//VERIFICAR SE POSSUI UM USUÁRIO LOGADO E SE O ACESSO É DE ADMINISTRADOR
if(@$_SESSION['nivel_usuario'] != 'Administrador'){
    echo "<script language='javascript'> window.alert('SESSÃO NÃO INICIADA, POR FAVOR FAÇA O LOGIN PARA TER ACESSO AO SISTEMA') </script>";
    echo "<script language='javascript'> window.location = '../index.php' </script>";
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <title>Painel Administrativo</title>
</head>

<body>

    <header>
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"> SISTEMA </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                    aria-labelledby="offcanvasDarkNavbarLabel"><br>
                    <div class="offcanvas-header">
                        <div>
                            <h3 class="offcanvas-title" id="offcanvasDarkNavbarLabel">
                                <?php echo $_SESSION['nome_usuario']  ?> </h3>
                            <h5 style="color: #fff;"> <?php echo $_SESSION['nivel_usuario']  ?> </h5>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>

                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item">
                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    href="#">Something else here</a></li>
                            <a class="nav-link" href="../logout.php">Sair</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Dropdown
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                        <form method="GET" class="d-flex mt-3" role="search">
                            <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search"
                                name="pesquisar">
                            <button class="btn btn-success" type="submit">Pesquisar</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>


    <div class="container mt-5">
        <div class="text-end">
            <a href="index.php?funcao=novoCadastro" type="button" class="btn btn-secondary">Novo
                Usuário</a>
        </div>


        <div class="table-responsive">
            <table class="table table-striped">


                <tbody>
                    <?php 
                        $txtBuscar = '%'. @$_GET['pesquisar'] . '%';
                            $query=$pdo->prepare("SELECT * FROM usuarios WHERE id LIKE :id OR nome LIKE :nome OR email LIKE :email OR nivel LIKE :nivel ");
                            $query->bindValue(":id", $txtBuscar);
                            $query->bindValue(":nome", $txtBuscar);
                            $query->bindValue(":email", $txtBuscar);
                            $query->bindValue(":nivel", $txtBuscar);
                            $query->execute();

                            $result = $query->fetchAll(PDO::FETCH_ASSOC);
                            $total_reg = @count($result);


                            if($total_reg > 0){

                                echo"
                                <thead>
                                    <tr>
                                        <th scope='col'>ID</th>
                                        <th scope='col'>NOME</th>
                                        <th scope='col'>EMAIL</th>
                                        <th scope='col'>NIVEL</th>
                                        <th scope='col'>AÇÃO</th>
                                        </tr>
                                </thead>";

                                for($i=0; $i < $total_reg; $i++){
                                    foreach($result[$i] as $key => $value){
                                        
                                    }

                                    $id = $result[$i] ['id']; 
                                    $nome = $result[$i] ['nome']; 
                                    $email = $result[$i] ['email']; 
                                    $nivel = $result[$i] ['nivel']; 

                                    
                                    echo"
                                    <tr>
                                        <td>" .$id ." </td>
                                        <td>". $nome ."</td>
                                        <td>". $email ."</td>
                                        <td>". $nivel ."</td>
                                        <td>  
                                            <a href='index.php?funcao=editar&id=".$id."'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square text-primary' viewBox='0 0 16 16'>
                                                    <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                                    <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
                                                </svg>
                                            </a> 

                                            <a href='index.php?funcao=deletar&id=".$id."'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill text-danger' viewBox='0 0 16 16'> 
                                                    <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                                                </svg>
                                            </a>

                                        </td>
                                    </tr>";
                                }
                            }
                            else{
                                echo "<h5> Não Existe Dados para serem Exibidos </h5>";
                            }
                        ?>
                </tbody>
            </table>
        </div>

    </div>




    <!-- MODAL DE CADASTRO E EDIÇÃO -->
    <div class="modal fade" id="ModalAdicionarEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <?php 
                        if(@$_GET['funcao'] == 'editar'){
                            $titulo_modal = "Editar Usuário";
                            $botao_modal = "btn-editar";

                            $query=$pdo->query("SELECT * FROM usuarios WHERE id = '$_GET[id]' ");
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);

                            $nome_ed = $result[0]['nome'];
                            $email_ed = $result[0]['email'];
                            $senha_ed = $result[0]['senha'];
                            $nivel_ed = $result[0]['nivel'];
                        }
                        else{
                            $titulo_modal = "Inserir Usuário";
                            $botao_modal = "btn-cadastrar";
                        }
                    ?>

                    <h1 class="modal-title fs-5" id="ModalAdicionarEditar"> <?php echo $titulo_modal ?> </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="exampleInputName" name="cadastroUsuario"
                                aria-describedby="name" required value="<?php echo @$nome_ed ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="cadastroEmail"
                                aria-describedby="emailHelp" required value="<?php echo @$email_ed ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" name="cadastroSenha" id="exampleInputPassword1"
                                required value="<?php echo @$senha_ed ?>">
                        </div>
                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example" name="cadastroNivel">
                                <option <?php if(@$nivel_ed == 'Administrador') { ?> selected <?php } ?>
                                    value="Administrador">
                                    Administrador
                                </option>

                                <option <?php if(@$nivel_ed == 'Cliente') { ?> selected <?php  } ?> value="Cliente">
                                    Cliente
                                </option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="<?php echo $botao_modal ?>">Salvar</button>

                        <input type="hidden" value="<?php echo @$email_ed  ?>" name="antigo">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL DE EXCLUSÃO -->
    <div class="modal" tabindex="-1" id="modalDeletar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Excluir Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Deseja Excluir o usuário <?php  ?> ? </p>
                </div>
                <div class="modal-footer">
                    <form method="POST">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sair</button>
                        <button type="submit" name="btn-deletar" class="btn btn-danger">Exluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    


    <!-- CADASTRO DE USUÁRIO -->
    <?php 
        if(isset($_POST['btn-cadastrar'])){

            
            $query_Validation=$pdo->prepare("SELECT * FROM usuarios WHERE email =:email");
            $query_Validation->bindValue(":email", $_POST['cadastroEmail']);
            $query_Validation->execute();


            $result_Validation = $query_Validation->fetchAll(PDO::FETCH_ASSOC);
            $total_reg = count($result_Validation);


            if($total_reg > 0){
                echo "<script language='javascript'> window.alert('Usuário Já cadastrado!') </script>";
                echo "<script language='javascript'> window.location ='index.php' </script>";
            }
            else{
            
                $query=$pdo->prepare("INSERT INTO usuarios (nome, email, senha, nivel) VALUES (:nomeCad, :emailCad, :senhaCad, :nivelCad)");

                $query->bindValue(":nomeCad", $_POST['cadastroUsuario']);
                $query->bindValue(":emailCad", $_POST['cadastroEmail']);
                $query->bindValue(":senhaCad", $_POST['cadastroSenha']);
                $query->bindValue(":nivelCad", $_POST['cadastroNivel']);
                $query->execute();

                echo "<script language='javascript'> window.alert('Usuário Cadastrado com Sucesso!') </script>";
                echo "<script language='javascript'> window.location ='index.php' </script>";
            }
        }
    ?>


    <!-- EDIÇÃO DE CADASTRO -->

    <?php 
        if(isset($_POST['btn-editar'])){

            if($_POST['antigo'] != $_POST['cadastroEmail'] ){ //Valida se o email que está no input "antigo" é diferente do input de editar, somente se for, entra na condição de verificação
                $query_Validation=$pdo->prepare("SELECT * FROM usuarios WHERE email =:email");
                $query_Validation->bindValue(":email", $_POST['cadastroEmail']);
                $query_Validation->execute();


                $result_Validation = $query_Validation->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = count($result_Validation);


                if($total_reg > 0){
                    echo "<script language='javascript'> window.alert('Usuário Já cadastrado!') </script>";
                    echo "<script language='javascript'> window.location ='index.php' </script>";
                }
            }
            else{
            
                $query=$pdo->prepare("UPDATE usuarios SET nome =:nomeUp, email =:emailUp, senha =:senhaUp, nivel =:nivelUp WHERE id =:id");

                $query->bindValue(":nomeUp", $_POST['cadastroUsuario']);
                $query->bindValue(":emailUp", $_POST['cadastroEmail']);
                $query->bindValue(":senhaUp", $_POST['cadastroSenha']);
                $query->bindValue(":nivelUp", $_POST['cadastroNivel']);
                $query->bindValue(":id", $_GET['id']);
                $query->execute();

                echo "<script language='javascript'> window.alert('Usuário Editado com Sucesso!') </script>";
                echo "<script language='javascript'> window.location ='index.php' </script>";
            }
        }
    ?>


    <!-- EXCLUSÃO DE USUÁRIO -->
    <?php 
        if(isset($_POST['btn-deletar'])){

            $query = $pdo->query("DELETE FROM usuarios WHERE id = '$_GET[id]'  ");
            
                echo "<script language='javascript'> window.alert('Usuário Deletado com sucesso!') </script>";
                echo "<script language='javascript'> window.location ='index.php' </script>";
        }
    ?>






    <?php 
        if(@$_GET['funcao'] == 'editar') { 
    ?>
            <script>
                const myModal = new bootstrap.Modal(document.getElementById('ModalAdicionarEditar'), {
                    keyboard: false
                });
                myModal.show();
            </script>
    <?php 
        } 

        if(@$_GET['funcao'] == 'novoCadastro') { 
    ?>
            <script>
                const myModalNovo = new bootstrap.Modal(document.getElementById('ModalAdicionarEditar'), {
                    keyboard: false
                });
                myModalNovo.show();
            </script>
    <?php 
        } 
     ?>


    <?php 
        if(@$_GET['funcao'] == 'deletar') {
    ?>
            <script>
                const myModalDelete = new bootstrap.Modal(document.getElementById('modalDeletar'), {
                    keyboard: false
                });
                myModalDelete.show();
            </script>
    <?php 
        }
    ?>



</body>

</html>
