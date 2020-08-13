$('#delete-modal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var id = button.data('empresa');
    var info = button.data('info');
    var modal = $(this);
    if (info == "empresa") {
        modal.find('.modal-title').text('Excluir empresa');
        modal.find('.modal-body').text('Tem certeza que deseja excluir esta empresa?');
        modal.find('.modal-alert').text('Esta operação irá excluir todos os fornecedores vinculados a esta empresa.');
    } else {
        modal.find('.modal-title').text('Excluir fornecedor');
        modal.find('.modal-body').text('Tem certeza que deseja excluir este fornecedor?');
    }
    modal.find('#confirm').attr('href', 'index.php?url=deletarEmpresa&id=' + id);

})

$(document).ready(function() {
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });


});
$("#cpf_cnpj").mask("00.000.000/0000-00");
$(".camposCPF").hide();
$("input[name=cpfCnpj]").change(function() {
    var val = $(this).val();
    if (val === "cpf") {
        $("#cpf_cnpj").mask("000.000.000-00");
        $("#cpf_cnpj").attr("placeholder", "___.___.___-__");
        $('.camposCPF input').attr("required", "req");
    } else {
        $("#cpf_cnpj").mask("00.000.000/0000-00");
        $("#cpf_cnpj").attr("placeholder", "__.___.___/____-__");
        $(".camposCPF input").removeAttr("required");
    }
    $(".camposCPF").toggle();
})