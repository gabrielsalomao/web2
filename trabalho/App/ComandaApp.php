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

    function deletar($id)
    {
        $sql = "DELETE FROM comanda_item WHERE comandaId = $id";

        $resultado = $this->db->executarQuery($sql);

        if ($resultado == 0)
            throw new Exception("Falha ao deletar comanda");

        $sql = "DELETE FROM comanda WHERE id = $id";

        $resultado = $this->db->executarQuery($sql);

        if ($resultado == 0)
            throw new Exception("Falha ao deletar comanda");
    }

    function obterTodos()
    {
        $sql = "SELECT c.id, c.mesa, c.observacao, c.status, u.nome as usuarioNome
                FROM comanda c JOIN usuario u ON u.id = usuarioId ORDER BY c.id DESC";

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
        $sql = "SELECT c.id, c.mesa, c.observacao, c.status, u.nome as usuarioNome
        FROM comanda c JOIN usuario u ON u.id = usuarioId WHERE c.id = $id";

        $comanda = $this->db->executarQuery($sql)->fetch_object();

        $sql = "SELECT i.nome as itemNome, ci.qnt as itemQnt, i.preco as itemPreco, i.id as itemId  FROM item i 
                    JOIN comanda_item ci ON ci.itemId = i.id 
                    WHERE ci.comandaId = $comanda->id";

        $itensResult = $this->db->executarQuery($sql);

        while ($item = $itensResult->fetch_object()) {
            $itens[] = $item;
        }

        if (!empty($itens)) {
            $comanda->itens = $itens;
        }

        return $comanda;
    }

    function cadastrar($comanda)
    {
        if ($comanda->mesa == null)
            throw new Exception("Mesa obrigatória");

        $sql = "INSERT INTO comanda (observacao, mesa, usuarioId)
                VALUES ('$comanda->observacao', $comanda->mesa, 1)";

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

    function editar($comanda)
    {
        $sql = "UPDATE comanda SET observacao = '$comanda->observacao', 
                status = '$comanda->status', mesa = " . ((int) $comanda->mesa ?? 0) . "
                WHERE id = $comanda->id";

        $resultado = $sql = $this->db->executarQuery($sql);

        if ($resultado == 0) {
            throw new Exception("falha ao editar comanda");
        } else {
            $sql = "DELETE FROM comanda_item WHERE comandaId = $comanda->id";

            $resultado = $sql = $this->db->executarQuery($sql);

            foreach ($comanda->itens as $item) {
                $item = (object) $item;

                $sql = "INSERT INTO comanda_item (comandaId, itemId, qnt)
                        VALUES ($comanda->id, $item->id, $item->qnt);";

                $resultado = $sql = $this->db->executarQuery($sql);

                if ($resultado == 0) {
                    throw new Exception("falha ao editar itens da comanda");
                }
            }
        }
    }
}
