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
            $cursos = $this->cursoApp->getAll();
            include("Views/Curso/Index.php");
        } catch (Exception $e) {
            include("Views/Curso/Index.php");
        }
    }

    public function create()
    {
        try {
            $professores = $this->profApp->getAll();
            include("Views/Curso/Create.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function edit()
    {
        try {
            $id = $_GET['id'];

            $curso = $this->cursoApp->getById($id);

            $professores = $this->profApp->getAll();

            include("Views/Curso/Edit.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function editPost()
    {
        try {
            $curso = new Curso();
            $curso->id = $_POST['id'];
            $curso->nome = $_POST['nome'];
            $curso->professor = $_POST['professor'];

            $this->cursoApp->edit($curso);

            $cursos = $this->cursoApp->getAll();

            header("Location: index.php?pagina=curso&metodo=index");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function createPost()
    {
        try {
            $curso = new Curso();
            $curso->nome = $_POST['nome'];
            $curso->professor = $this->profApp->getById((int) $_POST['professor']);

            $this->cursoApp->add($curso);

            $cursos = $this->cursoApp->getAll();

            header("Location: index.php?pagina=curso&metodo=index");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function delete()
    {
        try {
            $this->cursoApp->delete($_GET['id']);
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
