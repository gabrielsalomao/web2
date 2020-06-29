<?php

require_once "Data/CommandoContext.php";
require_once 'Models/Item.php';

class ItemApp
{
    private $db;

    function __construct()
    {
        $this->db = new Connection();
    }

    function obterTodos()
    {
        $sql = "SELECT * FROM item ORDER BY id DESC";

        $resultado = $this->db->executarQuery($sql);

        $itens = array();

        while ($item = $resultado->fetch_object("Item")) {
            $itens[] = $item;
        }

        if ($itens == 0) {
            throw new Exception("Nenhum item encontrado");
        }

        return $itens;
    }

    function cadastrar(Item $item)
    {
        $sql  = "INSERT INTO item (nome, observacao, preco) 
                 VALUES ('$item->nome', '$item->observacao', $item->preco)";

        $resultado = $this->db->executarQuery($sql);

        if ($resultado == 0)
            throw new Exception("Falha ao cadastrar item");
    }
}
