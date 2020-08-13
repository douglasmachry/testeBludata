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