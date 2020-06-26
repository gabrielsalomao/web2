<?php

class Connection
{
    static  function criarConexao()
    {
        return mysqli_connect("localhost", "root", "", "cursos");
    }

    function executarQuery($query)
    {
        $conexao = self::criarConexao();

        return mysqli_query($conexao, $query);
    }
}
