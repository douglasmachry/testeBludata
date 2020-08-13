<?php

$fornecedores = null;
$fornecedor = null;
$idEmpresa = null;
$idFornecedor = null;
$telefones = null;

if (isset($_GET['id'])) {
    $idEmpresa = $_GET['id'];
} else {
    header('location: index.php');
}
/**	 *  Listagem de fornecedores	 */
function indexFornecedores()
{
    global $fornecedores, $idEmpresa, $empresa;
    $fornecedores = find('fornecedor', 'id_empresa', $idEmpresa);
    $empresa = find('empresa', 'id_empresa', $idEmpresa);
}

function formatarTelefone($telefone){
    if(strlen(preg_replace("/[^0-9]/", "", $telefone)) == 10){
        $telefoneFormatado = "(".substr($telefone,0,2).")".substr($telefone,2,4)."-".substr($telefone,6,10);
    }else{
        $telefoneFormatado = "(".substr($telefone,0,2).")".substr($telefone,2,5)."-".substr($telefone,7,11);
    }
    return $telefoneFormatado;
}

function loadTelefones($idFornecedor)
{
    $telefones = find('telefone', 'id_fornecedor', $idFornecedor);
    $listaTelefones = "";
    if ($telefones) {
        foreach ($telefones as $telefone) {
            $telefoneFormatado = formatarTelefone($telefone['telefone']);
            $listaTelefones .= "<li style='font-size: 13px; list-style-type:none'>" . $telefoneFormatado . "</li>";
        }
    } else {
        $listaTelefones = "Nenhum";
    }
    return $listaTelefones;
}

function add()
{
    if (!empty($_POST['fornecedor'])) {
        $fornecedor = $_POST['fornecedor'] ?? '';
        

        save('fornecedor', $fornecedor);
        header('location: index.php');
    }
}

function edit()
{
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        if (isset($_POST['fornecedor'])) {
            $fornecedor = $_POST['fornecedor'];
            update('fornecedor', $id, $fornecedor);
            header('location: index.php');
        } else {
            global $fornecedor;
            $fornecedor = find('fornecedor', 'id_fornecedor', $id);
        }
    } else {
        header('location: index.php');
    }
}

function delete($id = null)
{
    global $fornecedor;
    $fornecedor = remove('fornecedor', $id);
    header('location: index.php');
}

function formatCnpjCpf($value)
{
  $cnpj_cpf = preg_replace("/\D/", '', $value);
  
  if (strlen($cnpj_cpf) === 11) {
    return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
  }  
  return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
}