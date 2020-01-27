<!DOCTYPE html>
<html>
	<head>
		<title>Bem-Vindo</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="Css/layout.css">
		<!--Bootstrap-->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		
		<!--Font Awesome-->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"> 
		
		<!--Meu Js-->
		<script type="text/javascript" src="funcoes.js"></script>
		<script type="text/javascript">
		
		
			
		</script>
	</head>
	<body>
	<?php
		session_start();
		include_once("includes/Menu.php");
		require_once("conexao.php");
		require_once("funcoes.php");
		
		if((empty($_SESSION['admLogado']) && empty($_SESSION['usuLogado'])) || empty($_COOKIE["Logado"])){
			session_destroy();
			header("Location:index.php");
		}
	?>
		
		<div class="container container-logado visivel" id="cliCad">
			<nav class="navbar navbar-light bg-light ">
				  <a class="navbar-brand">Clientes Cadastrados</a>
				  <form class="form-inline" method="get">
						<input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar" id='buscaCli'>
						<button class="btn my-2 my-sm-0" type="submit">Pesquisar</button>
				  </form>
			</nav>
			<div id="Clientes"> </div>
		</div>
		<div class="container container-logado invisivel form-logado" id="cadCli" style="height:65%;">
			<div class="card-header">
				<h3>Cadastre um Cliente</h3>
			</div>
			<form method="GET" name="cadastraCli">
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-user"></i></span>
					</div>
					<input type="text" class="form-control" placeholder="Nome" name="nome" id='nome' required>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
					</div>
					<input type="text" class="form-control" placeholder="Email" name="email" id='email' required>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-phone"></i></span>
					</div>
					<input type="number" class="form-control" placeholder="ex: 51996299583 (Pode ser adicionado mais tarde)" name="telefone" id='telefon'>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-chess-rook"></i></span>
					</div>
					<input type="text" class="form-control" placeholder="Endereço" name="endereco" id='endereco' required>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-baby"></i></span>
						<label for="data" class="input-group-text"> Data de nascimento </label>
					</div>
					<input type="date" class="form-control" name="data" id='data'>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">CPF:	</span>
					</div>
					<input type="text" class="form-control" placeholder="05123801296 (ignore pontos e traços)" name="cpf" id='cpf' maxlength="11" required>
				</div>
				<div class="form-group">
					<input type="submit" value="Cadastrar" class="btn float-right login_btn" name="cadastrarCliente" id='cadastrarCliente'>
				</div>
			</form>
		</div>
		
		<div class="container invisivel container-logado" id="telCad">
			<nav class="navbar navbar-light bg-light ">
				  <a class="navbar-brand">Telefones cadastrados</a>
				  <form class="form-inline">
						<input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar" id="buscaTel">
						<button class="btn my-2 my-sm-0" type="submit">Pesquisar</button>
				  </form>
			</nav>
			<div id="telefonesT"> </div>
		</div>
		</div>
		<div class="container container-logado invisivel form-logado" id="cadTel" style="height:40%;">
			<div class="card-header">
				<h3>Insira um novo número</h3>
			</div>
			<form method="GET" name="inserirPhone">
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-phone"></i></span>
					</div>
					<input type="number" class="form-control" placeholder="ex: 51995839629" name="numero" id="phoneNumber" required>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<label for="data" class="input-group-text"> Operadora </label>
					</div>
						<?php
							montaSelectOperadoras($link);
						?>
				</div>
				<div class="form-group">
					<input type="submit" value="Cadastrar" class="btn float-right login_btn" name="cadastrarTelefone" id='cadastrarTelefone'>
				</div>
			</form>
		</div>
		
		<div class="container invisivel container-logado" id="ligSim">
			<nav class="navbar navbar-light bg-light ">
				  <a class="navbar-brand">Ligações Simuladas</a>
				  <form class="form-inline">
						<input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
						<button class="btn my-2 my-sm-0" type="submit">Pesquisar</button>
				  </form>
			</nav>
			<?php
				tabelaLigacoes($link);
			?>
		</div>
		<div class="container container-logado invisivel form-logado" id="simLig">
			<div class="card-header">
				<h3>Simule uma Ligação</h3>
			</div>
			<form method="GET" name="simuleLigacao">
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<label for="n1" class="input-group-text"> De </label>
					</div>
					<input type="number" class="form-control" placeholder="ex: 51995839629" name="n1" id='num1' required>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<label for="n1" class="input-group-text"> Para </label>
					</div>
					<input type="number" class="form-control" placeholder="ex: 51995839629" name="n2" id='num2' required>
				</div>
				<div class="form-group">
					<input type="submit" value="Simular" class="btn float-right login_btn" name="simularLigacao" id='simularLigacao'>
				</div>
			</form>
		</div>
		
		<div class="container invisivel container-logado" id="opeCad">
			<nav class="navbar navbar-light bg-light ">
				  <a class="navbar-brand">Operadoras cadastradas</a>
				  <form class="form-inline">
						<input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar" id="buscaOpe">
						<button class="btn my-2 my-sm-0" type="submit">Pesquisar</button>
				  </form>
			</nav>
			<div id="OperadoraT"> </div>
		</div>
		
		<div class="container container-logado invisivel  form-logado" id="cadOpe" style="height:40%;">
			<div class="card-header">
				<h3>Cadastre uma Operadora</h3>
			</div>
			<form method="POST" name="cadastraOpe">
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<label for="operadora" class="input-group-text"> Operadora	</label>
					</div>
					<input type="text" class="form-control" placeholder="Ex: Vivo, Tim, Claro..." name="operadora" id='operadora' required>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<label for="minuto" class="input-group-text"> Preço p/minuto($) </label>
					</div>
					<input type="number" class="form-control" placeholder="25=0.25 50=0.50 100=1.00" name="minuto" id="preco" required>
				</div>
				<div class="form-group">
					<input type="submit" value="Cadastrar" class="btn float-right login_btn" name="cadastrarOperadora" id='cadastrarOperadora'>
				</div>
			</form>
		</div>
		
		<div class="container invisivel container-logado " id="finCad">
			<nav class="navbar navbar-light bg-light ">
				  <a class="navbar-brand">Setor Financeiro</a>
				  <form class="form-inline">
						<input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar" id='buscaFin'>
						<button class="btn my-2 my-sm-0" type="submit">Pesquisar</button>
				  </form>
			</nav>
			<div id='Financeiro'></div>
		</div>
		<div class="form-logado container container-logado invisivel" id="cadFin">
							<div class="card-header">
								<h3>Financeiro</h3>
							</div>
							<!-- Formulário 9 -->
							<form name="form_fin" method="GET">
								<div class="input-group form-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-user"></i></span>
									</div>
									<input type="text" class="form-control" placeholder="Nome" name='nome1' id="nome1" required>
									
								</div>
								<div class="input-group form-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
									</div>
									<input type="email" class="form-control" placeholder="email" name='email1' id="email1" required>
								
								</div>
								<div class="input-group form-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-key"></i></span>
									</div>
									<input type="password" class="form-control" placeholder="senha" name='senha1' id="senha1" required>
								</div>
								<div class="form-group">
									<input type="submit" class="btn float-right login_btn" name="cadastraFin" id="cadastraFin" value=" Cadastrar">
								</div>
							</form>
		</div>
		
		<div class="container invisivel container-logado" id="supCad">
			<nav class="navbar navbar-light bg-light ">
				  <a class="navbar-brand">Setor de Suporte</a>
				  <form class="form-inline">
						<input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar" id='buscaSup'>
						<button class="btn my-2 my-sm-0" type="submit">Pesquisar</button>
				  </form>
			</nav>
			<div id="Suporte"> </div>
		</div>
		<div class="form-logado container container-logado invisivel" id="cadSup">
			<div class="card-header">
				<h3>Suporte</h3>
			</div>
			<form method="GET" name="form_sup">
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-user"></i></span>
					</div>
					<input type="text" class="form-control" placeholder="Nome" name='nome2' id='nome2' required>
					
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
					</div>
					<input type="email" class="form-control" placeholder="email" name='email2' id='email2' required>
				
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-key"></i></span>
					</div>
					<input type="password" class="form-control" placeholder="senha" name='senha2' id='senha2' required>
				</div>
				<div class="form-group">
					<input type="submit" value="Cadastrar" class="btn float-right login_btn" name="cadastraSup" id='cadastraSup'>
				</div>
			</form>
		</div>
		
		<div class="container invisivel container-logado" id="venCad">
			<nav class="navbar navbar-light bg-light ">
				  <a class="navbar-brand">Setor de Vendas</a>
				  <form class="form-inline">
						<input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar" id='buscaVen'>
						<button class="btn my-2 my-sm-0" type="submit">Pesquisar</button>
				  </form>
			</nav>
			<div id="Vendas"> </div>
		</div>
		<div class=" form-logado container container-logado invisivel" id="cadVen">
			<div class="card-header">
				<h3>Vendas</h3>
			</div>
			<form method="GET" name="form_ven">
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-user"></i></span>
					</div>
					<input type="text" class="form-control" placeholder="Nome" name='nome3' id='nome3' required>
					
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
					</div>
					<input type="email" class="form-control" placeholder="email" name='email3' id='email3' required>
				
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-key"></i></span>
					</div>
					<input type="password" class="form-control" placeholder="senha" name='senha3' id='senha3' required>
				</div>
				<div class="form-group">
					<input type="submit" value="Cadastrar" class="btn float-right login_btn" name="cadastraVen" id='cadastraVen'>
				</div>
			</form>
		</div>
		
		<div class="container invisivel container-logado form-logado" id="perfil" style="height: 30%;">
			<div class="col-xs-12 col-sm-8">
                     <?php 
					if(isset($_SESSION['admLogado'])){
						perfilAdm($link,$_SESSION['admLogado']);
					}else{
						perfilUsu($link,$_SESSION['usuLogado'],$_SESSION['Setor']);
					}
					
					 ?>
                </div>          
		</div>

	<script type="text/javascript">
		/* Trocas do menu sem refreseh, to gostando jehuehu */
			
			var perfil = document.getElementById('pf');
			perfil.addEventListener("click",function(){mostra("perfil",11)});
			
			//Limita o valor do telefone para apenas 12 valores
			var limita = document.getElementById("telefon");
			limita.addEventListener('input',limitaTotal);
			
			var limita1 = document.getElementById('phoneNumber');
			limita1.addEventListener('input',limitaTotal);
			
			//Limita preco para até 4 números
			var limitapreco = document.getElementById('preco');
			limitapreco.addEventListener('input',limitaPreco);
			
			//Relacionada as buscas no BD
			var buscaCli = document.getElementById('buscaCli');
			buscaCli.addEventListener('input',function(){tabelasBuscas('Clientes',1,this.value)});
			
			var buscaTel = document.getElementById('buscaTel');
			buscaTel.addEventListener('input',function(){tabelasBuscas('telefonesT',2,this.value)});
			
			var buscaOpe = document.getElementById('buscaOpe');
			buscaOpe.addEventListener('input',function(){tabelasBuscas('OperadoraT',3,this.value)});
			
			var buscaFin = document.getElementById('buscaFin');
			buscaFin.addEventListener('input',function(){tabelasBuscas('Financeiro',4,this.value)});
			
			var buscaSup = document.getElementById('buscaSup');
			buscaSup.addEventListener('input',function(){tabelasBuscas('Suporte',5,this.value)});
			
			var buscaVen = document.getElementById('buscaVen');
			buscaVen.addEventListener('input',function(){tabelasBuscas('Vendas',6,this.value)});
			
			//Cadastros com requisição
			
			var cadastrarCli = document.getElementById('cadastrarCliente');
			cadastrarCli.addEventListener('click',function(){cadastrarCliente('nome','email','telefon','endereco','data','cpf')});
			
			var cadastrarTel = document.getElementById('cadastrarTelefone');
			cadastrarTel.addEventListener('click',function(){cadastraTel('phoneNumber','operadorae')});
			
			var simulacao = document.getElementById('simularLigacao');
			simulacao.addEventListener('click',function(){simularLigacao('num1','num2')});
			
			var cadastraOpe = document.getElementById('cadastrarOperadora');
			cadastraOpe.addEventListener('click',function(){cadastrarOperadora('operadora','preco')});
			
			var cadastraFin = document.getElementById('cadastraFin');
			cadastraFin.addEventListener("click",function(){cadastraUsuario('nome1','email1','senha1',1)});
			
			var cadastraSup = document.getElementById('cadastraSup');
			cadastraSup.addEventListener("click",function(){cadastraUsuario('nome2','email2','senha2',2)});
			
			var cadastraVen = document.getElementById('cadastraVen');
			cadastraVen.addEventListener("click",function(){cadastraUsuario('nome3','email3','senha3',3)});
			

			var ul = document.getElementsByTagName('ul');
			
			var drops = ul[0].getElementsByClassName('dropdown-item');

			 //Por algum motivo, quando fiz isso com um for o parametro passado para a função do evento era sempre o ultimo valor do contador
			drops[0].addEventListener("click",function(){mostra("cliCad",0)}); //O número do event representa o mesmo do drops
			drops[1].addEventListener("click",function(){mostra("cadCli",1)});
			drops[2].addEventListener("click",function(){mostra("telCad",2)});
			drops[3].addEventListener("click",function(){mostra("cadTel",3)});
			drops[4].addEventListener("click",function(){mostra("ligSim",4)});
			drops[5].addEventListener("click",function(){mostra("simLig",5)});
			drops[6].addEventListener("click",function(){mostra("opeCad",6)});
			drops[7].addEventListener("click",function(){mostra("cadOpe",7)});
			//Pular o 8, pq o oito não é clicavel
			drops[9].addEventListener("click",function(){mostra("finCad",9)});
			drops[10].addEventListener("click",function(){mostra("cadFin",10)});
			//pular o 11, pq o onze não é clicavel
			drops[12].addEventListener("click",function(){mostra("supCad",12)});
			drops[13].addEventListener("click",function(){mostra("cadSup",13)});
			//pular o 14, pq o onze não é clicavel
			drops[15].addEventListener("click",function(){mostra("venCad",15)});
			drops[16].addEventListener("click",function(){mostra("cadVen",16)});
			
			
		
	</script>

	<!-- Footer -->
	<?php
		include_once('includes/Footer.php');
	?>

	</body>
</html>