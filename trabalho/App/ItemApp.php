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
        $sql  = "INSERT INTO item (nome, observacao, preco, imagem) 
                 VALUES ('$item->nome', '$item->observacao', $item->preco, '$item->imagem')";

        $resultado = $this->db->executarQuery($sql);

        if ($resultado == 0)
            throw new Exception("Falha ao cadastrar item");
    }

    function obterPorId($id)
    {
        $sql = "SELECT * FROM item where id = " . (int) $id . "";

        $item = $this->db->executarQuery($sql)->fetch_object('Item');

        if ($item == null)
            throw new Exception("falha ao obter item por id");

        return $item;
    }

    function deletar($id)
    {
        $itemApp = new ItemApp();

        $itemFoto = $itemApp->obterPorId((int) $id)->imagem;

        if (file_exists($itemFoto))
            unlink($itemFoto);

        $sql = "DELETE FROM item WHERE id = $id";

        $resultado = $this->db->executarQuery($sql);

        if ($resultado == 0)
            throw new Exception("Falha ao deletar item");
    }

    function editar(Item $item)
    {
        $editarImage = $item->imagem != null;

        $sql = "UPDATE item SET nome = '$item->nome',
                preco = $item->preco, observacao = '$item->observacao'" . ($editarImage ? ",imagem = '$item->imagem'" : "") . "
                WHERE id = $item->id";

        if ($editarImage) {
            $itemApp = new ItemApp();

            $itemFoto = $itemApp->obterPorId($item->id)->imagem;

            if (file_exists($itemFoto))
                unlink($itemFoto);
        }
        $resultado = $this->db->executarQuery($sql);

        if ($resultado == 0)
            throw new Exception("Falha ao editar item");
    }
}
