<?php

$fornecedores = null;
$fornecedor = null;
$idEmpresa = null;
$idFornecedor = null;
$telefones = null;
$empresa = null;

/**	 *  Listagem de fornecedores	 */
function indexFornecedores($idEmpresa)
{
    global $fornecedores, $empresa;
    $empresa = find('empresa', 'id_empresa', $idEmpresa);
    if ($empresa) {
        $empresa = $empresa[0];
        $fornecedores = find('fornecedor', 'id_empresa', $empresa['id_empresa']);
    } else {
        header('location:index.php');
    }
}


function loadTelefones($idFornecedor)
{
    $telefones = find('telefone', 'id_fornecedor', $idFornecedor);
    $listaTelefones = "";
    if ($telefones) {
        foreach ($telefones as $telefone) {
            $listaTelefones .= "<li style='font-size: 13px; list-style-type:none'>" . $telefone['telefone'] . "</li>";
        }
    } else {
        $listaTelefones = "Nenhum";
    }
    return $listaTelefones;
}

function add()
{
    if (!empty($_POST['fornecedor'])) {
        global $last_id, $empresa;
        $fornecedor = $_POST['fornecedor'] ?? '';
        $fornecedor['cpfCnpj'] = $_POST['cpfCnpj'];
        $validacao = validacoes($fornecedor);
        if ($validacao) {
            unset($fornecedor['cpfCnpj']);
            $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));
            $fornecedor['id_empresa'] = (int)$empresa['id_empresa'];
            $fornecedor['data_hora'] = $now->format('Y-m-d H:i');
            save('fornecedor', $fornecedor);
            if(isset($_POST['telefone']))
                addTelefones($_POST['telefone'], $last_id);
            
            header('location: index.php?url=fornecedor&id=' . $empresa['id_empresa']);
        } else {
            header("location: index.php?url=cadastrarFornecedor&id=" . $empresa['id_empresa']);
        }
    }
}

function addTelefones($telefones,$idFornecedor){
    $arrayTelefone['id_fornecedor'] = $idFornecedor;
    foreach ($telefones as $telefone) {
        $arrayTelefone['telefone'] = $telefone;
        save('telefone', $arrayTelefone);
    }
}

function edit()
{
    if (isset($_GET['fornecedor'])) {
        $idFornecedor = $_GET['fornecedor'];
        if (isset($_POST['fornecedor'])) {
            $fornecedor = $_POST['fornecedor'];
            $fornecedor['cpfCnpj'] = $_POST['cpfCnpj'];
            $validacao = validacoes($fornecedor);
            if ($validacao) {
                unset($fornecedor['cpfCnpj']);
                $telefonesAtuais = $_POST['telefoneAtual'];
                update('fornecedor', $fornecedor,'id_fornecedor',$idFornecedor);
                $arrayTelefone['id_fornecedor']=$idFornecedor;
                
                foreach($telefonesAtuais as $key => $telefone){
                    $arrayTelefone['telefone'] = $telefone;
                    update('telefone',$arrayTelefone,'id_telefone',$key);
                }
                if(isset($_POST['telefone'])){
                    addTelefones($_POST['telefone'],$idFornecedor);
                }
                    
                header('location: index.php?url=fornecedor&empresa='.$fornecedor["'id_empresa'"]);
                
            }else{
                header('location: index.php?url=editarFornecedor&fornecedor='.$idFornecedor);
            }
        } else {
            global $fornecedor, $empresa, $campoCpfCnpj, $placeholder, $camposCPF, $telefones, $required, $empresas;
            $fornecedor = find('fornecedor', 'id_fornecedor', $idFornecedor);
            $fornecedor = $fornecedor[0];
            //recupera todas as empresas cadastradas
            $empresas = find_all('empresa');
            //recupera a empresa a qual pertence o fornecedor
            $empresa = find('empresa', 'id_empresa', $fornecedor['id_empresa']);
            $empresa = $empresa[0];
            //recupera os telefones de contato do fornecedor
            $telefones = find('telefone', 'id_fornecedor', $fornecedor['id_fornecedor']);
            //verifica se o valor retornado do BD é um CPF ou um CNPJ
            $campoCpfCnpj = verificaCpfCnpj($fornecedor['cpf_cnpj']);
            if ($campoCpfCnpj == 'cpf') {
                $placeholder = "placeholder='___.___.___-__'";
                $camposCPF = "";
                $required = true;
            } else {
                $placeholder = "placeholder='__.___.___/____-__'";
                $camposCPF = "style='display:none;'";
                $required = false;
            }
            if ($empresa['uf'] == 18 && $campoCpfCnpj == "cpf") {
                $_SESSION['message'] = "ATENÇÃO: Empresas do Paraná não aceitam fornecedores pessoa física menores de 18 anos.";
                $_SESSION['type'] = 'warning';
            }
            
        }
    }
}

function delete($table=null, $data = null)
{
    global $fornecedor;
    $fornecedor = find('fornecedor','id_fornecedor',$data['id_fornecedor']);
    $fornecedor = $fornecedor[0];
    if($table == 'fornecedor'){
        $id = $data['id_fornecedor'];
        $url = "fornecedor&empresa=".$fornecedor['id_empresa'];
    }else{
        $id = $data['id_telefone'];
        $url = "editarFornecedor&fornecedor=".$fornecedor['id_fornecedor'];
    }
    
    remove($table, $id);
    header('location: index.php?url='.$url);
}


function validacoes($campos)
{
    require_once('validaCpfCnpj.class.php');
    global $empresa;
    $empresa = find('empresa','id_empresa',$campos["'id_empresa'"]);
    $empresa=$empresa[0];
    $validaCpfCnpj = new ValidaCPFCNPJ($campos["'cpf_cnpj'"]);

    if ($validaCpfCnpj->valida()) {
        if($campos["cpfCnpj"] == "cpf"){
            $data_nascimento = date_create($campos["'data_nascimento'"]);
            $hoje = new DateTime(date('Y-m-d'));
            if($data_nascimento > $hoje ){
                $_SESSION['message'] = "Data de nascimento inválida";
                $_SESSION['type'] = 'danger';
                return false;
            }else{
                if ($empresa['uf'] == "18") {
            
                    $idade = $data_nascimento->diff(new DateTime(date('Y-m-d')));
                    if ($idade->y >= 18) {
                        return true;
                    } else {
                        $_SESSION['message'] = "Empresas localizadas no Paraná não aceitam fornecedores pessoa física menores de idade";
                        $_SESSION['type'] = 'danger';
                        return false;
                    }
                }
            }
        }
        
        return true;
    } else {
        $_SESSION['message'] = "CPF ou CNPJ inválido";
        $_SESSION['type'] = 'danger';
        return false;
    }
}

function verificaCpfCnpj($valor)
{
    if (strlen($valor) == 18) {
        $verificador = "cnpj";
    } else {
        $verificador = "cpf";
    }

    return $verificador;
}
