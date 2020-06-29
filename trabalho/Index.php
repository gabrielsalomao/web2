<?php

require_once "Core.php";
require_once "Controllers/ComandaController.php";
require_once "Controllers/ItemController.php";
require_once "Controllers/UsuarioController.php";

ob_start();
$core = new Core;
$core->start($_GET);
$saida = ob_get_contents();
ob_end_clean();

if (isset($_GET['metodo']) && $_GET['metodo'] == 'deletar') {
    echo $saida;
} else {
    include("Views/Shared/Header.php");
    echo $saida;
    include("Views/Shared/Footer.php");
}
