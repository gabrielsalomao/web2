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
        include("Views/Login/Index.php");
    }

    public function realizarLogin()
    {
        try {
            $usuario = $this->loginApp->obterUsuarioLogin($_POST["loginEmail"], $_POST["loginSenha"]);


            // call_user_func(array(new ComandaController(), "index"));

            Header("Location: index.php?pagina=comanda&metodo=index");
            $_SESSION["usuario"] = $usuario;
        } catch (Exception $e) {
            echo $e->getMessage();
            Header("Location: Views/Login/index.php");
        }
    }
}
