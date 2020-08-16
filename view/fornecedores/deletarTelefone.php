<?php 
     require_once('ctrl/ctrl-fornecedores.php');
    if (isset($_GET['id'])) {
        $telefone = find('telefone','id_telefone',$_GET['id']);
        $telefone = $telefone[0];
        delete('telefone',$telefone);
    } else {
        die("ERRO: ID não definido.");
    }
