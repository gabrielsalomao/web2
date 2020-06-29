<?php

class Aluno
{
    var $id;
    var $nome;
    var $sexo;
    var $data_nascimento;
    var $registro;
    var $cursos;

    function obterSexo()
    {
        return $this->sexo == "F" ? "Feminino" : "Masculino";
    }

    function obterDataFormatada()
    {
        $data = new DateTime($this->data_nascimento);
        echo $data->format('d/m/Y');
    }
}
