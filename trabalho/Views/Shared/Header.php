<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commando</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="shortcut icon" href="img/logo.svg" type="image/x-icon">
</head>

<style>
    html,
    body {
        height: 100%;
        font-family: 'Roboto', sans-serif;
        background-image: linear-gradient(112.1deg, rgba(32, 38, 57, 1) 11.4%, rgba(63, 76, 119, 1) 70.2%);
        background-repeat: no-repeat, repeat;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 1rem;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="index.php?pagina=comanda&metodo=index#">
                Commando
            </a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="?pagina=comanda&metodo=index">Comandas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?pagina=item&metodo=index">Itens</a>
                </li>

                <?php
                if (isset($_COOKIE['usuario'])) {
                    $usuario = json_decode($_COOKIE['usuario'], true);
                    if ($usuario["tipo"] == "Admin") {
                        echo '<li class="nav-item">
                                <a class="nav-link" href="?pagina=usuario&metodo=index">Usuários</a>
                                </li>';
                    }
                }
                ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Minha conta
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item text-danger" onclick="logout()" href="#">Sair</a>
                    </div>
                </li>
            </ul>
            <div class="form-inline my-2 my-lg-0">
                <button class="btn btn-success my-2 my-sm-0" data-toggle="modal" data-target="#modalComanda" onclick="obterItens()">Nova comanda</button>
            </div>

        </div>
    </nav>
    <main role="main" class="container">