<?php
	
	
	require_once(".././conexao.php");
	$informe = filter_input(INPUT_GET, "informe");
	
	$query = "select 
					cpf,nome,telefone,email,descricao,endereco,inserido 
			from 
				CLIENTES C,SITUACAO S 
			where 
				C.visivel LIKE TRUE 
                AND S.visivel LIKE TRUE 
                AND idSituacao = situacao
				AND(nome LIKE '$informe%' or 
                email LIKE '$informe%' or 
                endereco LIKE '$informe%' or 
                cpf LIKE '$informe%' or 
				descricao LIKE '$informe%' or
                telefone LIKE '$informe%')";
	$result1 = mysqli_query($link,$query);
	
	if(mysqli_num_rows($result1) > 0){
	
			if(strlen($informe)>2){
				
				echo"<table class='table table-hover table-responsive-sm table-responsive-md table-warning'>
							 <thead>
									<tr>
										  <th scope='col'>CPF</th>
										  <th scope='col'>Nome</th>
										  <th scope='col'>Telefone</th>
										  <th scope='col'>Email</th>
										  <th scope='col'>Situação</th>
										  <th scope='col'>Endereço</th>
										  <th scope='col'>Desde</th>
									</tr>
							  </thead>
							  
							  <tbody>";
							  while($linha1 = mysqli_fetch_array($result1)){
									
										echo "<tr><th scope='row'>".$linha1['cpf']."</th><td>".$linha1['nome']."</td><td>".
										$linha1['telefone']."</td><td>".$linha1['email']."</td><td>".$linha1['descricao'].
										"</td><td>".$linha1['endereco']."</td><td>".$linha1['inserido']."</td><tr>";
									
							  }
						echo"
							  </tbody>
						</table>";
			}
	}else{
		if(strlen($informe)>2){
					echo"<table class='table table-hover table-responsive-sm table-responsive-md table-warning'>
							 <thead>
									  <caption class='tittle-table'>Nenhum Resultado encontrado</caption>
									
							  </thead></table>";
		}
		
	}
	
?>