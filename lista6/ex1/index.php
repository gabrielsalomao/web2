<?php

require_once 'StartUp.php';
require_once 'Controllers/ProfessorController.php';
require_once 'Controllers/CursoController.php';
require_once 'Controllers/AlunoController.php';

ob_start();
$core = new StartUp;
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
