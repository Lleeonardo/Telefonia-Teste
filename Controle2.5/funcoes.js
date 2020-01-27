
//Criação das funções
function adm(){ //seleciona o modo Login do Administrador
	
	//Necessário para quando voltar a tela do ADM não dar conflito
	var outros = document.getElementsByClassName("ver");
	outros[2].style.display="none";
	outros[3].style.display="none";
	outros[4].style.display="none";
	//
	
	var visivel = document.getElementsByClassName('visivel');
	var invisivel = document.getElementsByClassName('invisivel');
		
	visivel[0].style.display="block";
	invisivel[0].style.display="none";
	

	this.className = "login-ativo btn";
	
	var usu = document.getElementById("invisivel");
	usu.className = "";
	usu.className = "btn";
	
	
}

function usu(){ //seleciona o modo Login do usuario
	
	//Necessário para quando voltar a tela do usuário não dar conflito
	var outros = document.getElementsByClassName("ver");
	outros[2].style.display="none";
	outros[3].style.display="none";
	outros[4].style.display="none";
	//
	
	var visivel = document.getElementsByClassName('visivel');
	var invisivel = document.getElementsByClassName('invisivel');
		
	visivel[0].style.display="none";
	invisivel[0].style.display="block";
	
	this.className="login-ativo btn";
	
	
	var adm = document.getElementById("visivel");
	adm.className="";
	adm.className = "btn";
		
}

function atencao(){ //Torna o cadastro de administrador visivel, também torna o botão de home visivel
	alert("Atenção! Você só poderá cadastrar outros Administradores e usuários logado");
	var aux = document.getElementsByClassName('home');
	
	aux[0].style.visibility="visible"; //Habilita o botão home do menu
	
	var visivel = document.getElementsByClassName('visivel');
	var invisivel = document.getElementsByClassName('invisivel');
	var idVisivel = document.getElementById('visivel');
	var idInvisivel = document.getElementById('invisivel');
	
	idVisivel.style.display ="none";
	idInvisivel.style.display ="none";
	visivel[0].style.display="none";
	invisivel[0].style.display="none";
	
	//Necessário para quando voltar a tela do usuário não dar conflito| Referentes aos modos de Login do Usuário
	var outros = document.getElementsByClassName("ver");
	outros[2].style.display="none";
	outros[3].style.display="none";
	outros[4].style.display="none";
	//
	
	outros[5].style.display="block"; //Referente ao elemento cadastro de Administrador
	
	
}

function mostra(par,aux){
		//par = id
		//auc = posição na página
		var elementos = document.getElementsByClassName('container-logado');
		limpaTela(elementos);
		var teste = document.getElementById(par).style.display="block";
	

		function limpaTela(elementos,aux){
				for(i=0;i<elementos.length;i++){
					if(elementos[i]!=aux){
						elementos[i].style.display="none";
					}
				}
		}

}

//
function loginUsuMode(modeLogin){
	
	var aux = document.getElementsByClassName('ver');
	
	limpaTela(modeLogin,aux);
	var usu = document.getElementById("invisivel");
	usu.removeEventListener("click",usu);
	aux[modeLogin].style.display="block";
		
		
	function limpaTela(modeLogin,aux){
				for(i=0;i<aux.length;i++){
						if(aux!=modeLogin){
							aux[i].style.display="none";
						}
				}
	}
	
}

//limita os valores para o telefone
function limitaTotal (evt) {
    var input = evt.target;
    var value = input.value;
	var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
				document.getElementById(id).innerHTML = this.responseText;
			};
	
	
    if (value.length <= 12) {
        return;
    }

    input.value = input.value.substr(0, 12); 
}

function limitaPreco (evt) {
    var input = evt.target;
    var value = input.value;
	
    if (value.length <= 4) {
        return;
    }

    input.value = input.value.substr(0, 4); 
}


