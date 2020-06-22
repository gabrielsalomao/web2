<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="tabela">
        <?php
        if (!empty($_POST)) {
        ?>
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Capital</th>
                    <th>Moeda</th>
                    <th>População</th>
                    <th>Idioma</th>
                </tr>
                <tr>
                    <td><?= $_POST['nome'] ?></td>
                    <td><?= $_POST['capital'] ?></td>
                    <td><?= $_POST['moeda'] ?></td>
                    <td><?= $_POST['populacao'] ?></td>
                    <td><?= $_POST['idioma'] ?></td>
                </tr>
            </table>
        <?php
        }
        ?>
    </div>
    <form action="index.php" method="post">
        <h1>Cadastrar País</h1>

        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" placeholder="Insira o nome do país" required>

        <label for="capital">Capital</label>
        <input type="text" id="capital" name="capital" placeholder="Insira a capital do país" required>

        <label for="moeda">Moeda</label>
        <input type="text" id="moeda" name="moeda" placeholder="Insira o tipo da moeda do país" required>

        <label for="populacao">População</label>
        <input type="number" id="populacao" name="populacao" placeholder="Insira o número da população do país" required>

        <label for="idioma">Idioma</label>
        <input type="text" id="idioma" name="idioma" placeholder="Insira o idioma do país" required>

        <button type="submit">Cadastrar</button>

    </form>

</body>

</html>