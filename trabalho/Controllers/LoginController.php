<?php

require_once "App/LoginApp.php";
require_once "Controllers/ComandaController.php";

class LoginController
{
    private $loginApp;

    function __construct()
    {
        $this->loginApp = new LoginApp();
    }

    public function index()
    {
        try {

            include("Views/Login/Index.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function realizarLogin()
    {
        try {
            $usuario = $this->loginApp->obterUsuarioLogin($_POST["loginEmail"], $_POST["loginSenha"]);

            setcookie('usuario', json_encode($usuario));

            header("Location: index.php?pagina=comanda&metodo=index");
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();

            include("Views/Login/Index.php");
        }
    }
}
