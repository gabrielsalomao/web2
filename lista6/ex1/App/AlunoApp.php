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

    function obterTodos()
    {
        $sql = "SELECT * FROM aluno ORDER BY id DESC";

        $resultado = $this->db->executarQuery($sql);

        $alunos = array();

        while ($aluno = $resultado->fetch_object("Aluno")) {
            $alunos[] = $aluno;
        }

        if ($alunos == 0) {
            throw new Exception("falha ao obter alunos");
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

        return $cursos;
    }

    function obterAlunoPorId($id)
    {
        $sql = "SELECT * FROM aluno where id = $id";

        $aluno = $this->db->executarQuery($sql)->fetch_object('Aluno');

        if (empty($aluno))
            throw new Exception("falha ao obter aluno por id");

        return $aluno;
    }

    static function cadastrarCursosDoAluno($alunoId, $cursos)
    {
        $db =  new Connection();

        foreach ($cursos as $cursoId) {
            $sql = "INSERT INTO curso_aluno (curso, aluno) 
                    VALUES ($cursoId, $alunoId)";

            $resultado = $db->executarQuery($sql);

            if ($resultado == 0) {
                throw new Exception("falha ao cadastrar curso do aluno");
            }
        }
    }

    static function obterUltimoAluno()
    {
        $sql = "SELECT * FROM aluno ORDER BY id DESC LIMIT 1";

        $db =  new Connection();

        $resultado = $db->executarQuery($sql)->fetch_object('Aluno');

        if (empty($resultado))
            throw new Exception("falha ao obter ultimo aluno");

        return $resultado;
    }

    function cadastrar(Aluno $aluno)
    {
        $dt = \DateTime::createFromFormat('d/m/Y', $aluno->data_nascimento);

        $dataFormatada = $dt->format('Y-m-d');

        $sql = "INSERT INTO aluno (nome, sexo, data_nascimento, registro)
                VALUES ('$aluno->nome', '$aluno->sexo','$dataFormatada', $aluno->registro)";

        $resultado = $this->db->executarQuery($sql);

        if ($resultado == 0) {
            throw new Exception("falha ao cadastrar aluno");
        }

        if (!empty($aluno->cursos)) {
            $ultimoAluno = self::obterUltimoAluno();

            $cursoIds = explode(",", $aluno->cursos);

            self::cadastrarCursosDoAluno($ultimoAluno->id, $cursoIds);
        }

        return true;
    }

    function editar(Aluno $aluno)
    {
        try {
            $sql = "DELETE FROM curso_aluno WHERE aluno = $aluno->id";

            $this->db->executarQuery($sql);

            if (!empty($aluno->cursos)) {
                $cursoIds = explode(",", $aluno->cursos);

                self::cadastrarCursosDoAluno($aluno->id, $cursoIds);
            }

            $dt = \DateTime::createFromFormat('d/m/Y', $aluno->data_nascimento);

            $dataFormatada = $dt->format('Y-m-d');

            $sql = "UPDATE aluno SET nome = '$aluno->nome', sexo = '$aluno->sexo',
                    data_nascimento = '$dataFormatada', registro = $aluno->registro
                    WHERE id = $aluno->id";

            $resultado = $this->db->executarQuery($sql);

            if ($resultado == 0)
                throw new Exception("erro ao editar aluno");
        } catch (Exception $e) {
            echo "erro";
        }
    }

    public function deletar($id)
    {
        $sql = "DELETE FROM curso_aluno WHERE aluno = $id";

        $result = $this->db->executarQuery($sql);

        if ($result == 0) {
            throw new Exception("erro ao deletar");
        } else {
            $sql = "DELETE FROM aluno WHERE id = $id";

            $result = $this->db->executarQuery($sql);

            if ($result == 0)
                throw new Exception("erro ao deletar aluno");
        }
    }
}
