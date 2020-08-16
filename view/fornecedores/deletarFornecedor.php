<?php 
     require_once('ctrl/ctrl-fornecedores.php');
    if (isset($_GET['id'])) {
        $fornecedor = find('fornecedor','id_fornecedor',$_GET['id']);
        $fornecedor = $fornecedor[0];
        delete('fornecedor',$fornecedor);
    } else {
        die("ERRO: ID não definido.");
    }
