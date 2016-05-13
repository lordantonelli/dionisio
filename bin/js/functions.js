function navColor(classe){
	

	hoverOn = function(){
		jQuery("#nav-container").addClass(classe);
	}

	hoverOff = function(){
		jQuery("#nav-container").removeClass(classe);
	}

	jQuery("#nav-container ul li."+classe).hover(hoverOn, hoverOff);
}

	//só aceita letras
function soLetras(obj){
     var tecla = (window.event) ? event.keyCode : obj.which;

     if((tecla > 65 && tecla < 90) || (tecla > 96 && tecla < 122)){
           return true;
    }else{
          if (tecla != 8 && tecla != 32) return false;
          else return true;
     }
}

function validaEmail(email){
	if(email != "")
	{
		var filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
		if(filtro.test(email))
		{
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

function login(){
	var email = jQuery('#input-email-log').val();
	var senha = jQuery('#input-senha-log').val();

	if(!validaEmail(email)){
		window.alert('Email invalido!');

	}else if( (senha == '') || (senha.length < 8) ){
		window.alert('Senha muito curta');

	}else if( (email != 'admin@icmc.com') && (email !='renata@icmc.com') ){
		window.alert('Email não cadastrado!');

	}else if( (email == 'admin@icmc.com' && senha != '12345678') || (email == 'renata@icmc.com' && senha != 'Renata1@') ){
		window.alert('Senha incorreta!');

	}else if( (email == 'admin@icmc.com' && senha == '12345678') || (email == 'renata@icmc.com' && senha == 'Renata1@') ){
		sessionLogin(true);
		window.location = jQuery('li.home a').attr("href");
	}
}


function cadastrar(){
	var email = jQuery('#input-email').val();
	var senha = jQuery('#input-senha').val();
	var senha2 = jQuery('#input-senha2').val();
	var telefone = jQuery('#input-telefone').val();

	var idade = jQuery("#input-data-nascimento").val();
	idade = moment( (typeof idade !== 'undefined' ? idade : new Date()) , "DD-MM-YYYY" );
	var dataLimite = moment().subtract(13, 'years');

	if(idade > dataLimite){
		window.alert('Idade mínima de 13 anos');

	}else if(telefone == "" || telefone.length < 14 ){
		window.alert('Telefone inválido!')

	}else if(!validaEmail(email)){
		window.alert('Email inválido!');

	}else if( (email == 'admin@icmc.com') || (email == 'renata@icmc.com') ){
		window.alert('Email já cadastrado!');

	}else if( !validaSenha(senha) ){
		window.alert('A senha deve ter 8 caracteres, contendo no mínimo, 1 letra maiúscula, 1 caracter especial(!#$%), 1 dígito e 1 letra minúscula');

	}else if(senha != senha2){
		window.alert('Senhas não conferem!');
	}else{
		sessionLogin(true);
		window.alert('Simulação de cadastro realizado com sucesso!');
		window.location = jQuery('li.home a').attr("href");
	}
}

function cadastrar_receita(){
	var nome = jQuery('#input-nome-receita').val();

	if(nome.length < 5){
		window.alert('O nome da receita deve conter no mínimo 5 caracteres');

	}else{
		window.alert('Receita cadastrada com sucesso!');
		window.location = jQuery('li.home a').attr("href");
	}
}

function ajustar_fonte(tipo){
	var font = 0;
	if(tipo == '+'){
		font = 2;
	}else if(tipo == '-'){
		font = -2;
	}

	jQuery('section .container *').each(function(){
	   var tam = jQuery(this).css('font-size');
	   tam = Math.round(tam.split('px')[0]);
	   if(tam > 12){

		tam = tam+font;
			if(tam < 14){
				tam = 14;
			}
			jQuery(this).css('font-size', tam+'px');
		}
	});
}

function contraste(cont){
	jQuery('*').each(function(){
	   jQuery(this).css('background-color', 'black');
	   jQuery(this).css('color', 'white');
	   jQuery(this).css('border-color', 'white');

	});
}

function validaSenha(senha){

	if(senha != "")
	{
		var filtro = /(?=(.*[0-9])+(.*[ !\"#$%&'()*+,\-.\/:;<=>?@\[\\\]^_`{|}~])+)(?=(.*[a-z])+)(?=(.*[A-Z])+)[0-9a-zA-Z !\"#$%&'()*+,\-.\/:;<=>?@\[\\\]^_`{|}~]{8,}/;
		if(filtro.test(senha))
		{
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

function sessionLogin(value){
	if(value){
		Cookies.set('session', 'true');
	}else{
		Cookies.remove('session');
		window.location = jQuery('li.home a').attr("href");
	}
}

function addItemLista(id, placeholder){
	var name = id.replace('#', '');
	var num = jQuery('.'+name).size()+1;
	var input = '<input type="text" id="'+name+num+'" class="form-control '+name+'" name="'+name+'[]" placeholder="'+placeholder+' '+num+'" aria-label="'+placeholder+' '+num+'">';


	jQuery(id).append(input);

}