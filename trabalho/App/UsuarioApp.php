<?php

require_once "Data/CommandoContext.php";
require_once 'Models/Usuario.php';

class UsuarioApp
{
    private $db;

    function __construct()
    {
        $this->db = new Connection();
    }

    function obterTodos()
    {
        $sql = "SELECT * FROM usuario ORDER BY id DESC";

        $resultado = $this->db->executarQuery($sql);

        $usuarios = array();

        while ($usuario = $resultado->fetch_object()) {
            $usuarios[] = $usuario;
        }

        if ($usuarios == 0) {
            throw new Exception("Nenhum usuário encontrado");
        }

        return $usuarios;
    }

    function cadastrar($usuario)
    {
        $sql  = "INSERT INTO usuario (nome, email, senha, tipo) 
                 VALUES ('$usuario->nome', '$usuario->email',
                '$usuario->senha', '$usuario->tipo')";

        $resultado = $this->db->executarQuery($sql);

        if ($resultado == 0)
            throw new Exception("Falha ao cadastrar usuário");
    }

    function obterPorId($id)
    {
        $sql = "SELECT * FROM usuario where id = " . (int) $id . "";

        $usuario = $this->db->executarQuery($sql)->fetch_object();

        if ($usuario == null)
            throw new Exception("falha ao obter usuário por id");

        return $usuario;
    }

    function deletar($id)
    {
        $sql = "DELETE FROM usuario WHERE id = $id";

        $resultado = $this->db->executarQuery($sql);

        if ($resultado == 0)
            throw new Exception("Falha ao deletar usário");
    }

    function editar($usuario)
    {
        $sql = "UPDATE usuario SET nome = '$usuario->nome',
                email = '$usuario->email', senha = '$usuario->senha',
                tipo = '$usuario->tipo' WHERE id = $usuario->id";

        $resultado = $this->db->executarQuery($sql);

        if ($resultado == 0)
            throw new Exception("Falha ao editar usuário");
    }
}
