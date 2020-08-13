<?php

class Empresa
{
    private $nome;
    private $cpnj;
    private $uf;


    public function __construct($nome,$cpnj,$uf)
    {
        $this->setNome($nome);
        $this->setCnpj($cpnj);
        $this->setUf($uf);
    }


    function setNome($nome)
    {
        $this->nome = $nome;
    }
    function getNome()
    {
        return $this->nome;
    }
    function setCnpj($cpnj)
    {
        $this->cpnj = $cpnj;
    }
    function getCnpj()
    {
        return $this->cpnj;
    }
    function setUf($uf)
    {
        $this->uf = $uf;
    }
    function getUf()
    {
        return $this->uf;
    }
}
