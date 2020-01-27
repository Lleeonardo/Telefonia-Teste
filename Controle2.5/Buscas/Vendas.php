<?php
	require_once(".././conexao.php");
	$informe = filter_input(INPUT_GET, "informe");
	
	$query = "SELECT * from USUARIOS where visivel = TRUE AND setor = 3 AND(idUsuarios LIKE '%$informe%' or nome LIKE '%$informe%' or email LIKE '%$informe%')";
	
	$result = mysqli_query($link, $query);
			
	if(mysqli_num_rows($result)){
		if(strlen($informe)>0){
			echo"<table class='table table-hover table-responsive-sm table-responsive-md table-warning'>
					 <thead>
							<tr>
								  <th scope='col'>ID</th>
								  <th scope='col'>Nome</th>
								  <th scope='col'>Email</th>
								  <th scope='col'>Admitido</th>
							</tr>
					  </thead>
					  <tbody>";
					  while($linha = mysqli_fetch_array($result)){
					  
							echo "<tr><th scope='row'>".$linha['idUsuarios']."</th><td>".$linha['nome']."</td><td>".
							$linha['email']."</td><td>".$linha['inserido']."</td></td>";
					  }
			   echo" </tbody>
				</table>";
		}
	}else{
		if(strlen($informe)>0){
			echo"<table class='table table-hover table-responsive-sm table-responsive-md table-warning'>
							 <thead>
									  <caption class='tittle-table'>Nenhum Resultado encontrado</caption>
									
							  </thead></table>";
		}
	}
?>