<?php 
require_once('ctrl/ctrl-empresas.php');

indexEmpresas();
add();

if($estados){
    $options = "";
    foreach($estados as $estado){
        $options .= "<option value=".$estado['sigla'].">".$estado['sigla']."</option>";
    }
}else{
    $options = "<option>Erro ao carregar</option>";
}
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
            <label for="campo2">CNPJ (somente números)</label>
            <input type="text" class="form-control" name="empresa['cnpj']" required>
        </div>
        <div class="form-group col-md-2">
            <label for="campo3">UF</label>
            <select id="uf" name="empresa['uf']" class="form-control" >
                <?php echo $options; ?>
            </select>  
        </div>
    </div>
    
    <div id="actions" class="row">
        <div class="col-md-12"> <button type="submit" class="btn btn-primary">Salvar</button> <a href="index.php" class="btn btn-default">Cancelar</a> </div>
    </div>
</form>