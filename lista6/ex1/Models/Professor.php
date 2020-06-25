<?php

class Professor
{
     var $id;
     var $nome;
     var $registro;
     var $sexo;
     var $titulacao;

     function getSexo()
     {
          return $this->sexo == "F" ? "Feminino" : "Masculino";
     }
}
