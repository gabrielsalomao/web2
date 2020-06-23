<?php
session_start();
if (isset($_GET['codigo'])) {
    $i = (int) $_GET['codigo'];
    unset($_SESSION['time'][$i]);

    // corrige as posicoes do array
    $_SESSION['time'] = array_values($_SESSION['time']);
}

header('Location: index.php');
