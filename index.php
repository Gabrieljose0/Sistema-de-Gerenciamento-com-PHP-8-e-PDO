<?php 
require_once("conexao/conexao.php");

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <link href="CSS/style.css" rel="stylesheet">

</head>



<body>



    <div class="container">

        <!-- <form method="post" action="tabela.php"> -->

        <form method="post" action="autenticar.php">

            <section class="vh-100">
                <div class="wrapper fadeInDown">
                    <div id="formContent">
                        <!-- Tabs Titles -->

                        <!-- Icon -->
                        <div class="fadeIn first">
                            <img src="img/bem-vindo.png" id="icon" alt="bem vindo!" />
                        </div>

                        <!-- Login Form -->
                        <form>
                            <div class="container-fluid mt-3">
                                <input type="text" id="login" name="usuario"
                                    class="fadeIn second form-control form-control-lg mb-2" placeholder="Usuário">

                                <input type="password" id="password" name="senha"
                                    class="fadeIn third form-control form-control-lg mb-2" placeholder="Senha">
                                <input type="submit" class="fadeIn fourth" value="Log In">
                            </div>
                        </form>

                        <!-- Remind Passowrd -->
                        <div id="formFooter">
                            <p class="small fw-bold mt-2 pt-1 mb-0">
                                Não tem uma conta?
                                <button type="button" class="underlineHover btn" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Register</button>
                            </p>
                        </div>

                    </div>
                </div>


                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastre-se</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="" method="POST">
                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nome</label>
                                        <input type="text" class="form-control" id="exampleInputEmail"
                                            name="cadastroUsuario" aria-describedby="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            name="cadastroEmail" aria-describedby="emailHelp" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="cadastroSenha"
                                            id="exampleInputPassword1" required>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary"
                                        name="btn-cadastrar">Cadastrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </section>


        </form>

    </div>


    <?php 
    if(isset($_POST['btn-cadastrar'])){


        $query_Validation = $pdo->prepare("SELECT * FROM usuarios WHERE email =:email");
        $query_Validation->bindValue(":email", $_POST['cadastroEmail']);
        $query_Validation->execute();


        $result_Validation = $query_Validation->fetchAll(PDO::FETCH_ASSOC);
        $total_reg = count($result_Validation);


        if($total_reg > 0){
            echo "<script language='javascript'> window.alert('Usuário Já cadastrado')  </script>";
            echo "<script language='javascript'> window.location ='index.php' </script>";
        }
        else{
            
            $query = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, nivel)  VALUES (:nomeCad, :emailCad, :senhaCad, :nivelCad)");


            $query->bindValue(":nomeCad", $_POST['cadastroUsuario']);
            $query->bindValue(":emailCad", $_POST['cadastroEmail']);
            $query->bindValue(":senhaCad", $_POST['cadastroSenha']);
            $query->bindValue(":nivelCad", 'Cliente');
            $query->execute();

            echo "<script language='javascript'> window.alert('Cadastro Realizado com Sucesso')  </script>";
            echo "<script language='javascript'> window.location ='index.php' </script>";
        }

        

    }
    ?>



</body>

</html>
