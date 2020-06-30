<?php

require_once "App/ComandaApp.php";

class ComandaController
{
    private $comandaApp;

    function __construct()
    {
        $this->comandaApp = new ComandaApp();
    }

    public function index()
    {
        try {

            include("Views/Comanda/Index.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
