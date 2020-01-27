<?php
	
	require_once(".././conexao.php");
	$informe = filter_input(INPUT_GET, "informe");
	
	$query = "select * from OPERADORAS where visivel LIKE TRUE AND nomeOperadora LIKE '%$informe%'";
	$result1 = mysqli_query($link,$query);
	
	if(mysqli_num_rows($result1)>0){
	
			if(strlen($informe)>1){
				
				echo"<table class='table table-hover table-responsive-sm table-responsive-md table-warning'>
							 <thead>
									<tr>
										  <th scope='col'>Operadora</th>
										  <th scope='col'>Preco p/minuto</th>
									</tr>
							  </thead>
							  
							  <tbody>";
							  while($linha1 = mysqli_fetch_array($result1)){
									
										echo "<tr><th scope='row'>".$linha1['nomeOperadora']."</th><td>".$linha1['custoMin']."R$"."</td>";
									
							  }
						echo"
							  </tbody>
						</table>";
			}
	}else{
		if(strlen($informe)>1){
					echo"<table class='table table-hover table-responsive-sm table-responsive-md table-warning'>
							 <thead>
									  <caption class='tittle-table'>Nenhum Resultado encontrado</caption>
									
							  </thead></table>";
		}
		
	}
	
?>