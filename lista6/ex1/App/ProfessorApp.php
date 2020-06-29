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

    public function obterTodos()
    {
        $sql = "SELECT * FROM professor ORDER BY id DESC";

        $resultado = $this->db->executarQuery($sql);

        $professores = array();

        while ($professor = $resultado->fetch_object('Professor')) {
            $professores[] = $professor;
        }

        if (!$professores) {
            throw new Exception('falha ao obter professores');
        }

        return $professores;
    }

    public function cadastrar(Professor $professor)
    {
        $sql = "INSERT INTO professor (nome, registro, titulacao, sexo)
                VALUES ('$professor->nome', '$professor->registro',
                '$professor->titulacao', '$professor->sexo')";

        $result = $this->db->executarQuery($sql);

        if ($result == 0) {
            throw new Exception("falha ao cadastrar professor");
        }
    }

    public function obterPorId($id)
    {
        $sql = "SELECT * FROM professor where id = $id";

        $professor = $this->db->executarQuery($sql)->fetch_object('Professor');

        if (!$professor) {
            throw new Exception('falha ao obter por id');
        }

        return $professor;
    }

    public function editar(Professor $professor)
    {
        $sql = "UPDATE professor SET nome = '$professor->nome', 
                registro = '$professor->registro',
                sexo = '$professor->sexo', titulacao = '$professor->titulacao'
                WHERE id = $professor->id";

        $resultado = $this->db->executarQuery($sql);

        if ($resultado == 0) {
            throw new Exception("falha ao editar professor");
        }
    }

    public function deletar($id)
    {
        $sql = "DELETE FROM professor WHERE id = $id";

        $resultado = $this->db->executarQuery($sql);

        if ($resultado == 0)
            throw new Exception("falha ao deletar professor");

        return true;
    }
}
