<?php 
require_once('ctrl/ctrl-fornecedores.php');
if(isset($_GET['empresa']) && is_numeric($_GET['empresa'])){
    indexFornecedores($_GET['empresa']);
}else{
    header('location: index.php');
}


?>
<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> <?php echo $_SESSION['message']; ?>
    </div>

<?php unset($_SESSION['message']); endif; ?>
<header>
    <div class="row">
        <div class="col-sm-6">
            <h2>Fornecedores - <?php echo $empresa['nome_fantasia']; ?></h2>
        </div>
        <div class="col-sm-6 text-right h2">
            <a class="btn btn-primary" href="?url=cadastrarFornecedor&empresa=<?php echo $empresa['id_empresa']; ?>">
                <i class="fa fa-plus"></i> Novo fornecedor
            </a>
            <a class="btn btn-default" href="index.php?url=fornecedor&empresa=<?php echo $empresa['id_empresa']; ?>">
                <i class="fa fa-refresh"></i> Atualizar
            </a>
        </div>
    </div>
</header>


<table class="table table-hover" id="tableFornecedores">
    <thead>
        <tr>
            <th>Nome</th>
            <th>CPF/CNPJ</th>
            <th>RG</th>
            <th>Data de Nascimento</th>
            <th>Data-hora <br>de cadastro</th>
            <th>Telefone(s)</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><input type="text" class="filtro" data-filtro="nome" placeholder="Filtro por nome"></td>
            <td><input type="text" class="filtro" data-filtro="cpf-cnpj" placeholder="Filtro por CPF/CNPJ"></td>
            <td></td>
            <td></td>
            <td><input type="text" class="filtro" width="70" data-filtro='data-cadastro' placeholder="Filtro por data/hora de cadastro"></td>
            <td></td>
        </tr>
        <?php if ($fornecedores) :  foreach ($fornecedores as $fornecedor) : ?>
                <tr class="data">
                    <td class="coluna-nome"><?php echo $fornecedor['nome']; ?></td>
                    <td class="coluna-cpf-cnpj"><?php
                            echo $fornecedor['cpf_cnpj']; ?></td>
                    <td><?php 
                        if($fornecedor['rg'] == "")
                        echo '-';

                        echo $fornecedor['rg']; ?></td>
                    <td><?php 
                        if($fornecedor['data_nascimento'] == "0000-00-00"){
                            echo "-";
                        }else{
                            echo date_format(date_create($fornecedor['data_nascimento']),'d/m/Y');
                        }
                         ?>
                    </td>
                    <td class="coluna-data-cadastro"><?php echo date_format(date_create($fornecedor['data_hora']),'d/m/Y H:m'); ?></td>
                    <td>
                        <?php
                            $telefones = loadTelefones($fornecedor['id_fornecedor']);
                            echo $telefones;
                        ?>
                    </td>
                    <td class="actions text-right">
                        <a href="index.php?url=editarFornecedor&fornecedor=<?php echo $fornecedor['id_fornecedor']; ?>" class="btn btn-sm btn-warning">
                            <i class="fa fa-pencil"></i>Editar
                        </a>
                        <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" data-id="<?php echo $fornecedor['id_fornecedor']; ?>" data-info='Fornecedor'>
                            <i class="fa fa-trash"></i> Excluir
                        </a>
                    </td>
                </tr> <?php endforeach; ?> <?php else : ?> <tr>
                <td colspan="6">Nenhum registro encontrado.</td>
            </tr> <?php endif; ?> </tbody>
</table>

<?php include(FOOTER_TEMPLATE); ?>