<?php
require_once "model/empresa.class.php";
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


        save('empresa', $empresa);
        header('location: index.php');
    }
}

function edit()
{
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        if (isset($_POST['empresa'])) {
            $empresa = $_POST['empresa'];
            update('empresa', $id, $empresa);
            header('location: index.php');
        } else {
            global $empresa;
            $empresa = find('empresa','id_empresa', $id);
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
