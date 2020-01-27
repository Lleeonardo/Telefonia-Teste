<script type="text/javascript" src="funcoes.js"></script> <!-- Sendo esse script incluido aqui, ele não precisa ser chamado em cada página novamente -->

<nav class="navbar navbar-expand-lg navbar-light">
	<a class="navbar-brand" href="#">Controle</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
	</button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
		<li class="nav-item active home">
			<a class="nav-link" href="index.php">Home <span class="sr-only">(Página atual)</span></a>
		</li>
	<?php
		if(!isset($_SESSION['admLogado']) && !isset($_SESSION['usuLogado'])){ //Verifica se há alguém logado
	?>
		<span class="nav-item">
			<a class="nav-link"> Para acessar o sistema é necessário Logar! </a>
		</span>
	<?php
			}
	?>
	<?php
		if(isset($_SESSION['admLogado']) || isset($_SESSION['usuLogado'])){ //Verifica se há alguém logado
	?>
		  <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Clientes
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <a class="dropdown-item" href="#">Cadastrados</a>
			  <a class="dropdown-item" href="#">Cadastrar</a>
			</div>
		  </li>
		  <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Telefones
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <a class="dropdown-item" href="#">Cadastrados</a>
			  <a class="dropdown-item" href="#">Cadastrar</a>
			</div>
		  </li>
		  <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Ligações
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <a class="dropdown-item" href="#">Simuladas</a>
			  <a class="dropdown-item" href="#">Simular</a>
			</div>
		  </li>
		  <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Operadoras
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <a class="dropdown-item" href="#">Cadastradas</a>
			  <a class="dropdown-item" href="#">Cadastrar</a>
			</div>
		  </li>
		  <?php
				if(isset($_SESSION['admLogado'])){ //Verifica se há alguém logado
		  ?>
		  <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Usuários
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <span class="dropdown-item">Financeiro</span>
			  <a class="dropdown-item" href="#">Cadastrados</a>
			  <a class="dropdown-item" href="#">Cadastrar</a>
			  
			  <div class="dropdown-divider"></div>
			  
			  <span class="dropdown-item">Suporte</span>
			  <a class="dropdown-item" href="#">Cadastrados</a>
			  <a class="dropdown-item" href="#">Cadastrar</a>
			  
			  <div class="dropdown-divider"></div>
			  
			  <span class="dropdown-item">Vendas</span>
			  <a class="dropdown-item" href="#">Cadastrados</a>
			  <a class="dropdown-item" href="#">Cadastrar</a>
			</div>
		  </li>
		  <?php
			}
		  ?>
		  <li class="nav-item">
			<a class="nav-link" href="#" id="pf">Perfil</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="logOff.php">Sair</a>
		  </li>
    </ul>
  </div>
  <?php
		}
  ?>
</nav>