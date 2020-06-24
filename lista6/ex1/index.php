<?php

require_once 'StartUp.php';
require_once 'Controllers/HomeController.php';

ob_start();
$core = new StartUp;
$core->start($_GET);
$saida = ob_get_contents();
ob_end_clean();

include("Views/shared/header.php");
echo $saida;
include("Views/shared/footer.php");
