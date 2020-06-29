<?php

class Professor
{
     var $id;
     var $nome;
     var $registro;
     var $sexo;
     var $titulacao;

     function obterSexo()
     {
          return $this->sexo == "F" ? "Feminino" : "Masculino";
     }
}
