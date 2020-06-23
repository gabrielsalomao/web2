<?php
if (!empty($_POST)) {
    session_start();

    $codigo = $_POST['codigo'];

    $time = array(
        'nome' => $_POST['nome'],
        'mascote' => $_POST['mascote'],
        'principalRival' => $_POST['principalRival'],
        'fundacao' => $_POST['fundacao'],
        'estadio' => $_POST['estadio'],
        'presidente' => $_POST['presidente'],
        'treinador' => $_POST['treinador'],
        'patrocinador' => $_POST['patrocinador'],
    );

    $_SESSION['time'][$codigo] = $time;

    header('Location: index.php');
} else {
    header('Location: editar.php');
}
