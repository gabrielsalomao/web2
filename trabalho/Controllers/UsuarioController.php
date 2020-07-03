<?php

require_once "App/UsuarioApp.php";
require_once "Models/Usuario.php";

class UsuarioController
{
    private $usuarioApp;

    function __construct()
    {
        $this->usuarioApp = new UsuarioApp();
    }

    public function index()
    {
        try {
            $usuarios = $this->usuarioApp->obterTodos();

            include("Views/Usuario/Index.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function cadastrar()
    {
        try {
            include("Views/Usuario/Cadastrar.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function editar()
    {
        try {
            $usuario = $this->usuarioApp->obterPorId($_GET["id"]);

            include("Views/Usuario/Editar.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function editarPost()
    {
        try {
            $usuario = new Usuario();
            $usuario->id = $_POST["id"];
            $usuario->nome = $_POST["nome"];
            $usuario->email = $_POST["email"];
            $usuario->senha = $_POST["senha"];
            $usuario->tipo = $_POST["tipo"];

            $this->usuarioApp->editar($usuario);

            header("Location: index.php?pagina=usuario&metodo=index");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function cadastrarPost()
    {
        try {
            $usuario = new Usuario();
            $usuario->nome = $_POST["nome"];
            $usuario->email = $_POST["email"];
            $usuario->senha = $_POST["senha"];
            $usuario->tipo = $_POST["tipo"];

            $this->usuarioApp->cadastrar($usuario);

            $usuarios = $this->usuarioApp->obterTodos();

            header("Location: index.php?pagina=usuario&metodo=index");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function deletar()
    {
        try {
            $id = (int) $_GET["id"];

            $this->usuarioApp->deletar($id);

            $response = (object) [
                'success' => true,
                'message' => 'Deletado com sucesso'
            ];

            echo json_encode($response);
        } catch (Exception $e) {
            $response = (object) [
                'success' => false,
                'message' => $e->getMessage()
            ];

            echo json_encode($response);
        }
    }
}
