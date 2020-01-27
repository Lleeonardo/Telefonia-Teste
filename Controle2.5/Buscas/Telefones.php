<?php
	
	require_once(".././conexao.php");
	$informe = filter_input(INPUT_GET, "informe");
	
	//Telefone com cliente atrelado
	$query = "select numTelefones,nomeOperadora,nome 
			from 
				TELEFONES AS T,CLIENTES AS C,OPERADORAS AS O
			where 
				T.visivel LIKE TRUE
				AND C.visivel LIKE TRUE
				AND O.visivel LIKE TRUE
				AND telefone = numTelefones
				AND numTelefones = '$informe%'
				AND idOperadoras = T.operadora";
	$result = mysqli_query($link,$query);
	
	//Telefone sem cliente atrelado
	$query = "select numTelefones,nomeOperadora 
			from 
				TELEFONES AS T,OPERADORAS AS O
			where 
				T.visivel LIKE TRUE
				AND O.visivel LIKE TRUE
				AND numTelefones = '$informe%'
				AND idOperadoras = T.operadora";
				
	$result1 = mysqli_query($link,$query);
	
	if(mysqli_num_rows($result)>0){
	
			if(strlen($informe)>0){
					
			 
				echo"<table class='table table-hover table-responsive-sm table-responsive-md table-warning'>
							 <thead>
									<tr>
										  <th scope='col'>Número</th>
										  <th scope='col'>Operadora</th>
										   <th scope='col'>Cliente</th>
									</tr>
							  </thead>
							  
							  <tbody>";
							  while($linha= mysqli_fetch_array($result)){
								 
										echo "<tr><th scope='row'>".$linha['numTelefones']."</th><td>".$linha['nomeOperadora']."</td><td>".
											$linha['nome']."</td>";
										
							  }
						echo"
							  </tbody>
						</table>";
			}
	}else if(mysqli_num_rows($result1)>0){
				if(strlen($informe)>0){
					
			 
					echo"<table class='table table-hover table-responsive-sm table-responsive-md table-warning'>
								 <thead>
										<tr>
											  <th scope='col'>Número</th>
											  <th scope='col'>Operadora</th>
											   <th scope='col'>Cliente</th>
										</tr>
								  </thead>
								  
								  <tbody>";
								  while($linha= mysqli_fetch_array($result1)){
									 
											echo "<tr><th scope='row'>".$linha['numTelefones']."</th><td>".$linha['nomeOperadora']."</td><td>Indefinido</td>";
											
								  }
							echo"
								  </tbody>
							</table>";
				}
				
	}else if(strlen($informe)>10){
					echo"<table class='table table-hover table-responsive-sm table-responsive-md table-warning'>
							 <thead>
									  <caption class='tittle-table'>Nenhum Resultado encontrado</caption>
									
							  </thead></table>";
	}
		
?>