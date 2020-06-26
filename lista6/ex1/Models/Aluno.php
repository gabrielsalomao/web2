<?php

class Aluno
{
    var $id;
    var $nome;
    var $sexo;
    var $data_nascimento;
    var $registro;
    var $cursos;

    function getSexo()
    {
        return $this->sexo == "F" ? "Feminino" : "Masculino";
    }

    function getDataFormatada()
    {
        $date = new DateTime($this->data_nascimento);
        echo $date->format('d/m/Y');
    }
}
