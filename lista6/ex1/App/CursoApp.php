<?php

require_once 'Data/Contexto.php';
require_once 'Models/Curso.php';
require_once 'App/ProfessorApp.php';

class CursoApp
{
    private $db;

    function __construct()
    {
        $this->db = new Connection();
        $this->profApp = new ProfessorApp();
    }

    public function obterTodos()
    {
        $sql = "SELECT c.id id, c.nome nome, p.id professor 
                FROM curso c JOIN professor p
                ON c.professor = p.id ORDER BY id DESC";

        $resultado = $this->db->executarQuery($sql);

        $cursos = array();

        while ($row = $resultado->fetch_object('Curso')) {
            $row->professor = $this->profApp->obterPorId($row->professor);
            $cursos[] = $row;
        }

        if (!$cursos) {
            throw new Exception('Não foi encontrado nenhum registro no banco');
        }

        return $cursos;
    }

    public function cadastrar(Curso $curso)
    {
        $sql = "INSERT INTO curso (nome, professor)
                VALUES ('$curso->nome', " . $curso->professor->id . ")";

        $resultado = $this->db->executarQuery($sql);

        if ($resultado == 0) {
            throw new Exception("falha ao cadastrar");
        }

        return true;
    }


    public function obterPorId($id)
    {
        $sql = "SELECT * FROM curso WHERE id = $id ";

        $resultado = $this->db->executarQuery($sql);

        $curso = $resultado->fetch_object("Curso");

        if (!isset($curso))
            throw new Exception("falha ao obter por id");

        return $curso;
    }

    public function editar(Curso $curso)
    {
        $sql = "UPDATE curso SET nome = '$curso->nome',
                professor = " . $curso->professor . " WHERE id = $curso->id";

        $resultado = $this->db->executarQuery($sql);

        if ($resultado == 0)
            throw new Exception("falha ao editar curso");

        return true;
    }

    public function deletar($id)
    {
        $sql = "DELETE FROM curso WHERE id = $id";

        $resultado = $this->db->executarQuery($sql);

        if ($resultado == 0)
            throw new Exception("falha ao deletar curso");

        return true;
    }
}
