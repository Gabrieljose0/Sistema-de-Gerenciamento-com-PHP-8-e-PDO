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
</head>



<body>


    <div class="container">


        <form method="post" action="autenticar.php">

            <section class="vh-100">
                <div class="container-fluid h-custom">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-md-9 col-lg-6 col-xl-5">
                            <img src="https://marketplace.canva.com/EAF65EWbuV0/4/0/1600w/canva-black-and-blue-simple-creative-illustrative-dragons-e-sport-logo-NO64HUH8vCA.jpg"
                                class="img-fluid" alt="Sample image">
                        </div>
                        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                            <form>


                                <!-- Email input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="text" id="usuario" name="usuario" class="form-control form-control-lg"
                                        required />
                                    <label class="form-label" for="form3Example3">Usuário</label>
                                </div>

                                <!-- Password input -->
                                <div data-mdb-input-init class="form-outline mb-3">
                                    <input type="password" id="senha" name="senha" class="form-control form-control-lg"
                                        required />
                                    <label class="form-label" for="form3Example4">Senha</label>
                                </div>


                                <div class="text-center text-lg-start mt-4 pt-2">
                                    <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                        class="btn btn-primary btn-lg"
                                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>

                                    <p class="small fw-bold mt-2 pt-1 mb-0">
                                        Don't have an account?
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">Register</button>
                                    </p>

                                </div>

                            </form>
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
                                        <input type="text" class="form-control" id="exampleInputName"
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



                <div
                    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
                    <!-- Copyright -->
                    <div class="text-white mb-3 mb-md-0">
                        Copyright © 2020. All rights reserved.
                    </div>
                    <!-- Copyright -->

                    <!-- Right -->
                    <div>
                        <a href="#!" class="text-white me-4">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#!" class="text-white me-4">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#!" class="text-white me-4">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#!" class="text-white">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                    <!-- Right -->
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
