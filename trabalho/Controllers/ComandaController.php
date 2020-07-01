<?php

require_once "App/ComandaApp.php";

class ComandaController
{
    private $comandaApp;

    function __construct()
    {
        $this->comandaApp = new ComandaApp();
    }

    public function index()
    {
        try {
            $comandas = $this->comandaApp->obterTodos();
            include("Views/Comanda/Index.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function obterPorIdViaJson()
    {
        try {
            $comanda = $this->comandaApp->obterComandaPorId($_GET["id"]);

            $response = (object) [
                'success' => true,
                'message' => $comanda
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

    public function cadastrarViaJson()
    {
        try {
            $comanda = json_decode(file_get_contents("php://input"), true);

            $this->comandaApp->cadastrar((object) $comanda);

            $response = (object) [
                'success' => true,
                'message' => "Comanda cadastrada com sucesso"
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
