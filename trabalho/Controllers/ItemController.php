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

    public function obterTodos()
    {
        try {
            $itens = $this->itemApp->obterTodos();

            echo json_encode($itens);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
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

    public function editar()
    {
        try {
            $item = $this->itemApp->obterPorId($_GET["id"]);

            include("Views/Item/Editar.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function editarPost()
    {
        try {
            $item = new Item();
            $item->id = $_POST["id"];
            $item->nome = $_POST["nome"];
            $item->preco = $_POST["preco"];
            $item->observacao = $_POST["observacao"];

            if (!empty($_FILES['imagem']['name'])) {
                $item->imagem = "Imagens/" . time() . basename($_FILES['imagem']['name']);
                if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $item->imagem))
                    throw new Exception("falha ao fazer upload de imagem");
            }

            $this->itemApp->editar($item);
            Header("Location: index.php?pagina=item&metodo=index");
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

            if (!empty($_FILES['imagem']['name'])) {
                $item->imagem = "Imagens/" . time() . basename($_FILES['imagem']['name']);
                if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $item->imagem))
                    throw new Exception("falha ao fazer upload de imagem");
            }

            $this->itemApp->cadastrar($item);

            $itens = $this->itemApp->obterTodos();

            Header("Location: index.php?pagina=item&metodo=index");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function deletar()
    {
        try {
            $id = (int) $_GET["id"];
            $this->itemApp->deletar($id);

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
