<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Times de Futebol</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row m-2">
            <div class="col-md">
                <div class="form-group">
                    <a href="cadastrar.php" class="btn-success btn">Cadastrar time</a>
                    <a href="deletarTudo.php" class="btn-danger btn">Apagar tudo</a>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Mascote</th>
                            <th scope="col">Principal Rival</th>
                            <th scope="col">Fundação</th>
                            <th scope="col">Estádio</th>
                            <th scope="col">Presidente</th>
                            <th scope="col">Treinador</th>
                            <th scope="col">Patrocinador</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        session_start();
                        for ($i = 0; isset($_SESSION['time']) and $i < sizeof($_SESSION['time']); $i++) {
                        ?>
                            <tr>
                                <th><?= $i ?></th>
                                <td><?= $_SESSION['time'][$i]['nome'] ?></td>
                                <td><?= $_SESSION['time'][$i]['mascote'] ?></td>
                                <td><?= $_SESSION['time'][$i]['principalRival'] ?></td>
                                <td><?= $_SESSION['time'][$i]['fundacao'] ?></td>
                                <td><?= $_SESSION['time'][$i]['estadio'] ?></td>
                                <td><?= $_SESSION['time'][$i]['presidente'] ?></td>
                                <td><?= $_SESSION['time'][$i]['treinador'] ?></td>
                                <td><?= $_SESSION['time'][$i]['patrocinador'] ?></td>
                                <td>
                                    <a class="btn-danger btn" href="deletar.php?codigo=<?= $i ?>">Apagar</a>
                                    <a class="btn-primary btn" href="editar.php?codigo=<?= $i ?>">Editar</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</html>