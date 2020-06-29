<?php

require_once 'App/ProfessorApp.php';
require_once 'Models/Professor.php';

class ProfessorController
{

    private $profApp;

    function __construct()
    {
        $this->profApp = new ProfessorApp();
    }

    public function index()
    {
        try {
            $professores = $this->profApp->obterTodos();
            include("Views/Professor/Index.php");
        } catch (Exception $e) {
            include("Views/Professor/Index.php");
        }
    }

    public function cadastrar()
    {
        try {
            include("Views/Professor/Cadastrar.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function editar()
    {
        try {
            $id = $_GET['id'];

            $professor = $this->profApp->obterPorId($id);

            include("Views/Professor/Editar.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function cadastrarPost()
    {
        try {
            $professor = new Professor();
            $professor->nome = $_POST['nome'];
            $professor->titulacao = $_POST['titulacao'];
            $professor->sexo = $_POST['sexo'];
            $professor->registro = $_POST['registro'];

            $this->profApp->cadastrar($professor);

            $professores = $this->profApp->obterTodos();

            header("Location: Index.php");
        } catch (Exception $e) {
            echo $e->getMessage();
            include("Views/Professor/Cadastrar.php");
        }
    }

    function deletar()
    {
        try {
            $this->profApp->deletar($_GET['id']);
            $response = (object) [
                'success' => true,
                'message' => 'Deletado com sucesso'
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

    public function editarPost()
    {
        try {
            $professor = new Professor();
            $professor->id = $_POST['id'];
            $professor->nome = $_POST['nome'];
            $professor->titulacao = $_POST['titulacao'];
            $professor->sexo = $_POST['sexo'];
            $professor->registro = $_POST['registro'];

            $this->profApp->editar($professor);

            $professores = $this->profApp->obterTodos();

            header("Location: Index.php");
        } catch (Exception $e) {
            echo $e->getMessage();
            include("Views/Professor/Cadastrar.php");
        }
    }
}
