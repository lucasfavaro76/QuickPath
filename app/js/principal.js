$(".botao").click(function () {
    $('div.cnpj').toggleClass('invisible');
    $('div.cpf').toggleClass('invisible');
    
    //var x = $(".botao").html();
    //var a = x.substr(10, 16);
    if ($("#tipo").attr('value') == "Juridica")
        $("#tipo").attr('value', "Fisica");
    else
        $("#tipo").attr('value', "Juridica");

})