//Requisição para as buscas no banco
function tabelasBuscas(id,usu,str) {
		event.preventDefault();
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
				document.getElementById(id).innerHTML = this.responseText;
			};
		
		switch(usu){
			case 1:
				xmlhttp.open("GET", "Buscas/Clientes.php?informe=" + str, true);
				xmlhttp.send();
			break;
			case 2:
				xmlhttp.open("GET", "Buscas/Telefones.php?informe=" + str, true);
				xmlhttp.send();
			break;
			case 3:
				xmlhttp.open("GET", "Buscas/Operadoras.php?informe=" + str, true);
				xmlhttp.send();
			break;
			case 4:
				xmlhttp.open("GET", "Buscas/Financeiro.php?informe=" + str, true);
				xmlhttp.send();
			break;
			case 5:
				xmlhttp.open("GET", "Buscas/Suporte.php?informe=" + str, true);
				xmlhttp.send();
			break;
			case 6:
				xmlhttp.open("GET", "Buscas/Vendas.php?informe=" + str, true);
				xmlhttp.send();
			break;
			default:
				alert("Ocorreu um erro interno");
		}
}

//Requisições para cadastros no BD
function cadastraUsuario(nome,email,senha,setor){

	event.preventDefault();
	var xmlhttp = new XMLHttpRequest();
	var inputs =[];
	
	inputs[0] = document.getElementById(nome).value;
	inputs[1] = document.getElementById(email).value;
	inputs[2] = document.getElementById(senha).value;
	inputs[3] = setor;
	
	var json = '[{"nome":"'+inputs[0]+'","email":"'+inputs[1]+'","senha":"'+inputs[2]+'","setor":"'+inputs[3]+'"}]';
	xmlhttp.open("GET","Cadastros/cadastrarUsuarios.php?json="+json,true);
	xmlhttp.send();
		
	switch(setor){
		case 1:
			document.form_fin.reset();
		break;
		case 2:
			document.form_sup.reset();
		break;
		case 3:
			document.form_ven.reset();
		break;
		default:
			alert('erro');
	}
	alert("cadastrado com sucesso");
	
}

function cadastrarCliente(nome,email,telefone,endereco,data,cpf){
	event.preventDefault();
	var xmlhttp = new XMLHttpRequest();
	
	var inputs=[];
	inputs[0] = document.getElementById(nome).value;
	inputs[1] = document.getElementById(email).value;
	inputs[2] = document.getElementById(telefone).value;
	inputs[3] = document.getElementById(endereco).value;
	inputs[4] = document.getElementById(data).value;
	inputs[5] = document.getElementById(cpf).value;
	
	var json = '[{"nome":"'+inputs[0]+'","email":"'+inputs[1]+'","telefone":"'+inputs[2]+'","endereco":"'+inputs[3]+'","data":"'+inputs[4]+'","cpf":"'+inputs[5]+'"}]';
	
	xmlhttp.open("GET","Cadastros/cadastrarClientes.php?json="+json,true);
	xmlhttp.send();
	
	document.cadastraCli.reset();
	alert("cadastrado com sucesso");
}

function cadastraTel(telefone,operadora){
	event.preventDefault();
	var xmlhttp = new XMLHttpRequest();
	
	var inputs=[];
	inputs[0] = document.getElementById(telefone).value;
	inputs[1] = document.getElementById(operadora).value;
	
	var json = '[{"telefone":"'+inputs[0]+'","operadora":"'+inputs[1]+'"}]';
	
	xmlhttp.open("GET","Cadastros/cadastrarTelefone.php?json="+json,true);
	xmlhttp.send();
	
	document.inserirPhone.reset();
	alert("cadastrado com sucesso");
}

function cadastrarOperadora(operadora,preco){
	event.preventDefault();
	var xmlhttp = new XMLHttpRequest();
	
	var inputs=[];
	inputs[0] = document.getElementById(operadora).value;
	inputs[1] = document.getElementById(preco).value;
	
	var json = '[{"operadora":"'+inputs[0]+'","preco":"'+inputs[1]+'"}]';
	
	xmlhttp.open("GET","Cadastros/cadastrarOperadora.php?json="+json,true);
	xmlhttp.send();
	
	document.cadastraOpe.reset();
	alert("cadastrado com sucesso");
}

function simularLigacao(numero1,numero2){
	event.preventDefault();
	var xmlhttp = new XMLHttpRequest();
	
	var inputs=[];
	inputs[0] = document.getElementById(numero1).value;
	inputs[1] = document.getElementById(numero2).value;
	
	var json = '[{"de":"'+inputs[0]+'","para":"'+inputs[1]+'"}]';
	
	xmlhttp.open("GET","Cadastros/simulacao.php?json="+json,true);
	xmlhttp.send();
	
	document.simuleLigacao.reset();
	alert("Simulando...");
}
