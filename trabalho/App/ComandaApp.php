<?php

require_once "Data/CommandoContext.php";
require_once 'Models/Comanda.php';

class ComandaApp
{
    private $db;

    function __construct()
    {
        $this->db = new Connection();
    }

    static function obterUltimaComanda()
    {
        $sql = "SELECT * FROM comanda ORDER BY id DESC LIMIT 1";

        $db =  new Connection();

        $resultado = $db->executarQuery($sql)->fetch_object();

        if (empty($resultado))
            throw new Exception("falha ao obter ultima comanda");

        return $resultado;
    }

    function obterTodos()
    {
        $sql = "SELECT c.id, c.observacao, c.status, u.nome as usuarioNome
                FROM comanda c JOIN usuario u ON u.id = usuarioId";

        $resultado = $this->db->executarQuery($sql);

        $comandas = array();

        while ($comanda = $resultado->fetch_object()) {
            $itens = array();

            $sql = "SELECT i.nome as itemNome, ci.qnt as itemQnt, i.preco as itemPreco FROM item i 
            JOIN comanda_item ci ON ci.itemId = i.id 
            WHERE ci.comandaId = $comanda->id";

            $itensResult = $this->db->executarQuery($sql);

            while ($item = $itensResult->fetch_object()) {
                $itens[] = $item;
            }

            $comanda->itens = $itens;

            $comandas[] = $comanda;
        }

        if ($comandas == 0) {
            throw new Exception("Nenhuma comanda encontrada");
        }

        return $comandas;
    }

    function obterComandaPorId($id)
    {
        $sql = "SELECT c.id, c.observacao, c.status, u.nome as usuarioNome
        FROM comanda c JOIN usuario u ON u.id = usuarioId WHERE c.id = $id";

        $comanda = $this->db->executarQuery($sql)->fetch_object();

        if ($comanda == 0) {
            throw new Exception("Nenhuma comanda encontrada");
        }

        $sql = "SELECT i.nome as itemNome, ci.qnt as itemQnt, i.preco as itemPreco FROM item i 
                    JOIN comanda_item ci ON ci.itemId = i.id 
                    WHERE ci.comandaId = $comanda->id";

        $itensResult = $this->db->executarQuery($sql);

        while ($item = $itensResult->fetch_object()) {
            $itens[] = $item;
        }

        $comanda->itens = $itens;

        if ($comanda == 0) {
            throw new Exception("Nenhuma comanda encontrada");
        }

        return $comanda;
    }

    function cadastrar($comanda)
    {
        $sql = "INSERT INTO comanda (observacao, usuarioId)
                VALUES ('$comanda->observacao', 1)";

        $resultado = $sql = $this->db->executarQuery($sql);

        if ($resultado == 0) {
            throw new Exception("falha ao cadastrar comanda");
        } else {
            $ultimaComanda = self::obterUltimaComanda();

            foreach ($comanda->itens as $item) {
                $item = (object) $item;

                $sql = "INSERT INTO comanda_item (comandaId, itemId, qnt)
                        VALUES ($ultimaComanda->id, $item->id, $item->qnt);";

                $resultado = $sql = $this->db->executarQuery($sql);

                if ($resultado == 0) {
                    throw new Exception("erro ao cadastrar itens da comanda");
                }
            }
        }
    }
}
