$(".botao").click(function (event) {
    event.preventDefault();
    $('div.cnpj').toggleClass('invisible');
    $('div.cpf').toggleClass('invisible');

    if ($('.botao').html() == "Cadastrar Restaurante") {
        $('.botao').html('Cadastrar Pessoa');
    } else {
        $('.botao').html('Cadastrar Restaurante');
    }

    //var x = $(".botao").html();
    //var a = x.substr(10, 16);
    if ($("#tipo").attr('value') == "Juridica")
        $("#tipo").attr('value', "Fisica");
    else
        $("#tipo").attr('value', "Juridica");

})

$(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-control").addClass("selected").html(fileName);
});

$(document).ready(function () {
    $("#confSenha").keyup(function () {
        var senha = $("#senha").val();
        var confsenha = $("#confSenha").val();

        if (senha != confsenha) {

            var msg = "Senha Incorreta";
            var limpa_campo = "";
            var valido = $("#senha_valida");
            var invalido = $("#senha_invalida");
            invalido.html(msg);
            valido.html(limpa_campo);

        } else {
            //event.preventDefault();
            var msg = "Senha Correta";
            var limpa_campo = "";
            var valido = $("#senha_valida");
            var invalido = $("#senha_invalida");
            valido.html(msg);
            invalido.html(limpa_campo);
        }
    });
})

$('.upload').on('click', function () {



    var fd = new FormData();
    var files = $('#image')[0].files[0];
    fd.append('file', files);
    var nome = $('#razao_social').val();
    //var file = $('#image').file[0];
    console.log(files);
    console.log(nome);
    console.log(fd);
    var url = "Request.php?class=PessoaCtr&method=uploadImage&nome=" + nome + "&file=" + files;

    $.ajax({
        url: url,
        type: 'post',
        dataType: 'JSON',
        data: fd,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.result == 1) {
                var text = response.caminho;
                $('#caminho').val(text);
                $.confirm({
                    title: 'Sucesso',
                    content: response.mensagem,
                    type: 'green',
                    typeAnimated: true,
                    buttons: {
                        tryAgain: {
                            text: 'Sucesso',
                            btnClass: 'btn-green',
                            action: function () {
                            }
                        },
                        close: function () {
                        }
                    }
                });
            } else {
                $.confirm({
                    title: 'Erro ao fazer Upload',
                    content: response.mensagem,
                    type: 'red',
                    typeAnimated: true,
                    buttons: {
                        tryAgain: {
                            text: 'Tente Novamente',
                            btnClass: 'btn-red',
                            action: function () {
                            }
                        },
                        close: function () {
                        }
                    }
                });
            }

        },
    });
})

$(document).ready(function () {
    $('#myTable').dataTable({
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        "language": {
            "lengthMenu": "Mostrando _MENU_ resultados por pagina",
            "zeroRecords": "Sem regitro - desculpe",
            "info": "Mostrando pagina _PAGE_ of _PAGES_",
            "infoEmpty": "Sem registros",
            "infoFiltered": "(Filtrados de _MAX_ total registros)",
            "search": "Buscar",
            "paginate": {
                "next": "Proximo",
                "previous": "Anterior",
                "first": "Inicio",
                "last": "Final"
            }
        }
    });
});
function removeMensagem() {
    setTimeout(function () {
        var msg = $('#msg');
        msg.remove();
    }, 10000);
}
document.onreadystatechange = () => {
    if (document.readyState === 'complete') {

        removeMensagem();
    }
}

$('#num_mesa').change(function () {
    console.log($(this).val());
    var url = $('#envia').attr('action');
    $('#numero_mesa').attr('required', false);
    $('#numero_mesa').val("");
    console.log(url);

    url = url.replace("single", "intervalo");
    $('#envia').attr('action', url);
    console.log(url);
});

$('#numero_mesa').on('click', function () {

    $('#num_mesa').val(0).change();

    var url = $('#envia').attr('action');
    console.log(url);

    url = url.replace("intervalo", "single");
    $('#envia').attr('action', url);
    console.log(url);

})