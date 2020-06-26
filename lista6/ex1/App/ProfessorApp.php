<?php
require_once 'Data/Contexto.php';
require_once 'Models/Professor.php';

class ProfessorApp
{
    private $db;

    function __construct()
    {
        $this->db = new Connection();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM professor ORDER BY id DESC";

        $resultado = $this->db->executarQuery($sql);

        $professores = array();

        while ($professor = $resultado->fetch_object('Professor')) {
            $professores[] = $professor;
        }

        if (!$professores) {
            throw new Exception('Não foi encontrado nenhum registro no banco');
        }

        return $professores;
    }

    public function add(Professor $professor)
    {
        if (empty($professor->nome)) {
            throw new Exception("Nome é obrigatório");

            return false;
        }

        $sql = "INSERT INTO professor (nome, registro, titulacao, sexo)
                VALUES ('$professor->nome', '$professor->registro',
                '$professor->titulacao', '$professor->sexo')";

        $result = $this->db->executarQuery($sql);

        if ($result == 0) {
            throw new Exception("Falha ao inserir professor");
        }

        return true;
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM professor where id = $id";

        $result = $this->db->executarQuery($sql)->fetch_object('Professor');

        if (!$result) {
            throw new Exception('Não foi encontrado nenhum registro no banco');
        } else {
            // $resultado->comentarios = Comentario::selecionarComentarios($resultado->id);
        }

        return $result;
    }

    public function edit(Professor $professor)
    {
        $sql = "UPDATE professor SET nome = '$professor->nome', 
                registro = '$professor->registro',
                sexo = '$professor->sexo', titulacao = '$professor->titulacao'
                WHERE id = $professor->id";

        var_dump($sql);

        $result = $this->db->executarQuery($sql);

        if ($result == 0) {
            throw new Exception("Erro ao editar professor");
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM professor WHERE id = $id";

        $result = $this->db->executarQuery($sql);

        if ($result == 0)
            throw new Exception("erro");

        return true;
    }
}
