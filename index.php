<?php
  error_reporting(E_ALL);
  require_once 'config.php';
  require_once DBAPI;
  include(HEADER_TEMPLATE);
  
  $db = open_database();

  if(!isset($_GET['url'])){
    include("view/empresas/empresas.php");
  }else{
    switch($_GET['url']){
      case "fornecedor":
        include("view/fornecedores/fornecedores.php");
        break;
      case "cadastrarEmpresa":
        include("view/empresas/novaEmpresa.php");
        break;
      case "editarEmpresa":
        include("view/empresas/editEmpresa.php");
        break;
      case "deletarEmpresa":
          include("view/empresas/deletarEmpresa.php");
          break;
      default:
        include("view/empresas/empresas.php");  
        break;    
    } 
  }
  
  include("view/modal.php");
 include(FOOTER_TEMPLATE); 
 ?>