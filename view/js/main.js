$(document).ready(function() {
    //Função para chamar o modal
    $('#delete-modal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        //recupera informações do registro
        var info = button.data('info');
        var id = button.data('id');
        var modal = $(this);
        modal.find('.modal-title').text('Excluir ' + info);
        modal.find('.modal-body').text('Tem certeza que deseja excluir este registro?');
        if (info == "empresa")
            modal.find('.modal-alert').text('Esta operação irá excluir todos os fornecedores vinculados a esta empresa.');

        modal.find('#confirm').attr('href', 'index.php?url=deletar' + info + '&id=' + id);

    });

    //Função para filtrar a tabela de fornecedores 
    $(".filtro").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        var coluna = $(this).data('filtro');
        $("#tableFornecedores .data .coluna-" + coluna).filter(function() {
            $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    //testar qual opção está marcada entre CPF e CNPJ e colocar a respectiva máscara no campo (formulário de fornecedores)
    if ($('input[name=cpfCnpj]').value === 'cpf') {
        $("#cpf_cnpj").mask("000.000.000-00");
    } else {
        $("#cpf_cnpj").mask("00.000.000/0000-00");
    }
    //colocar a máscar de telefone
    $(".telefone").mask("(00)00000-0000");

    //formulário dinâmico conforme seleção de radiobutton entre CPF ou CNPJ
    $("input[name=cpfCnpj]").on('change', function() {
            var val = $(this).val();
            // incluir os campos RG e Data de Nascimento caso esteja marcado CPF
            // incluir máscara, placeholder, validação do formato e validação de preenchimento obrigatório
            if (val === "cpf") {
                $("#cpf_cnpj").mask("000.000.000-00");
                $("#cpf_cnpj").attr("placeholder", "___.___.___-__");
                $("#cpf_cnpj").attr("pattern", "[0-9]{3}\.?[0-9]{3}\.?[0-9]{3}\-?[0-9]{2}");
                $('.camposCPF input').attr("required", "req");
                $('#alertCPF').toggle();
            } else {
                $("#cpf_cnpj").mask("00.000.000/0000-00");
                $("#cpf_cnpj").attr("placeholder", "__.___.___/____-__");
                $("#cpf_cnpj").attr('pattern', '[0-9]{2}\.?[0-9]{3}\.?[0-9]{3}\/?[0-9]{4}\-?[0-9]{2}');
                $(".camposCPF input").removeAttr("required");
                $(".camposCPF input").val('');

                $('#alertCPF').toggle();
            }
            $(".camposCPF").toggle();
        })
        // Adicionar um novo campo de telefone ao clicar no botão
    $(".addtelefone").click(function(e) {
            html = "<label><label><input type='text' class='form-control telefone' name='telefone[]'>" +
                " </label><button type='button' class='btn-danger btn-sm removerTelefone'> Remover </button></label> ";
            $("#telefones").append(html);
        })
        // Remover o campo de telefone 
    $(document).on('click', ".removerTelefone", function(e) {
        var id = $(".removerTelefone").index(this);
        $(".removerTelefone").eq(id).parent().remove();
    });
});