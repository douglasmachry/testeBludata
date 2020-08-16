<?php
session_start();
//CARREGAR CONFIGURAÇÕES
require_once 'config.php';
//INFORMAÇÕES DO BANCO DE DADOS
require_once DBAPI;
//INCLUIR CABEÇALHO
include(HEADER_TEMPLATE);
//INTANCIAR BANCO DE DADOS
$db = open_database();
if ($db) {
  if (!isset($_GET['url'])) {
    include("view/empresas/empresas.php");
  } else {
    //INCLUSÃO DE PÁGINAS INTERNAS
    switch ($_GET['url']) {
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
      case "cadastrarFornecedor":
        include("view/fornecedores/novoFornecedor.php");
        break;
      case "editarFornecedor":
        include("view/fornecedores/editFornecedor.php");
        break;
      case "deletarTelefone":
        include("view/fornecedores/deletarTelefone.php");
        break;
        case "deletarFornecedor":
          include("view/fornecedores/deletarFornecedor.php");
          break;
      default:
        include("view/empresas/empresas.php");
        break;
    }
  }
} else {
  echo "Não foi possível conectar ao Banco de Dados";
}

//MODAL A SER ACIONADO QUANDO NECESSÁRIO
include("view/modal.php");
//INCLUIR RODAPÉ
include(FOOTER_TEMPLATE);
