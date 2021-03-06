<?php

class Core
{
    public function start($urlGet)
    {
        if (isset($urlGet['metodo'])) {
            $acao = $urlGet['metodo'];
        } else {
            $acao = 'index';
        }

        if (isset($urlGet['pagina'])) {
            if (!isset($_COOKIE['usuario']) || $_COOKIE['usuario'] == NULL) {
                $controller = 'LoginController';
            } else {
                $controller = ucfirst($urlGet['pagina'] . 'Controller');
            }
        } else {
            if (!isset($_COOKIE['usuario']) || $_COOKIE['usuario'] == NULL) {
                $controller = 'LoginController';
            } else {
                $controller = 'ComandaController';
            }
        }

        if (!class_exists($controller)) {
            $controller = 'ErroController';
        }

        if (isset($urlGet['id']) && $urlGet['id'] != null) {
            $id = $urlGet['id'];
        } else {
            $id = null;
        }

        call_user_func(array(new $controller, $acao), array('id' => $id));
    }
}
