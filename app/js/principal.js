$(document).ready(function () {
    $('#telefone').mask('(00)0000-0000');
    $('#celular').mask('(00)00000-0000');
    $('#cep').mask('00000-000');
    $('#cpf').mask('000.000.000-00');
    // $('#rg').mask('00.000.000.AA');
})



$(".botao").on('click', function (event) {
    event.preventDefault();

    $('div.cnpj').toggleClass('invisible');
    $('div.cpf').toggleClass('invisible');

    if ($('.botao').html() == "Cadastrar Restaurante") {

        $('.botao').html('Cadastrar Pessoa');

        $('#cnpj_juridica').attr("required", true);
        $('#nome').attr("required", true);

        $('#cpf').attr("required", false);

    } else {
        $('.botao').html('Cadastrar Restaurante');
        $('#cpf').attr("required", true);

        $('#cnpj_juridica').attr("required", false);
        $('#nome').attr("required", false);
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
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

$(document).ready(function () {
    $("#confSenha").on('keyup', function () {
        var senha = $("#senha").val();
        var confsenha = $("#confSenha").val();

        console.log(senha);
        console.log(confsenha);



        if (senha != confsenha) {

            $('#senha_invalida').html("Senha Incorreta");
            $('#senha_valida').html("");

        } else {

            $("#senha_valida").html("Senha Correta");
            $("#senha_invalida").html("");

        }
    });
})

$('.upload').on('click', function () {



    var fd = new FormData();
    var files = $('#image')[0].files[0];
    fd.append('file', files);
    var nome = $('#nome').val();
    //var file = $('#image').file[0];
    // console.log(files);
    // console.log(nome);
    // console.log(fd);
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
                            action: function () {}
                        },
                        close: function () {}
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
                            action: function () {}
                        },
                        close: function () {}
                    }
                });
            }

        },
    });
})

$(document).ready(function () {
    $('#myTable').dataTable({
        "lengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],
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
        },
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
    // console.log($(this).val());
    var url = $('#envia').attr('action');
    $('#numero_mesa').attr('required', false);
    $('#numero_mesa').val("");

    url = url.replace("single", "intervalo");
    $('#envia').attr('action', url);
});

$('#numero_mesa').on('click', function () {

    $('#num_mesa').val(0).change();

    var url = $('#envia').attr('action');
    console.log(url);

    url = url.replace("intervalo", "single");
    $('#envia').attr('action', url);
    console.log(url);

});

$('#relatorio').on('click', function () {
    var url2 = "Request.php?class=DashboardCtr&method=GerarPdf";

    $.ajax({
        url: url2,
        type: 'post',
        contentType: false,
        processData: false,
    });
})

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

$('#excluir').on("click", function () {

    $.confirm({
        title: 'Excluir',
        content: "Tem certeza que deseja excluir esse registro?",
        type: 'red',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: 'Confirmar',
                btnClass: 'btn-warning',
                keys: ['enter', 'shift'],
                action: function () {
                    // $.alert('OK!!!');
                    var id = $('#id').html();
                    var url = "Request.php?class=FuncCtr&method=delete&id=" + id;


                    $.ajax({
                        url: url,
                        type: 'post',
                        contentType: false,
                        processData: false,

                        success: function () {
                            window.location.href = "Request.php?class=FuncCtr&method=func";
                        }
                    })
                }
            },
            close: function () {
                $.alert('Cancelado!');
            }
        }
    });
});

//----------Funcões respnsaveis pela verificação de login e cpf e futuramente cnpj------//
$('#cpf').on('blur', function () {
    var cpf = $('#cpf').val();
    enviar('cpf_fisica', cpf);
});

$('.login_pessoa').on('blur', function () {
    var login = $('.login_pessoa').val();
    enviar('login_pessoa', login);
});


function enviar(campo, valor) {
    var url = "Request.php?class=PessoaCtr&method=VerificaCampo&campo=" + campo + "&valor=" + valor;
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'JSON',
        contentType: false,
        processData: false,

        success: function (response) {
            if (response.result == 1 && campo == "login_pessoa") {
                $('#invalid').html("Esse login ja existe");
                $('#valid').html("");
            } else if (response.result == 0 && campo == "login_pessoa") {
                $('#valid').html("Muito Bom!!");
                $('#invalid').html("");
            } else if (response.result == 1 && campo == "cpf_fisica") {
                $('#invalid_cpf').html("Esse cpf ja existe");
                $('#valid_cpf').html("");
            } else if (response.result == 0 && campo == "cpf_fisica") {
                $('#valid_cpf').html("Muito Bom!!");
                $('#invalid_cpf').html("");
            }
        }
    })
}
//-------------end----------//


$('#tabs :first-child').addClass("active");

$("ul").on("click", "a", function () {
    var a = $(this).attr("href");
    console.log(a);
    //  var a = a.replace("#", " ")
    //  console.log(a);
    var x = $(a);
    x.toggleClass('active');

    $( x ).siblings().removeClass('active');
    console.log(x);
});


$('td').on("click", "a", function () {
    var a = $(this).attr("caminho");
    console.log(a);

    $.confirm({
        title: 'Excluir!!!',
        content: 'Deseja realmente excluir esse registro?',
        buttons: {
            confirm: {
                text: 'Confirmar',
                btnClass: 'btn-warning',
                keys: ['enter', 'shift'],
                action: function () {

                    var location = a;
                    location = location.trim();
                    window.location.href = location;
                }
            },
            cancel: function () {
                $.alert('Cancelado!');
            }
        }
    });
    
})