$(document).ready(function () {
    $('#telefone').mask('(00)0000-0000');
    $('#celular').mask('(00)00000-0000');
    $('#cep').mask('00000-000');
    $('#cpf').mask('000.000.000-00');
    // $('#rg').mask('00.000.000.AA');
})


$(document).ready(function () {
    $('#cpf').attr("required", true);

    $('#cnpj_juridica').attr("required", false);
    $('#nome').attr("required", false);
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

                $('.atual').toggleClass('invisible');

                $('#prod').attr("src", "app/img/" + text);
                $('#link').attr("href", "app/img/" + text);
                
                $('.nova').toggleClass('invisible');

                // $('#teste').remove(a);
                // // $('#imageprod').attr("src", " ");
                // // $('#linkprod').attr("href", " ");

                // $('#prod').attr("src", "app/img/" + text);
                // $('#link').attr("href", "app/img/" + text);

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

                if ($('#cpf').attr("acao") == "update") {
                    $('#invalid').html("");
                    $('#valid').html("Vai usar o mesmo login??");
                } else {
                    $('#invalid').html("Esse login ja existe");
                    $('#valid').html("");
                }
            } else if (response.result == 0 && campo == "login_pessoa") {
                $('#valid').html("Muito Bom!!");
                $('#invalid').html("");
            } else if (response.result == 1 && campo == "cpf_fisica") {

                if ($('.login_pessoa').attr("acao") == "update") {
                    $('#valid_cpf').html("Vai usar o mesmo cpf??");
                    $('#invalid_cpf').html("");                   
                } else {
                    $('#invalid_cpf').html("Esse cpf ja existe");
                    $('#valid_cpf').html("");
                }


            } else if (response.result == 0 && campo == "cpf_fisica") {
                $('#valid_cpf').html("Muito Bom!!");
                $('#invalid_cpf').html("");
            }
        }
    })
}
//-------------end----------//


$('#tabs :first-child').addClass("active");

$(".test").on("click", '#nav', function () {
    var a = $(this).attr("href");
    console.log(a);
    //  var a = a.replace("#", " ")
    //  console.log(a);
    var x = $(a);
    x.toggleClass('active');

    $(x).siblings().removeClass('active');
    console.log(x);
});


$('.excluir').on("click", $('#teste'), function () {

    var a = $(this).attr("caminho");
    console.log("olaaa");
    
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
                    window.location.replace(a);
                }
            },
            cancel: function () {
                $.alert('Cancelado!');
            }
        }
    });

})

$(document).ready(function () {

    $('.image').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        image: {
            verticalFit: true
        }

    });
});

$(document).ready(function () {
    $('#mesas').dataTable({
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
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                download: 'open'
            }
        ]
    });
});

$(document).ready(function () {
    $('.cpf').blur(function () {

        var strCPF = $('#cpf').val();
        console.log(strCPF);

        

        console.log(strCPF);
        // expressão regular
        var objER = /^([0-9]{3}\.?[0-9]{3}\.?[0-9]{3}\-?[0-9]{2}|[0-9]{2}\.?[0-9]{3}\.?[0-9]{3}\/?[0-9]{4}\-?[0-9]{2})$/;

        if (strCPF.length > 0) {
            if (objER.test(strCPF)) {
                var validacpf = TestaCPF(strCPF);
                if (validacpf) {
                    //console.log("cpf valido");
                    var msg = "CPF Valido";
                    var limpa_campo = "";
                    var valido = $("#cpf_valido");
                    var invalido = $("#cpf_invalido");
                    valido.html(msg);
                    invalido.html(limpa_campo);
                } else {
                    var msg = "CPF Invalido";
                    var limpa_campo = "";
                    var valido = $("#cpf_valido");
                    var invalido = $("#cpf_invalido");

                    invalido.html(msg);
                    valido.html(limpa_campo);
                }
            } else {
                var msg = "Formato Invalido";
                var limpa_campo = "";
                var valido = $("#cpf_valido");
                var invalido = $("#cpf_invalido");

                invalido.html(msg);
                valido.html(limpa_campo);
            }
        } else {
            var msg = "Campo Vazio";
            var limpa_campo = "";
            var valido = $("#cpf_valido");
            var invalido = $("#cpf_invalido");

            invalido.html(msg);
            valido.html(limpa_campo);

        }
    })
})

function TestaCPF(CPF) {


    Cpf = CPF.replace(/[^\d]+/g, '');


    var Soma;
    var Resto;
    Soma = 0;
    var regex = /^(\d)\1{10}/g;
    if (regex.test(Cpf)){
            //== "00000000000" || Cpf == "11111111111" || Cpf == "22222222222" || Cpf == "33333333333" || Cpf == "44444444444" || Cpf == "55555555555" || Cpf == "66666666666" || Cpf == "7777777777" || Cpf == "88888888888" || Cpf == "99999999999" ) {
        //alert("CPF INVALIDO")
        return false;
    }

    for (i = 1; i <= 9; i++)
        Soma = Soma + parseInt(Cpf.substring(i - 1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))
        Resto = 0;
    if (Resto != parseInt(Cpf.substring(9, 10))) {
        //alert("CPF INVALIDO")
        return false;
    }

    Soma = 0;
    for (i = 1; i <= 10; i++)
        Soma = Soma + parseInt(Cpf.substring(i - 1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))
        Resto = 0;

    if (Resto != parseInt(Cpf.substring(10, 11)))
        return false
    //alert("CPF VALIDO");
    return true;
}

$('#restdados').on("click", function(){
    console.log("dasdasd");
    
    var id = $('#id_pessoa').val();
    $.confirm({
        title: 'Excluir!!!',
        content: 'Sua conta sera inativada de nosso sistema, tem certeza sobre isso??',
        buttons: {
            confirm: function () {
                window.location.replace("Request.php?class=PessoaCtr&method=delete&tipo=Juridica&id=".id);
            },
            cancel: function () {
               
            }          
        }
    });
});

$('#pessoadados').on("click", function(){
console.log("teste");

    var id = $('#id_pessoa').val();
    $.confirm({
        title: 'Excluir!!!',
        content: 'Sua conta sera inativada de nosso sistema, tem certeza sobre isso??',
        buttons: {
            confirm: function () {
                var a ="Request.php?class=PessoaCtr&method=delete&tipo=Fisica&id="+id;
                window.location.replace(a);
            },
            cancel: function () {
               
            }          
        }
    });
});

