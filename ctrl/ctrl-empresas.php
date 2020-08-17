<?php

$empresas = null;
$empresa = null;
/**	 *  Listagem de Empresas	 */
function indexEmpresas()
{
    global $empresas, $estados;
    $empresas = find_all('empresa');
    $estados = find_all('estados');
}

function add()
{
    if (!empty($_POST['empresa'])) {
        $empresa = $_POST['empresa'] ?? '';

        $validacao = validacoes($empresa);
        if ($validacao) {
            save('empresa', $empresa);
            header('location: index.php');
        }
    }
}

function edit()
{
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        if (isset($_POST['empresa'])) {
            $empresa = $_POST['empresa'];
            update('empresa', $empresa, 'id_empresa', $id);
            header('location: index.php');
        } else {
            global $empresa;
            $empresa = find('empresa', 'id_empresa', $id);
            $empresa = $empresa[0];
        }
    } else {
        header('location: index.php');
    }
}

function delete($id = null)
{
    global $empresa;
    $empresa = remove('empresa', $id);
    header('location: index.php');
}

function validacoes($campos)
{

    require_once('validaCpfCnpj.class.php');
    $pesquisaCnpj = find('empresa','cnpj',"'".$campos["'cnpj'"]."'");
    if($pesquisaCnpj){
        $_SESSION['message'] = "CNPJ já cadastrado";
        $_SESSION['type'] = 'danger';
        return false;
    }

    $validaCpfCnpj = new ValidaCPFCNPJ($campos["'cnpj'"]);
    if (!$validaCpfCnpj->valida()) {
        $_SESSION['message'] = "CNPJ inválido";
        $_SESSION['type'] = 'danger';
        return false;
    }
    return true;
}
