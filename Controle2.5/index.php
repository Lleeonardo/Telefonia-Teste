<!DOCTYPE html>
<html>
	<head>
		<title> Página inicial</title>
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
		
		
	</head>
	<body>
	<?php
		session_start();
		require_once("conexao.php"); //DESCOBRIR SE DEVO USAR REQUIRE OU INCLUDE, ALÉM, ONCE OU SEM
		require_once("funcoes.php");
		include_once("includes/Menu.php");
		
		if(isset($_POST['admCad'])){
			CadastroAdm($link,$_POST['nome'],$_POST['email'],$_POST['senha']); //Cadastra e volta para a tela inicial
		}
		
		if(isset($_POST['FinLogin'])){
			
			$email = $_POST['email'];
			$senha = $_POST['senha'];
			$senha = md5($senha);
			$email = htmlspecialchars(addslashes($email));
			$query = "SELECT * FROM USUARIOS WHERE email LIKE '$email' AND senha LIKE '$senha' AND visivel=TRUE AND setor=1";
			
			if(VerificaLogin($link,$query,$email,$senha)){
			
				$_SESSION['Setor'] = 1;
				$result = mysqli_query($link,$query);
				$linha = mysqli_fetch_array($result);
				$_SESSION['usuLogado'] = $linha['idUsuarios'];
				setcookie("Logado",1,time()+60*10);
				header('Location:BemVindo.php');
			
			
			}else{
				echo "<p class='notice-php'>*email ou senha incorretos</p>";
			}
		}
		
		if(isset($_POST['VenLogin'])){
			
			$email = $_POST['email'];
			$senha = $_POST['senha'];
			$senha = md5($senha);
			$email = htmlspecialchars(addslashes($email));
			$query = "SELECT * FROM USUARIOS WHERE email LIKE '$email' AND senha LIKE '$senha' AND visivel=TRUE AND setor=3";
			
			if(VerificaLogin($link,$query,$email,$senha)){
			
				$_SESSION['Setor'] = 3;
				$result = mysqli_query($link,$query);
				$linha = mysqli_fetch_array($result);
				$_SESSION['usuLogado'] = $linha['idUsuarios'];
				setcookie("Logado",1,time()+60*10);
				header('Location:BemVindo.php');
				
			
			
			}else{
				echo "<p class='notice-php'>*email ou senha incorretos</p>";
			}
			
			
		}
		
		if(isset($_POST['SupLogin'])){
			
			$email = $_POST['email'];
			$senha = $_POST['senha'];
			$senha = md5($senha);
			$email = htmlspecialchars(addslashes($email));
			$query = "SELECT * FROM USUARIOS WHERE email LIKE '$email' AND senha LIKE '$senha' AND visivel=TRUE AND setor=2";
			
			if(VerificaLogin($link,$query,$email,$senha)){
			
				$_SESSION['Setor'] = 3;
				$result = mysqli_query($link,$query);
				$linha = mysqli_fetch_array($result);
				$_SESSION['usuLogado'] = $linha['idUsuarios'];
				setcookie("Logado",1,time()+60*10);
				header('Location:BemVindo.php');
			
			
			}else{
				echo "<p class='notice-php'>*email ou senha incorretos</p>";
			}
			
			
		}

	?>
	<main >
		<section >
			<div class="container modeLogin">
				<form class="form-inline justify-content-center h-100">
					<button class="btn login-ativo" type="button" id="visivel">Adminstrador</button>
					<button class="btn" type="button" id="invisivel">Usuários</button>
				</form>
			</div>
			<div class="container visivel ver">
				<div class="d-flex justify-content-center h-100">
					<div class="card">
						<div class="card-header">
							<h3>Administrador</h3>
						</div>
						<div class="card-body">
							<form method="POST" action="index.php">
								<div class="input-group form-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
									</div>
									<input type="text" class="form-control" placeholder="email" name='email'>
									
								</div>
								<div class="input-group form-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-key"></i></span>
									</div>
									<input type="password" class="form-control" placeholder="senha" name='senha'>
								</div>
								<div class="form-group">
									<input type="submit" value="Login" class="btn float-right login_btn" name="admLogin">
								</div>
							</form>
							<?php
								if(isset($_POST['admLogin'])){

									$email = $_POST['email'];
									$senha = $_POST['senha'];
									$senha = md5($senha);
									$email = htmlspecialchars(addslashes($email));
									$query = "SELECT * FROM ADMINISTRADORES WHERE email LIKE '$email' AND senha LIKE '$senha' AND visivel=TRUE";

									if(VerificaLogin($link,$query,$email,$senha)){
										
										$result = mysqli_query($link,$query);
										$linha = mysqli_fetch_array($result);
										$_SESSION['admLogado'] = $linha['idAdministrador'];
										setcookie("Logado",1,time()+60*10);
										header('Location:BemVindo.php');
						
									}else{
										echo "<p class='notice-php'>*email ou senha incorretos</p>";
									}
								}
							?>
						</div>
						
						<div class="card-footer">
	
							<div class="d-flex justify-content-center links">
								
									<a href="#" id="cad"> 
										<?php	//Verifica se é primeira utilização do sistema, se for pode ser cadastrado ADM. Se não não mostra a opção
										$query = "SELECT * FROM ADMINISTRADORES";
										$result = mysqli_query($link,$query);
										
										if(mysqli_num_rows($result)==0){
										?> 
										
											Cadastrar Administrador
										
										<?php
										}
										?>
									</a>
								
							</div>
							
							<div class="d-flex justify-content-center">
								<a href="#">Esqueceu sua senha?</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container invisivel ver">
				<div class="d-flex justify-content-center h-100">
					<div class="card">
						<div class="card-header">
							<h3>Usuários</h3>
						</div>
						<div class="card-body">
							<div>
								<button class="btn btn-block" type="button" id="loginFin">Financeiro</button>
								<button class="btn btn-block" type="button" id="loginVen">Vendas</button>
								<button class="btn btn-block" type="button" id="loginSup">Suporte</button>
							</div>
						</div>
						<div class="card-footer">
							<div class="d-flex justify-content-center">
								Escolha seu modo de login
							</div>
						</div>
					</div>
				</div>
			</div> 
			<div class="container invisivel ver">
				<div class="d-flex justify-content-center h-100">
					<div class="card">
						<div class="card-header">
							<h3>Fincanceiro</h3>
						</div>
						<div class="card-body">
							<form method="POST">
								<div class="input-group form-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
									</div>
									<input type="text" class="form-control" placeholder="email" name='email'>
									
								</div>
								<div class="input-group form-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-key"></i></span>
									</div>
									<input type="password" class="form-control" placeholder="senha" name='senha'>
								</div>
								<div class="form-group">
									<input type="submit" value="Login" class="btn float-right login_btn" name="FinLogin">
								</div>
							</form>
							<!--O PHP de login fica embaixo do form, para então a mensagem aparecer no lugar correto. Warning: Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\Controle2.5\index.php:31) in C:\xampp\htdocs\Controle2.5\index.php on line 176, mas esse erro sempre vinha. -->
						</div>
						<div class="card-footer">
							<div class="d-flex justify-content-center">
								<a href="#">Esqueceu sua senha?</a>
							</div>
						</div>
					</div>
				</div>
			</div> 
			<div class="container invisivel ver">
				<div class="d-flex justify-content-center h-100">
					<div class="card">
						<div class="card-header">
							<h3>Vendas</h3>
						</div>
						<div class="card-body">
							<form method="POST" action="index.php">
								<div class="input-group form-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
									</div>
									<input type="text" class="form-control" placeholder="email" name='email'>
									
								</div>
								<div class="input-group form-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-key"></i></span>
									</div>
									<input type="password" class="form-control" placeholder="senha" name='senha'>
								</div>
								<div class="form-group">
									<input type="submit" value="Login" class="btn float-right login_btn" name="VenLogin">
								</div>
							</form>
						</div>
						<div class="card-footer">
							<div class="d-flex justify-content-center">
								<a href="#">Esqueceu sua senha?</a>
							</div>
						</div>
					</div>
				</div>
			</div> 
			<div class="container invisivel ver">
				<div class="d-flex justify-content-center h-100">
					<div class="card">
						<div class="card-header">
							<h3>Suporte</h3>
						</div>
						<div class="card-body">
							<form method="POST" action="index.php">
								<div class="input-group form-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
									</div>
									<input type="text" class="form-control" placeholder="email" name='email'>
									
								</div>
								<div class="input-group form-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-key"></i></span>
									</div>
									<input type="password" class="form-control" placeholder="senha" name='senha'>
								</div>
								<div class="form-group">
									<input type="submit" value="Login" class="btn float-right login_btn" name="SupLogin">
								</div>
							</form>
						</div>
						<div class="card-footer">
							<div class="d-flex justify-content-center">
								<a href="#">Esqueceu sua senha?</a>
							</div>
						</div>
					</div>
				</div>
			</div> 
			<div class="container invisivel ver">
				<div class="d-flex justify-content-center h-100">
					<div class="card">
						<div class="card-header">
							<h3>Administrador</h3>
						</div>
						<div class="card-body">
							<form method="POST" name="CadastroADM">
								<div class="input-group form-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-user"></i></span>
									</div>
									<input type="text" class="form-control" placeholder="Nome" name='nome' required>
									
								</div>
								<div class="input-group form-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
									</div>
									<input type="email" class="form-control" placeholder="email" name='email' required>
								
								</div>
								<div class="input-group form-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-key"></i></span>
									</div>
									<input type="password" class="form-control" placeholder="senha" name='senha' required>
								</div>
								<div class="form-group">
									<input type="submit" value="Cadastrar" class="btn float-right login_btn" name="admCad">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
	<!--Meu Js-->
		<script type="text/javascript">
				//Criação dos eventos
				var visivel = document.getElementById('visivel');
				visivel.addEventListener("click",adm); //alterna o modo de login para administrador
										
				var invisivel = document.getElementById('invisivel');
				invisivel.addEventListener("click",usu); //alterna o modo de login para usuario

				var cadAdm = document.getElementById('cad');
				cadAdm.addEventListener("click",atencao); //alterna o modo de login para cadastro de administrador
				
				//Eventos atrelados as funções para o modo de login do usuário
				var loginFin = document.getElementById('loginFin');
				loginFin.addEventListener("click",function(){loginUsuMode(2)});
				
				var loginVen = document.getElementById('loginVen');
				loginVen.addEventListener("click",function(){loginUsuMode(3)});
				
				var loginSup = document.getElementById('loginSup');
				loginSup.addEventListener("click",function(){loginUsuMode(4)});

		</script>
	<!-- Footer -->
	<?php
		include_once('includes/Footer.php');
	?>

	</body>
</html>