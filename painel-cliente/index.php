<?php

@session_start();

require_once('../conexao/conexao.php');

//VERIFICAR SE POSSUI UM USUÁRIO LOGADO E SE O ACESSO É DE ADMINISTRADOR
if(@$_SESSION['nivel_usuario'] != 'Cliente'){
    echo "<script language='javascript'> window.alert('SESSÃO NÃO INICIADA, POR FAVOR FAÇA O LOGIN PARA TER ACESSO AO SISTEMA') </script>";
    echo "<script language='javascript'> window.location = '../index.php' </script>";
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</head>

<body style="background-color: #000">

    <header>
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"> PAINEL CLIENTE </a>
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
                                <a class="nav-link" href="../logout.php">Sair</a>
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

    <div class="text-center mt-5" style="color:#fff">
        <h1>Bem vindo ao painel do Cliente!</h1>
        <h5 class="mt-5">Para ter acesso aos cadastros e edições, logue como Administrador:</h5>
        <div class="mt-4">
            <p> <b>Login: </b>admin@teste.com</p>
            <p> <b>Senha: </b>1234</p>
        </div>

    </div>



</body>

</html>