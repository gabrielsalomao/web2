<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Times de Futebol</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <?php
    $codigo = (int) $_GET['codigo'];
    session_start();

    if (isset($_SESSION['time'][$codigo])) {
        $time =  $_SESSION['time'][$codigo];
    ?>
        <div class="container">
            <form class="m-2" method="post" action="editar_post.php">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="hidden" value="<?= $codigo ?>" name="codigo">
                        <label for="nome">Nome</label>
                        <input value="<?= $time['nome'] ?>" name="nome" type="text" class="form-control" id="nome" placeholder="Insira o nome">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="mascote">Mascote</label>
                        <input value="<?= $time['mascote'] ?>" name="mascote" type="text" class="form-control" id="mascote" placeholder="Insira o mascote">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="principalRival">Principal rival</label>
                        <input value="<?= $time['principalRival'] ?>" name="principalRival" type="text" class="form-control" id="principalRival" placeholder="Insira o principal rival">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fundacao">Fundação</label>
                        <input value="<?= $time['fundacao'] ?>" name="fundacao" type="text" class="form-control" id="fundacao" placeholder="Insira o fundação">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="estadio">Estádio</label>
                        <input value="<?= $time['estadio'] ?>" name="estadio" type="text" class="form-control" id="estadio" placeholder="Insira o estádio">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="presidente">Presidente</label>
                        <input value="<?= $time['presidente'] ?>" name="presidente" type="text" class="form-control" id="presidente" placeholder="Insira o presidente">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="treinador">Treinador</label>
                        <input value="<?= $time['treinador'] ?>" name="treinador" type="text" class="form-control" id="treinador" placeholder="Insira o treinador">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="patrocinador">Patrocinador</label>
                        <input value="<?= $time['patrocinador'] ?>" name="patrocinador" type="text" class="form-control" id="patrocinador" placeholder="Insira o patrocinador">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Editar</button>
                <a href="index.php" class="btn btn-secondary">Voltar</a>
            </form>
        </div>
    <?php
    } else {
    ?>
        Time não encontrado
    <?php
    }
    ?>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</html>