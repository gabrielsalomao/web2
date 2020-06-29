<?php

require_once "App/CursoApp.php";
require_once "App/ProfessorApp.php";
require_once "Models/Curso.php";

class CursoController
{

    private $cursoApp;

    function __construct()
    {
        $this->cursoApp = new CursoApp();
        $this->profApp = new ProfessorApp();
    }

    public function index()
    {
        try {
            $cursos = $this->cursoApp->obterTodos();
            include("Views/Curso/Index.php");
        } catch (Exception $e) {
            include("Views/Curso/Index.php");
        }
    }

    public function cadastrar()
    {
        try {
            $professores = $this->profApp->obterTodos();
            include("Views/Curso/Cadastrar.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function editar()
    {
        try {
            $id = $_GET['id'];

            $curso = $this->cursoApp->obterPorId($id);

            $professores = $this->profApp->obterTodos();

            include("Views/Curso/Editar.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function editarPost()
    {
        try {
            $curso = new Curso();
            $curso->id = $_POST['id'];
            $curso->nome = $_POST['nome'];
            $curso->professor = $_POST['professor'];

            $this->cursoApp->editar($curso);

            $cursos = $this->cursoApp->obterTodos();

            header("Location: index.php?pagina=curso&metodo=index");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function cadastrarPost()
    {
        try {
            $curso = new Curso();
            $curso->nome = $_POST['nome'];
            $curso->professor = $this->profApp->obterPorId((int) $_POST['professor']);

            $this->cursoApp->cadastrar($curso);

            $cursos = $this->cursoApp->obterTodos();

            header("Location: index.php?pagina=curso&metodo=index");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function deletar()
    {
        try {
            $this->cursoApp->deletar($_GET['id']);
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
