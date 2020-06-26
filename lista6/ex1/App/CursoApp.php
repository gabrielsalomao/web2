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

    public function getAll()
    {
        $sql = "SELECT c.id id, c.nome nome, p.id professor 
                FROM curso c JOIN professor p
                ON c.professor = p.id";

        $resultado = $this->db->executarQuery($sql);

        $cursos = array();

        while ($row = $resultado->fetch_object('Curso')) {
            $row->professor = $this->profApp->getById($row->professor);
            $cursos[] = $row;
        }

        if (!$cursos) {
            throw new Exception('Não foi encontrado nenhum registro no banco');
        }

        return $cursos;
    }

    public function add(Curso $curso)
    {
        $sql = "INSERT INTO curso (nome, professor)
                VALUES ('$curso->nome', " . $curso->professor->id . ")";

        $result = $this->db->executarQuery($sql);

        if ($result == 0) {
            throw new Exception("Falha ao inserir curso");
        }

        return true;
    }


    public function getById($id)
    {
        $sql = "SELECT * FROM curso WHERE id = $id ";

        $result = $this->db->executarQuery($sql);

        $curso = $result->fetch_object("Curso");

        if (!isset($curso))
            throw new Exception("erro");

        return $curso;
    }

    public function edit(Curso $curso)
    {
        $sql = "UPDATE curso SET nome = '$curso->nome',
                professor = " . $curso->professor . " WHERE id = $curso->id";

        $result = $this->db->executarQuery($sql);

        if ($result == 0)
            throw new Exception("erro");

        return true;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM curso WHERE id = $id";

        $result = $this->db->executarQuery($sql);

        if ($result == 0)
            throw new Exception("erro");

        return true;
    }
}
