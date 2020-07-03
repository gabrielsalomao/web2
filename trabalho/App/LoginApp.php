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

        $usuario = $this->db->executarQuery($sql)->fetch_object();

        if (empty($usuario)) {
            throw new Exception("E-Mail ou senha inválido");
        }

        return $usuario;
    }
}
