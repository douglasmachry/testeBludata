<?php
require_once('ctrl/ctrl-fornecedores.php');

indexFornecedores($_GET['empresa']);
add();
if ($empresa['uf'] == 18) {
    $alerta = "
        <label class='form-group alert alert-warning' role='alert' id='alertCPF' style='display: none;'>
        ATENÇÃO: Empresas do Paraná não aceitam fornecedores pessoa física menores de 18 anos.
        </label>";
} else {
    $alerta = "";
}
if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> <?php echo $_SESSION['message']; ?>
    </div>

<?php 
unset($_SESSION['message']);
 endif; 
 echo $alerta;
 ?>
<h2>Novo Fornecedor - <?php echo $empresa['nome_fantasia']; ?></h2>
<form action="index.php?url=cadastrarFornecedor&id=<?php echo $empresa['id_empresa']; ?>" method="post" name="fornecedor">
    <!-- area de campos do form -->
    <hr />
    <div class="row">
        <div class="form-group col-md-10">
            <label for="name">Nome</label>
            <input type="text" class="form-control" name="fornecedor['nome']" required>
        </div>
        <div class="form-group col-md-3">
            <label>
                <input type="radio"  name="cpfCnpj" value="cnpj" checked> CNPJ
                <input type="radio"  name="cpfCnpj" value="cpf"> CPF

            </label>
            <input type="text" class="form-control" id="cpf_cnpj" name="fornecedor['cpf_cnpj']" placeholder="__.___.___/____-__" required>

        </div>

        <div class="form-group col-md-3 camposCPF" style="display: none;">
            <label for="fornecedor['rg']">RG</label>
            <input type="text" class="form-control" name="fornecedor['rg']" maxlength="10">
        </div>
        <div class="form-group col-md-3 camposCPF" style="display: none;">
            <label for="data_nascimento">Data de Nascimento</label>
            <input type="date" class="form-control" name="fornecedor['data_nascimento']">
        </div>

    </div>
    <div class="row">
        <div class="form-group col-md-4" id="telefones">
            <label for="telefone">Telefone(s)</label><br>
            <label>
                <input type="text" class="form-control telefone" name="telefone[]">
            </label>
        </div>
    </div>
    <button type="button" class="btn btn-success btn-sm addtelefone">+ Telefone</button>
    <br><br>
    <div id="actions" class="row">
        <div class="col-md-12"> <button type="submit" class="btn btn-primary">Salvar</button>
     <a href="javascript:void(0)" onClick="history.go(-1); return false;" class="btn btn-default">Cancelar</a> </div>
    </div>

</form>