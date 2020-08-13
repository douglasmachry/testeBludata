<?php 
     require_once('ctrl/ctrl-empresas.php');
    if (isset($_GET['id'])) {
        delete($_GET['id']);
    } else {
        die("ERRO: ID não definido.");
    }
