<?php

session_start();

require_once "Core.php";
require_once "Controllers/ComandaController.php";
require_once "Controllers/ItemController.php";
require_once "Controllers/UsuarioController.php";
require_once "Controllers/LoginController.php";

ob_start();
$core = new Core;
$core->start($_GET);
$saida = ob_get_contents();
ob_end_clean();

// para fazer request json não criar partials
if (isset($_GET['metodo']) && ($_GET['metodo'] == 'deletar' ||
    $_GET['metodo'] == 'obterTodos' || $_GET['metodo'] == 'cadastrarViaJson' ||
    $_GET['metodo'] == 'obterPorIdViaJson' ||
    $_GET['metodo'] == 'editarViaJson')) {
    echo $saida;
} else {
    include("Views/Shared/Header.php");
    echo $saida;
    include("Views/Shared/Footer.php");
}
