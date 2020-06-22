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

        <h1>
            <?php
            if (!empty($_GET)) {
            ?>
                <?php
                $a = $_GET['lado1'];
                $b = $_GET['lado2'];
                $c = $_GET['lado3'];

                if (($a + $b > $c) && ($a + $c > $b) && ($b + $c > $a)) {
                    if ($a == $b && $b == $c)
                        echo "Triângulo equilátero";
                    elseif ($a == $b || $a == $c || $b == $c)
                        echo "Triângulo isósceles";
                    else
                        echo "Triângulo escaleno";
                } else
                    echo "O triângulo não existe";
                ?>
            <?php
            }
            ?>
        </h1>
    </div>
    <form action="index.php" method="get">
        <h1>Tipo do Triângulo</h1>

        <label for="lado1">Lado 1</label>
        <input type="text" id="lado1" name="lado1" placeholder="Insira o lado 1 do triângulo" required">

        <label for="lado2">Lado 2</label>
        <input type="text" id="lado2" name="lado2" placeholder="Insira o lado 2 do triângulo" required>

        <label for="lado3">Lado 3</label>
        <input type="text" id="lado3" name="lado3" placeholder="Insira o lado 3 do triângulo " required>

        <button type="submit">Calcular</button>
    </form>
</body>

</html>

</html>