<?php

require_once "App/AlunoApp.php";
require_once "App/CursoApp.php";

class AlunoController
{
    private $alunoApp;

    function __construct()
    {
        $this->alunoApp = new AlunoApp();
        $this->cursoApp = new CursoApp();
    }

    function index()
    {
        try {
            $alunos = $this->alunoApp->getAll();

            include("Views/Aluno/Index.php");
        } catch (Exception $e) {
            include("Views/Aluno/Index.php");
        }
    }

    function create()
    {
        $cursos = $this->cursoApp->getAll();

        include("Views/Aluno/Create.php");
    }

    function createPost()
    {
        try {
            $aluno = new Aluno();
            $aluno->nome = $_POST['nome'];
            $aluno->sexo = $_POST['sexo'];
            $aluno->data_nascimento = $_POST['data_nascimento'];
            $aluno->registro = $_POST['registro'];
            $aluno->cursos = $_POST['cursos'];

            $this->alunoApp->add($aluno);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        header("Location: index.php?pagina=aluno&metodo=index");
    }

    function edit()
    {
        $id = $_GET["id"];

        $aluno = $this->alunoApp->obterAlunoPorId($id);

        $cursosDoAluno = $this->alunoApp->obterCursosDoAluno($id);

        include("Views/Aluno/Editar.php");
    }
}
