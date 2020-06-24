<?php

class HomeController
{
    public function index()
    {
        try {

            echo "hello";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
