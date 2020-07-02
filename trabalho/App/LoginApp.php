<?php

require_once "Data/CommandoContext.php";

class LoginApp
{
    private $db;

    function __construct()
    {
        $this->db = new Connection();
    }

    function obterUsuarioLogin($email, $senha)
    {
        $sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";

        $resultado = $this->db->executarQuery($sql)->fetch_object();

        if (empty($resultado)) {
            throw new Exception("Usuário não encontrado");
        }

        var_dump($resultado);
    }
}
