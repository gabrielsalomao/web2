<?php

require_once "Data/Contexto.php";
require_once 'Models/Aluno.php';

class AlunoApp
{
    private $db;

    function __construct()
    {
        $this->db = new Connection();
    }

    function getAll()
    {
        $sql = "SELECT * FROM aluno";

        $result = $this->db->executarQuery($sql);

        $alunos = array();

        while ($aluno = $result->fetch_object("Aluno")) {
            $alunos[] = $aluno;
        }

        if ($alunos == 0) {
            throw new Exception("erro");
        }

        return $alunos;
    }

    function add(Aluno $aluno)
    {
        $sql = "INSERT INTO aluno (nome, sexo, data_nascimento, registro)
            VALUES ('$aluno->nome', '$aluno->sexo','$aluno->data_nascimento', $aluno->registro)";

        // $result = $this->db->executarQuery($sql);

        if (!empty($aluno->cursos)) {
            $cursoIds = explode(",", $aluno->cursos);

            while ($id = explode(",", $aluno->cursos)) {
                var_dump($id);
            }
        }

        // if ($result == 0) {
        //     throw new Exception("erro");
        // }

        return true;
    }

    function addCursosDoAluno($aluno, $cursos)
    {
    }
}
