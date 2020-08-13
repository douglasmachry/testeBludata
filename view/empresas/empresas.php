<?php 
require_once('ctrl/ctrl-empresas.php');
indexEmpresas(); 
?>

<header>
    <div class="row">
        <div class="col-sm-6">
            <h2>Lista de Empresas</h2>
        </div>
        <div class="col-sm-6 text-right h2">
            <a class="btn btn-primary" href="?url=cadastrarEmpresa">
                <i class="fa fa-plus"></i> Nova Empresa
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
            <th width="30%">Nome</th>
            <th>CNPJ</th>
            <th>UF</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($empresas) :  foreach ($empresas as $empresa) : ?>
                <tr>
                    <td><?php echo $empresa['nome_fantasia']; ?></td>
                    <td><?php echo formatCnpjCpf($empresa['cnpj']); ?></td>
                    <td><?php 
                        foreach($estados as $estado){
                            if($estado['id_estado'] == $empresa['uf'])
                                echo $estado['sigla'];
                        } 
                        ?>
                    </td>
                    <td class="actions text-right">
                        <a href="index.php?url=fornecedor&id=<?php echo $empresa['id_empresa']; ?>" class="btn btn-sm btn-success">
                            <i class="fa fa-eye"></i> Visualizar Fornecedores
                        </a>
                        <a href="index.php?url=editarEmpresa&id=<?php echo $empresa['id_empresa']; ?>" class="btn btn-sm btn-warning">
                            <i class="fa fa-pencil"></i>Editar
                        </a>
                        <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" data-empresa="<?php echo $empresa['id_empresa']; ?>" data-info="empresa">
                            <i class="fa fa-trash"></i> Excluir
                        </a>
                    </td>
                </tr> <?php endforeach; ?> <?php else : ?> <tr>
                <td colspan="6">Nenhum registro encontrado.</td>
            </tr> <?php endif; ?> </tbody>
</table>
<?php include(FOOTER_TEMPLATE); ?>