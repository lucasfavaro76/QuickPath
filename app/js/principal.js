$(".botao").click(function () {
    event.preventDefault();
    $('div.cnpj').toggleClass('invisible');
    $('div.cpf').toggleClass('invisible');
    
    if($('.botao').html() == "Cadastrar Restaurante"){
        $('.botao').html('Cadastrar Pessoa');
    }else{
        $('.botao').html('Cadastrar Restaurante');
    }
    
    //var x = $(".botao").html();
    //var a = x.substr(10, 16);
    if ($("#tipo").attr('value') == "Juridica")
        $("#tipo").attr('value', "Fisica");
    else
        $("#tipo").attr('value', "Juridica");

})

