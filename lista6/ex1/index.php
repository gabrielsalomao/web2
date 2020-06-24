<?php
require_once 'StartUp.php';

ob_start();
$core = new StartUp;
$core->start($_GET);
$saida = ob_get_contents();
ob_end_clean();

$tplPronto = str_replace('{{area_dinamica}}', $saida, $template);

echo $tplPronto;
