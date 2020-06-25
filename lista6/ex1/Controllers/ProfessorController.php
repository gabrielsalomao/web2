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
            $professores = $this->profApp->getAll();
            include("Views/Professor/Index.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function create()
    {
        try {
            include("Views/Professor/Create.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function edit()
    {
        try {
            $id = $_GET['id'];

            $professor = $this->profApp->getById($id);

            include("Views/Professor/Edit.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function createPost()
    {
        try {
            $professor = new Professor();
            $professor->nome = $_POST['nome'];
            $professor->titulacao = $_POST['titulacao'];
            $professor->sexo = $_POST['sexo'];
            $professor->registro = $_POST['registro'];

            $this->profApp->add($professor);

            $professores = $this->profApp->getAll();

            header("Location: Index.php");
        } catch (Exception $e) {
            echo $e->getMessage();
            include("Views/Professor/Create.php");
        }
    }

    function delete()
    {
        try {
            $this->profApp->delete($_GET['id']);
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
