function onlynumber(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    //var regex = /^[0-9.,]+$/;
    var regex = /^[0-9.]+$/;
    if( !regex.test(key) ) {
       theEvent.returnValue = false;
       if(theEvent.preventDefault) theEvent.preventDefault();
    }
}
 
function mascararTel(v){
    v=v.replace(/\D/g,"");            
    v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); 
    v=v.replace(/(\d)(\d{4})$/,"$1-$2");   
    return v;
}

function validaTel() {
    telefone = document.forms["mainForm"]['telefone'].value;
    document.forms["mainForm"]['telefone'].value = mascararTel(telefone);
}

function mascararCPF(v){
    v=v.replace(/\D/g,"");
    if(v.length< 7) {
        v=v.replace(/^(\d{3})(\d)/g, "$1.$2");
    }
    else if(v.length<10){
        v=v.replace(/^(\d{3})(\d{3})(\d)/g, "$1.$2.$3");
    }
    else{
        v=v.replace(/^(\d{3})(\d{3})(\d{3})(\d)/g, "$1.$2.$3-$4");
    }
    return v;
}

function validaCPF() {
    cpf = document.forms["mainForm"]['cpf'].value;
    document.forms["mainForm"]['cpf'].value = mascararCPF(cpf);
}

function mascararRG(v){
    v=v.replace(/\D/g,"");
    if(v.length< 6) {
        v=v.replace(/^(\d{2})(\d)/g, "$1.$2");
    }
    else if(v.length<9){
        v=v.replace(/^(\d{2})(\d{3})(\d)/g, "$1.$2.$3");
    }
    else{
        v=v.replace(/^(\d{2})(\d{3})(\d{3})(\d)/g, "$1.$2.$3-$4");
    }
    return v;
}

function validaRG() {
    rg = document.forms["mainForm"]['rg'].value;
    document.forms["mainForm"]['rg'].value = mascararRG(rg);
}

function mascararCEP(v){
    v=v.replace(/\D/g,"");
    v=v.replace(/^(\d{5})(\d)/g, "$1-$2");
    return v;
}

function validaCEP() {
    cep = document.forms["mainForm"]['cepa'].value;
    document.forms["mainForm"]['cepa'].value = mascararCEP(cep);
}

function checkCEP(){
    var cep = document.forms["mainForm"]['cepa'].value.replace("-","");
		$.ajax({
			url: 'https://viacep.com.br/ws/'+cep+'/json/unicode/',
			dataType: 'json',
			success: function(resposta){
				//Agora basta definir os valores que você deseja preencher
				//automaticamente nos campos acima.
				$("#logradouro").val(resposta.logradouro);
				$("#bairro").val(resposta.bairro);
				$("#cidade").val(resposta.localidade);
				$("#uf").val(resposta.uf);
				$("#numero").focus();
			}
		});
}

function valida() {
    nome = document.forms["mainForm"]['nome'].value;
    email = document.forms["mainForm"]['email'].value;
    sobrenome = document.forms["mainForm"]['sobrenome'].value;
    cep = document.forms["mainForm"]['cepa'].value;
    numero = document.forms["mainForm"]['num'].value;
    data_nascimento = document.forms["mainForm"]['dtnasc'].value;
    cpf = document.forms["mainForm"]['cpf'].value;
    rg = document.forms["mainForm"]['rg'].value;
    guarda_religiosa = document.forms["mainForm"]['g_r'].value;
    obs = document.forms["mainForm"]['obs'].value;
    telefone = document.forms["mainForm"]['telefone'].value;
    sexo = document.forms["mainForm"]['sexo'].value;
    estado = document.forms["mainForm"]['estado'].value;
    cidade = document.forms["mainForm"]['cidade'].value;
    logradouro = document.forms["mainForm"]['endereco'].value;
    bairro = document.forms["mainForm"]['bairro'].value;

    inputs = [nome, email, sobrenome, cep, numero, data_nascimento, cpf,
    rg, guarda_religiosa, telefone, sexo, estado, cidade, logradouro, bairro];

    for(i = 0; i< inputs.length; i++){
        if(inputs[i] == "" || inputs[i] == "Selecione...") {
            alert("Preencha todos os campos");
            return false;
        };
    }

    if(telefone.length<14){
        alert("Digite o telefone completo.");
        return false;
    }
    else if(cpf.length<14){
        alert("Digite o CPF completo.")
    }
    else if(rg.length<12){
        alert("Digite o RG completo.")
    }    
    else if(cep.length<9){
        alert("Digite o CEP completo.")
    }
    return true;
}









function guarda() {
    if(document.forms["mainForm"]['g_r'].value == "1") {
        document.forms["mainForm"]['obs'].disabled = false;
    }
    else {
        document.forms["mainForm"]['obs'].disabled = true;
        document.forms["mainForm"]['obs'].value = "";
    }
}


