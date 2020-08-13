<?php 
require_once('ctrl/ctrl-fornecedores.php');
indexFornecedores();
$empresa=$empresa[0];

?>

<header>
    <div class="row">
        <div class="col-sm-6">
            <h2>Fornecedores - <?php echo $empresa['nome_fantasia']; ?></h2>
        </div>
        <div class="col-sm-6 text-right h2">
            <a class="btn btn-primary" href="add.php">
                <i class="fa fa-plus"></i> Novo fornecedor
            </a>
            <a class="btn btn-default" href="index.php">
                <i class="fa fa-refresh"></i> Atualizar
            </a>
        </div>
    </div>
</header>
<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> <?php echo $_SESSION['message']; ?>
    </div>

<?php endif; ?>
<hr>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Nome</th>
            <th>CPF/CNPJ</th>
            <th>RG</th>
            <th>Data de Nascimento</th>
            <th>Data-hora de cadastro</th>
            <th>Telefone(s)</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($fornecedores) :  foreach ($fornecedores as $fornecedor) : ?>
                <tr>
                    <td><?php echo $fornecedor['nome']; ?></td>
                    <td><?php
                            echo formatCnpjCpf($fornecedor['cpf_cnpj']); ?></td>
                    <td><?php 
                        if($fornecedor['rg'] == "")
                        echo '-';
                        
                        echo $fornecedor['rg']; ?></td>
                    <td><?php 
                        if($fornecedor['data_nascimento'] == "0000-00-00"){
                            echo "-";
                        }else{
                            echo $fornecedor['data_nascimento'];
                        }
                         ?>
                    </td>
                    <td><?php echo date_format(date_create($fornecedor['data_hora']),'d/m/Y H:m'); ?></td>
                    <td>
                        <?php
                            $telefones = loadTelefones($fornecedor['id_fornecedor']);
                            echo $telefones;
                        ?>
                    </td>
                    <td class="actions text-right">
                        <a href="edit.php?id=<?php echo $fornecedor['id_fornecedor']; ?>" class="btn btn-sm btn-warning">
                            <i class="fa fa-pencil"></i>Editar
                        </a>
                        <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" data-fornecedor="<?php echo $fornecedor['id_fornecedor']; ?>">
                            <i class="fa fa-trash"></i> Excluir
                        </a>
                    </td>
                </tr> <?php endforeach; ?> <?php else : ?> <tr>
                <td colspan="6">Nenhum registro encontrado.</td>
            </tr> <?php endif; ?> </tbody>
</table>
<?php include(FOOTER_TEMPLATE); ?>