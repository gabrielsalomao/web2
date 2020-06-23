<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="info.php" method="post">
        <h1>Cadastro de pessoa</h1>

        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" placeholder="Insira o nome" required">

        <label for="sobrenome">Sobrenome</label>
        <input type="text" id="sobrenome" name="sobrenome" placeholder="Insira o sobrenome" required>

        <label for="sexo">Sexo</label>
        <select name="sexo" id="sexo">
            <option value="F" selected>Feminino</option>
            <option value="M">Masculino</option>
        </select>

        <label for="profissao">Profissão</label>
        <input type="text" id="profissao" name="profissao" placeholder="Insira a profissão" required>

        <label for="datanasc">Data de nascimento</label>
        <input type="date" id="datanasc" name="datanasc" placeholder="Insira a data de nascimento" required>

        <label for="rg">RG</label>
        <input type="text" id="rg" name="rg" placeholder="Insira o rg" required>

        <label for="cpf">CPF</label>
        <input type="text" id="cpf" name="cpf" placeholder="Insira o cpf" required>

        <label for="altura">Altura</label>
        <input type="text" id="altura" name="altura" placeholder="Insira a altura" required>

        <label for="peso">Peso</label>
        <input type="text" id="peso" name="peso" placeholder="Insira o peso" required>

        <button type="submit">Cadastrar</button>
    </form>
</body>

</html>

</html>