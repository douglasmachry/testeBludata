<?php
require_once('ctrl/ctrl-empresas.php');

indexEmpresas();
add();

if ($estados) {
    $options = "";
    foreach ($estados as $estado) {
        $options .= "<option value=" . $estado['sigla'] . ">" . $estado['sigla'] . "</option>";
    }
} else {
    $options = "<option>Erro ao carregar</option>";
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
?>
<h2>Nova Empresa</h2>
<form action="index.php?url=cadastrarEmpresa" method="post" name="empresa">
    <!-- area de campos do form -->
    <hr />
    <div class="row">
        <div class="form-group col-md-7">
            <label for="name">Nome Fantasia</label>
            <input type="text" class="form-control" name="empresa['nome_fantasia']" required>
        </div>
        <div class="form-group col-md-3">
            <label for="campo2">CNPJ</label>
            <input type="hidden" name="cpfCnpj" value="cnpj">
            <input type="text" class="form-control" id="cpf_cnpj" name="empresa['cnpj']" pattern="[0-9]{2}\.?[0-9]{3}\.?[0-9]{3}\/?[0-9]{4}\-?[0-9]{2}" placeholder="__.___.___/____-__" required>
        </div>
        <div class="form-group col-md-2">
            <label for="campo3">UF</label>
            <select id="uf" name="empresa['uf']" class="form-control">
                <?php echo $options; ?>
            </select>
        </div>
    </div>

    <div id="actions" class="row">
        <div class="col-md-12"> <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="javascript:void(0)" onClick="history.go(-1); return false;" class="btn btn-default">Cancelar</a> </div>
    </div>
</form>