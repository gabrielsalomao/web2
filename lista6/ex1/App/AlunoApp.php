<?php

require_once "Data/Contexto.php";
require_once 'Models/Aluno.php';
require_once 'Models/Curso.php';

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

    function obterCursosDoAluno($id)
    {
        $sql = "SELECT c.id, c.nome FROM curso AS c
                JOIN curso_aluno AS ca 
                ON c.id = ca.curso JOIN aluno AS a 
                ON a.id = ca.aluno WHERE ca.aluno = $id";

        $resultado = $this->db->executarQuery($sql);

        $cursos = array();

        while ($row = $resultado->fetch_object('Curso')) {
            $cursos[] = $row;
        }

        if (!$cursos) {
            throw new Exception('Não foi encontrado nenhum registro no banco');
        }

        return $cursos;
    }

    function obterAlunoPorId($id)
    {
        $sql = "SELECT * FROM aluno where id = $id";

        $aluno = $this->db->executarQuery($sql)->fetch_object('Aluno');

        if (empty($aluno))
            throw new Exception("nenhum aluno encontrado");

        return $aluno;
    }

    static function addCursosDoAluno($alunoId, $cursos)
    {
        $db =  new Connection();

        foreach ($cursos as $cursoId) {
            $sql = "INSERT INTO curso_aluno (curso, aluno) 
                    VALUES ($cursoId, $alunoId)";

            $result = $db->executarQuery($sql);

            if ($result == 0) {
                throw new Exception("erro");
            }
        }

        return true;
    }

    static function obterUltimoAluno()
    {
        $sql = "SELECT * FROM aluno ORDER BY id DESC LIMIT 1";

        $db =  new Connection();

        $result = $db->executarQuery($sql)->fetch_object('Aluno');

        if (empty($result))
            throw new Exception("erro");

        return $result;
    }

    function add(Aluno $aluno)
    {
        $sql = "INSERT INTO aluno (nome, sexo, data_nascimento, registro)
                VALUES ('$aluno->nome', '$aluno->sexo','$aluno->data_nascimento', $aluno->registro)";

        $result = $this->db->executarQuery($sql);

        if ($result == 0) {
            throw new Exception("erro");
        }

        if (!empty($aluno->cursos)) {
            $ultimoAluno = self::obterUltimoAluno();

            $cursoIds = explode(",", $aluno->cursos);

            self::addCursosDoAluno($ultimoAluno->id, $cursoIds);
        }

        return true;
    }
}
