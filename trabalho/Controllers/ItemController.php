<?php

require_once "App/ItemApp.php";
require_once "Models/Item.php";

class ItemController
{

    private $itemApp;

    function __construct()
    {
        $this->itemApp = new ItemApp();
    }

    public function index()
    {
        try {
            $itens = $this->itemApp->obterTodos();

            include("Views/Item/Index.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function cadastrar()
    {
        try {
            include("Views/Item/Cadastrar.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function cadastrarPost()
    {
        try {
            $item = new Item();
            $item->nome = $_POST["nome"];
            $item->observacao = $_POST["observacao"];
            $item->preco = $_POST["preco"];

            $itens = $this->itemApp->obterTodos();

            $this->itemApp->cadastrar($item);

            Header("Location: index.php?pagina=item&metodo=index");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
