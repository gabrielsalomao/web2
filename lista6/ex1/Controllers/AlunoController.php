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
            $alunos = $this->alunoApp->obterTodos();

            include("Views/Aluno/Index.php");
        } catch (Exception $e) {
            include("Views/Aluno/Index.php");
        }
    }

    function cadastrar()
    {
        $cursos = $this->cursoApp->obterTodos();

        include("Views/Aluno/Cadastrar.php");
    }

    function cadastrarPost()
    {
        try {
            $aluno = new Aluno();
            $aluno->nome = $_POST['nome'];
            $aluno->sexo = $_POST['sexo'];
            $aluno->data_nascimento = $_POST['data_nascimento'];
            $aluno->registro = $_POST['registro'];
            $aluno->cursos = $_POST['cursos'];

            $this->alunoApp->cadastrar($aluno);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        header("Location: index.php?pagina=aluno&metodo=index");
    }

    function editar()
    {
        $id = $_GET["id"];

        $aluno = $this->alunoApp->obterAlunoPorId($id);

        $cursosDoAluno = $this->alunoApp->obterCursosDoAluno($id);

        $cursos = $this->cursoApp->obterTodos();

        include("Views/Aluno/Editar.php");
    }

    function editarPost()
    {
        try {
            $aluno = new Aluno();
            $aluno->id = $_POST['id'];
            $aluno->nome = $_POST['nome'];
            $aluno->sexo = $_POST['sexo'];
            $aluno->data_nascimento = $_POST['data_nascimento'];
            $aluno->registro = $_POST['registro'];
            $aluno->cursos = $_POST['cursos'];

            $this->alunoApp->editar($aluno);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        header("Location: index.php?pagina=aluno&metodo=index");
    }

    function deletar()
    {
        try {
            $this->alunoApp->deletar($_GET['id']);
            $response = (object) [
                'success' => true,
                'message' => 'deletado com sucesso'
            ];

            echo json_encode($response);
        } catch (Exception $e) {

            $response = (object) [
                'success' => false,
                'message' => $e->getMessage()
            ];

            echo json_encode($response);
        }
    }
}
