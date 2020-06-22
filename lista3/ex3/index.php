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
                    <th>Decrescente</th>
                    <th>Crescente</th>
                </tr>

                <?php
                $numeros = $_POST["numero"];

                rsort($numeros);
                $decrescente = $numeros;

                sort($numeros);
                $crescente = $numeros;

                $lenght = count($numeros);

                for ($x = 0; $x < $lenght; $x++) {
                    echo "
                <tr>
                    <td>$decrescente[$x]</td>
                    <td>$crescente[$x]</td>
                </tr>";
                }

                ?>
            </table>
        <?php
        }
        ?>
    </div>
    <form action="index.php" method="post">

        <input type="number" name="numero[]" placeholder="Número 1" required>
        <input type="number" name="numero[]" placeholder="Número 2" required>
        <input type="number" name="numero[]" placeholder="Número 3" required>
        <input type="number" name="numero[]" placeholder="Número 4" required>
        <input type="number" name="numero[]" placeholder="Número 5" required>
        <input type="number" name="numero[]" placeholder="Número 6" required>
        <input type="number" name="numero[]" placeholder="Número 7" required>
        <input type="number" name="numero[]" placeholder="Número 8" required>
        <input type="number" name="numero[]" placeholder="Número 9" required>
        <input type="number" name="numero[]" placeholder="Número 10" required>

        <button type="submit">Calcular</button>
    </form>
</body>

</html>

</html>