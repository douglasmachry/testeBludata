<?php require_once('ctrl/ctrl-empresas.php');
edit();

$estados = find_all('estados');

if($estados){
    $options = "";
    foreach($estados as $estado){
        if($estado['id_estado'] == $empresa['uf']){
            $options .= "<option value=".$estado['id_estado']." selected>".$estado['sigla']."</option>";
        }else{
            $options .= "<option value=".$estado['id_estado'].">".$estado['sigla']."</option>";
        }
        
    }
}else{
    $options = "<option>Erro ao carregar</option>";
}
?>
<h2>Atualizar Empresa</h2>
<form action="index.php?url=editarEmpresa&id=<?php echo $empresa["id_empresa"]; ?>" method="post">
    <hr />
    <div class="row">
        <div class="form-group col-md-7"> 
            <label for="name">Nome Fantasia</label> 
            <input type="text" class="form-control" name="empresa['nome_fantasia']" value="<?php echo $empresa['nome_fantasia']; ?>" required>
        </div>
        <div class="form-group col-md-3"> 
            <label for="campo2">CNPJ</label>
            <input type="hidden" name="cpfCnpj" value="cnpj">
            <input type="text" class="form-control" name="empresa['cnpj']" value="<?php echo $empresa['cnpj']; ?>" 
            pattern="[0-9]{2}\.?[0-9]{3}\.?[0-9]{3}\/?[0-9]{4}\-?[0-9]{2}" placeholder="__.___.___/____-__" required> 
        </div>
        <div class="form-group col-md-3"> 
            <label for="campo2">UF</label>
            <select id="uf" name="empresa['uf']" class="form-control">
                <?php echo $options; ?>
            </select>   
        </div>
    </div>
    
    <div id="actions" class="row">
        <div class="col-md-12"> <button type="submit" class="btn btn-primary">Salvar</button>
         <a href="index.php" class="btn btn-default">Cancelar</a> </div>
    </div>
</form>