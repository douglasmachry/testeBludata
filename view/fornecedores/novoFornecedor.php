<?php
require_once('ctrl/ctrl-fornecedores.php');

indexFornecedores();
add();
$empresa = $empresa[0];
?>
<h2>Novo Fornecedor - <?php echo $empresa['nome_fantasia']; ?></h2>
<form action="index.php?url=cadastrarFornecedor" method="post" name="fornecedor">
    <!-- area de campos do form -->
    <hr />
    <div class="row">
        <div class="form-group col-md-10">
            <label for="name">Nome</label>
            <input type="text" class="form-control" name="fornecedor['nome']" required>
        </div>
        <div class="form-group col-md-3">
            <label>
                <input type="radio" name="cpfCnpj" value="cnpj" checked> CNPJ
                <input type="radio" name="cpfCnpj" value="cpf"> CPF
                
            </label>
            <input type="text" class="form-control" id="cpf_cnpj" name="fornecedor['cpf_cnpj']" pattern="(\d{3}\.?\d{3}\.?\d{3}-?\d{2})|(\d{2}\.?\d{3}\.?\d{3}/?\d{4}-?\d{2})" placeholder="__.___.___/____-__" required>
            
        </div>

        <div class="form-group col-md-3 camposCPF">
            <label for="fornecedor['rg']">RG</label>
            <input type="text" class="form-control" name="fornecedor['rg']" maxlength="10">
        </div>
        <div class="form-group col-md-3 camposCPF">
            <label for="data_nascimento">Data de Nascimento</label>
            <input type="date" class="form-control" name="fornecedor['data_nascimento']">
        </div>
        
    </div>
    <div class="alert alert-danger" role="alert">
        </div>
    <div id="actions" class="row">
        <div class="col-md-12"> <button type="submit" class="btn btn-primary">Salvar</button> <a href="index.php" class="btn btn-default">Cancelar</a> </div>
    </div>
</form>