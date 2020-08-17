<?php require_once('ctrl/ctrl-fornecedores.php');

edit();


if($fornecedor):
    if (!empty($_SESSION['message'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> <?php echo $_SESSION['message']; ?>
        </div>
    <?php
    unset($_SESSION['message']);
    endif;
?>
<h2>Editar Fornecedor</h2>
<form action="index.php?url=editarFornecedor&fornecedor=<?php echo $fornecedor['id_fornecedor']; ?>" method="post" name="fornecedor">
    <!-- area de campos do form -->
    <hr />
    <div class="row">
        <div class="form-group col-md-7">
            <label for="fornecedor['nome']">Nome</label>
            <input type="text" class="form-control" name="fornecedor['nome']" value="<?php echo $fornecedor['nome']; ?>" required>
        </div>
        <div class="form-group col-md-3">
            <label for="fonecedor['id_empresa']">Empresa</label>
            <select name="fornecedor['id_empresa']" class="form-control">
            <?php if($empresas) : foreach($empresas as $optionEmpresa):?>
                <option value=<?php echo $optionEmpresa["id_empresa"]; 
                    if($optionEmpresa['id_empresa'] == $empresa['id_empresa']) echo " selected";?>>
                    <?php echo $optionEmpresa['nome_fantasia']; ?>
                </option>
            <?php endforeach; else :?>
            <option>Erro ao carregar</option>
            <?php endif; ?>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label>
                <input type="radio" name="cpfCnpj" value="cnpj" <?= $campoCpfCnpj == 'cnpj' ? 'checked="true"' : ''; ?>> CNPJ
                <input type="radio" name="cpfCnpj" value="cpf" <?= $campoCpfCnpj == 'cpf' ? 'checked="true"' : ''; ?>> CPF

            </label>
            <input type="text" class="form-control" id="cpf_cnpj" name="fornecedor['cpf_cnpj']" <?php echo 'value= ' . $fornecedor['cpf_cnpj'] . " " . $placeholder; ?> required>

        </div>

        <div class="form-group col-md-3 camposCPF" <?php echo $camposCPF; ?>>
            <label for="fornecedor['rg']">RG</label>
            <input type="text" class="form-control" name="fornecedor['rg']" value="<?php echo $fornecedor['rg']; ?>" maxlength="10" required=<?php echo $required; ?>>
        </div>
        <div class="form-group col-md-3 camposCPF" <?php echo $camposCPF; ?>>
            <label for="data_nascimento">Data de Nascimento</label>
            <input type="date" class="form-control" name="fornecedor['data_nascimento']" value="<?php echo $fornecedor['data_nascimento']; ?>" required=<?php echo $required; ?>>
        </div>

    </div>
    <div class="row">
        <div class="form-group col-md-4" id="telefones">
            <label for="telefone">Telefone(s)</label><br>
            <?php foreach ($telefones as $key => $telefone) { ?>
                <label>
                    <label>
                        <input type="text" class="form-control telefone" name="telefoneAtual[<?php echo $telefone['id_telefone']; ?>]" value="<?php echo $telefone['telefone']; ?>" required>
                    </label>
                    <?php
                    if ($key > 0) {
                    ?>
                        <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" data-id="<?php echo $telefone['id_telefone']; ?>" data-info="Telefone">
                            <i class="fa fa-trash"></i> Remover
                        </a>
                    <?php } ?>
                </label>
            <?php } ?>
        </div>
    </div>
    <button type="button" class="btn btn-success btn-sm addtelefone">+ Telefone</button>
    <br><br>
    <div id="actions" class="row">
        <div class="col-md-12"> <button type="submit" class="btn btn-primary">Salvar</button> 
        <a href="index.php?url=fornecedor&empresa=<?php echo $empresa['id_empresa']; ?>" class="btn btn-default">Cancelar</a> </div>
    </div>

</form>
<?php else : echo "Não foi possível carregar as informações do fornecedor"; endif?>