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

    function calcularIdade($datanasc)
    {
      list($ano, $mes, $dia) = explode('-', $datanasc);

      $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));

      $nascimento = mktime(0, 0, 0, $mes, $dia, $ano);

      return floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
    }

    if (!empty($_POST)) {
    ?>
      <?php
      $nome = $_POST['nome'];
      $sobrenome = $_POST['sobrenome'];
      $sexo = $_POST['sexo'];
      $profissao = $_POST['profissao'];
      $datanasc = $_POST['datanasc'];
      $rg = $_POST['rg'];
      $cpf = $_POST['cpf'];
      $altura = $_POST['altura'];
      $peso = $_POST['peso'];
      $idade = calcularIdade($datanasc);
      $podeTirarHabilitacao = $idade >= 18 ? true : false;
      $ehObrigatorioVotar = $idade <= 18 ? false : true;
      $ehObrigatorioSeAlistar = $idade >= 18 ? true : false;

      echo "<table>
            <tr>
              <th>Nome</th>
              <th>Sexo</th>
              <th>Profissão</th>
              <th>Data de Nascimento</th>
              <th>RG</th>
              <th>CPF</th>
              <th>Altura</th>
              <th>Peso</th>
            </tr>
            <tr>
              <td>$nome $sobrenome</td>
              <td>" . ($sexo == "F" ? "Feminino" : "Masculino") . "</td>
              <td>$profissao</td>
              <td>$datanasc</td>
              <td>$rg</td>
              <td>$cpf</td>
              <td>$altura</td>
              <td>$peso</td>
            </tr>
          </table>
          </br>
          <ul>
            <li>" . ($podeTirarHabilitacao ? "Pode tirar habilitação" : "Não pode tirar habilitação") . "</li>
            <li>" . ($ehObrigatorioVotar ? "Votar é obrigatório" : "Votar não é obrigátorio") . "</li>
            <li>" . ($ehObrigatorioSeAlistar ? "É obrigatório se alistar" : "Não precisa se alistar") . "</li>
          </ul>
          ";
      ?>
    <?php
    }
    ?>
  </div>
</body>

</html>

</html>