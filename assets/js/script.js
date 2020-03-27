$(function(){

	if(typeof maxslider != 'undefined') {
		$( "#slider-range" ).slider({
			range: true,
			min: 0,
			max: maxslider,
			values: [ $('#slider0').val(), $('#slider1').val() ],
			slide: function( event, ui ) {
				$( "#amount" ).val( "R$" + ui.values[ 0 ] + " - R$" + ui.values[ 1 ] );
			},
			change: function( event, ui ) {
				$('#slider'+ui.handleIndex).val(ui.value);
				$('.filterarea form').submit();
			}
		});
	}

	$( "#amount" ).val( "R$" + $( "#slider-range" ).slider( "values", 0 ) + " - R$" + $( "#slider-range" ).slider( "values", 1 ) );
	

	$('.filterarea').find('input').on('change', function(){
		$('.filterarea form').submit();
	});

	$('.addtocartform button').on('click', function(e){
		e.preventDefault();

		var qt = parseInt($('.addtocart_qt').val());
		var action = $(this).attr('data-action');

		if(action == 'decrease') {
			if(qt-1 >= 1) {
				qt = qt - 1;
			}
		}
		else if(action == 'increase') {
			qt = qt + 1;
		}

		$('.addtocart_qt').val(qt);
		$('input[name=qt_product]').val(qt);

	});

	$('.photo_item').on('click', function(){
		var url = $(this).find('img').attr('src');
		$('.mainphoto').find('img').attr('src', url);
	});


	const newLocal = '.addtocart_val a';
	$(newLocal).on('click', function(e){
		e.preventDefault();

		var valor = parseInt($('.total_cart').val());					

		$('.addtocart_val').val(valor);
		$('.carttotal').val(valor);

	});

	$('.photo_item').on('click', function(){
		var url = $(this).find('img').attr('src');
		$('.mainphoto').find('img').attr('src', url);
	});

	

	
});

$("#cpfcnpj").keydown(function(){
    try {
        $("#cpfcnpj").unmask();
    } catch (e) {}

    var tamanho = $("#cpfcnpj").val().length;

    if(tamanho < 11){
        $("#cpfcnpj").mask("999.999.999-99");
    } else {
        $("#cpfcnpj").mask("99.999.999/9999-99");
    }

    // ajustando foco
    var elem = this;
    setTimeout(function(){
        // mudo a posição do seletor
        elem.selectionStart = elem.selectionEnd = 10000;
    }, 0);
    // reaplico o valor para mudar o foco
    var currentValue = $(this).val();
    $(this).val('');
    $(this).val(currentValue);
});

$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
	if (!$(this).next().hasClass('show')) {
	  $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
	}
	var $subMenu = $(this).next(".dropdown-menu");
	$subMenu.toggleClass('show');
  
  
	$(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
	  $('.dropdown-submenu .show').removeClass("show");
	});
  
  
	return false;
  });

  $(function(){
    $('input[name=phone]').mask('(00)00000-0000', {reverse:false, placeholder:"(00)00000-0000"});
    $('input[name=address_zipcode]').mask('00000-000', {reverse:true, placeholder:"00000-000"});
    $('input[name=cpf]').mask('000.000.000-00', {reverse:true, placeholder:"000.000.000-00"});

});

  $('input[name=cep]').on('blur', function () {
    var cep = $(this).val();

    $.ajax({
        url: 'http://api.postmon.com.br/v1/cep/'+cep,
        type:'GET',
        dataType: 'json',
        success:function(json) {
            if (typeof json.logradouro != 'undefinedd') {
                $('input[name=rua]').val(json.logradouro);
                $('input[name=bairro]').val(json.bairro);
                $('input[name=cidade]').val(json.cidade);
                $('input[name=estado]').val(json.estado);
                $('input[name=numero]').focus();
            }
        }
    });
});


//valida o CPF digitado
function ValidarCPF(Objcpf) {
    var cpf = Objcpf.value;
    exp = /\.|\-/g
    cpf = cpf.toString().replace(exp, "");
    var digitoDigitado = eval(cpf.charAt(9) + cpf.charAt(10));
    var soma1 = 0, soma2 = 0;
    var vlr = 11;

    for (i = 0; i < 9; i++) {
        soma1 += eval(cpf.charAt(i) * (vlr - 1));
        soma2 += eval(cpf.charAt(i) * vlr);
        vlr--;
    }
    soma1 = (((soma1 * 10) % 11) == 10 ? 0 : ((soma1 * 10) % 11));
    soma2 = (((soma2 + (2 * soma1)) * 10) % 11);

    var digitoGerado = (soma1 * 10) + soma2;
    if (digitoGerado != digitoDigitado) {
        $('input#cpf').parent().find('span').remove();

        $('input#cpf').addClass('has-error');
		$('input#cpf').after('<strong><span class="erro col-sm-12"><span>Erro:</span>CPF inválido</span></strong>');
		document.form1.cpf.focus();
    } else {
        $('input#cpf').removeClass('has-error');
        $('input#cpf').parent().find('span').remove();

    }


}

function ValidaCelular(celular) {
    exp = /\(\d{2}\)\ \d{5}\-\d{4}/
    if (!exp.test(celular.value)) {
	$('input#phone').parent().find('span').remove();

	$('input#phone').addClass('has-error');
	$('input#phone').after('<strong><span style="color:red">N inválido</span></strong>');
	document.form1.cpf.focus();
} else {
	$('input#phone').removeClass('has-error');
	$('input#phone').parent().find('span').remove();

}
		
}

$(function () {
    $('.radio1').click(function () {
        $('.cpf').show();
        $('.cnpj').hide();
    });
    $('.radio2').click(function () {
        $('.cnpj').show();
        $('.cpf').hide();
    });
});

