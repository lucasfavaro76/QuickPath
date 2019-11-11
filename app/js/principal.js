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