<?php

class HomeController
{
    public function index()
    {
        try {

            echo '<a class="waves-effect waves-light btn">button</a>
            <a class="waves-effect waves-light btn"><i class="material-icons left">cloud</i>button</a>
            <a class="waves-effect waves-light btn"><i class="material-icons right">cloud</i>button</a>
                    ';
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
