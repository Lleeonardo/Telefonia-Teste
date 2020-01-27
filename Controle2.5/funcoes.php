<?php
	//PESQUISAR ONDE USAR O MYSQLI_CLOSE()

	function CadastroAdm($link,$nome,$email,$senha){
			
			$senha = md5($senha);
			$nome = htmlspecialchars(addslashes($nome));
			$email = htmlspecialchars(addslashes($email));
			
			$query = "insert into ADMINISTRADORES
				(nome, email, senha, inserido, visivel) values
					('$nome', '$email', '$senha', CURDATE(), TRUE)";

			mysqli_query($link,$query);
			echo "<script type='text/javascript'>alert('CADASTRADO COM SUCESSO!');</script>";
	}
	
	function VerificaLogin($link,$query,$email,$senha){
				
			
				$ElementosTabela = mysqli_query($link,$query);
				
				if(mysqli_num_rows($ElementosTabela) > 0){
					return true;
				}else{
					return false;
				}
		}
		
	function CadastroUsu($link,$nome,$email,$senha,$setor){
		
		$senha = md5($senha);
		$nome = htmlspecialchars(addslashes($nome));
		$email = htmlspecialchars(addslashes($email));
			
		$query = "insert into USUARIOS
				(nome, email, senha, setor, inserido, visivel) values
					('$nome', '$email', '$senha',$setor, CURDATE(), TRUE)";

		mysqli_query($link,$query);
	}
	
	function CadastroCli($link,$nome,$email,$endereco,$data,$CPF,$telefone){
		if(empty($telefone)){
			$telefone = 1;
		}
		$nome = htmlspecialchars(addslashes($nome));
		$email = htmlspecialchars(addslashes($email));
		$endereco = htmlspecialchars(addslashes($endereco));
		$data = htmlspecialchars(addslashes($data));
		$CPF = htmlspecialchars(addslashes($CPF));
		$telefone = htmlspecialchars(addslashes($telefone));
		
		$query = "insert into CLIENTES
				(nome, email, endereco, dataNasc, cpf, situacao, telefone, inserido, visivel) values
					('$nome', '$email', '$endereco','$data', '$CPF', 1, $telefone, CURDATE(), TRUE)";
		
		mysqli_query($link,$query);
	}
	
	function CadastroOpe($link,$operadora,$valor){
		
		$valor = $valor/100; //Transforma em centavos
		$operadora = htmlspecialchars(addslashes($operadora));
		$valor = htmlspecialchars(addslashes($valor));
		
		$query = "insert into OPERADORAS
				(nomeOperadora, custoMin, inserida, visivel) values
					('$operadora', $valor, CURDATE(), TRUE)";
		
		mysqli_query($link,$query);
	}
	
	function CadastroTel($link,$numero,$operadora){
		
		
		$numero = htmlspecialchars(addslashes($numero));
		$operadora = htmlspecialchars(addslashes($operadora));
		
		$query = "insert into TELEFONES
				(numTelefones, operadora, inserido, visivel) values
					($numero, $operadora, CURDATE(), TRUE)";
		
		mysqli_query($link,$query);
	}
	
	function montaSelectOperadoras($link){
			
			$query = "SELECT * from OPERADORAS where visivel = TRUE";
			$resultado = mysqli_query($link, $query);
			
			echo "<select name='OPERADORAS' id='operadorae'>";
			while($linha = mysqli_fetch_array($resultado)){
				echo "<option value='" . $linha["idOperadoras"] . "'>" . 
                 $linha["nomeOperadora"] . "</option>";
			}
			echo "</select>";
	}
	
	function perfilAdm($link,$aux){
		
		$query = "SELECT * from ADMINISTRADORES where visivel = TRUE AND idAdministrador = $aux";
		$resultado = mysqli_query($link, $query);
			

			while($linha = mysqli_fetch_array($resultado)){
				echo"<h2>".$linha['nome']."</h2>";
                echo"<p><strong>Email: </strong>".$linha['email'];
                echo"<p><strong>Cadastro em: </strong>".$linha['inserido']."</p>";
				echo"<button type='submit' class='btn'>Editar</button>";
				echo"<button type='submit' class='btn'>Adicionar adm</button>";
			}
	}
	
	function perfilUsu($link,$aux,$set){
		
		$query = "SELECT 
					nome,email,nomeSetor, U.inserido 
				from 
					USUARIOS U, SETORES S 
				where 
					U.visivel LIKE TRUE AND
					S.visivel LIKE TRUE AND
					setor = idSetores
					AND idUsuarios = $aux";
					
		$resultado = mysqli_query($link, $query);
			
			while($linha = mysqli_fetch_array($resultado)){
					echo"<h2>".$linha['nome']."</h2>";
					echo"<p><strong>Email: </strong>".$linha['email'];
					echo"<p><strong>Atualmente: </strong>".$linha['nomeSetor'];
					echo"<p><strong>Cadastro em: </strong>".$linha['inserido']."</p>";
					echo"<button type='submit' class='btn'>Alterar</button>";
	
	
			}
		
	}
	
	function perfilVen($link){
		
		$query = "SELECT * from ADMINISTRADORES where visivel = TRUE";
		$resultado = mysqli_query($link, $query);
		
		$query = "SELECT * from SETORES where visivel = TRUE AND idSetores = 1";
		$resultado2 = mysqli_query($link, $query);	

			while($linha = mysqli_fetch_array($resultado)){
				while($setor = mysqli_fetch_array($resultado2)){
					echo"<h2>".$linha['nome']."</h2>";
					echo"<p><strong>Email: </strong>".$linha['email'];
					echo"<p><strong>Atualmente: </strong>".$setor['nomeSetor'];
					echo"<p><strong>Cadastro em: </strong>".$linha['inserido']."</p>";
					echo"<button type='submit' class='btn'>Editar</button>";
					echo"<button type='submit' class='btn'>Adionar adm</button>";
				}
			}
	}
	
	function simulaLigacao($link,$numero1,$numero2){
		
		$numero1 = htmlspecialchars(addslashes($numero1));
		$numero2 = htmlspecialchars(addslashes($numero2));
		
		$query = "SELECT * FROM TELEFONES WHERE numTelefones = $numero1 AND  visivel=TRUE";
				$result1 = mysqli_query($link,$query);
		$query = "SELECT * FROM TELEFONES WHERE numTelefones = $numero2 AND  visivel=TRUE";
				$result2 = mysqli_query($link,$query);
		
		$durouInt = rand(1,1800); //tempo de duração randômico
		$durou = gmdate("H:i:s", $durouInt);//tempo de duração randômico convertido
		
		$query = "SELECT
					custoMin 
				 from
					TELEFONES,OPERADORAS
				 where
					T.visivel LIKE TRUE AND
					O.visivel LIKE TRUE AND
					operadora = idOperadoras
					AND numTelefones = $numero1
				";
				
		$aux1 = mysqli_query($link,$query);
		$linha = mysqli_fetch_array($aux1);
		
		$aux1= $linha['custoMin'];
		$custo1 = $durouInt/2*$aux1;
		
		$query = "SELECT
					custoMin 
				 from
					TELEFONES T,OPERADORAS O
				 where
					T.visivel LIKE TRUE AND
					O.visivel LIKE TRUE AND
					operadora = idOperadoras
					AND numTelefones = $numero2
				";
				
		$aux2 = mysqli_query($link,$query);
		$linha = mysqli_fetch_array($aux2);
		
		$aux2 = $linha['custoMin'];
		$custo2 = $durouInt/2*$aux2;
		
		if(mysqli_num_rows($result1) == 1 && mysqli_num_rows($result2) == 1){
				
				$custoFinal = ($custo1 + $custo2)/100;
				$query = "INSERT INTO 
								LIGACOES(tempoChamada,custoFinal,numEntrada,numSaida,inserido)
						  values('$durou',$custoFinal,$numero1,$numero2,CURDATE())";
				mysqli_query($link,$query);
		}
		
	}
	
	function tabelaLigacoes($link){
		
	$query = "select 
					L.numEntrada, L.numSaida, O.nomeOperadora, C.nome, L.custoFinal, L.tempoChamada, L.inserido
			  from
					CLIENTES C,OPERADORAS O,LIGACOES L, TELEFONES T
			  where
					L.visivel LIKE TRUE AND
					T.visivel LIKE TRUE AND
					C.telefone = T.numTelefones AND
					T.operadora = O.idOperadoras AND
					T.numTelefones = L.numEntrada AND
					MONTH(O.inserida) = MONTH(CURDATE());";
	
	$result1 = mysqli_query($link,$query);
	
	$query = "select 
					O.nomeOperadora, C.nome
			  from
					CLIENTES C,OPERADORAS O,LIGACOES L, TELEFONES T
			  where
					L.visivel LIKE TRUE AND
					T.visivel LIKE TRUE AND
					C.telefone = T.numTelefones AND
					T.operadora = O.idOperadoras AND
					T.numTelefones = L.numSaida AND
					MONTH(O.inserida) = MONTH(CURDATE());";
					
	$result2 = mysqli_query($link,$query);
	
	echo"<table class='table table-hover table-responsive-sm table-responsive-md table-warning'>
				 <thead>
						<caption class='tittle-table'>A simulação para números não relacionados a clientes aparecerá quando a mesma se fizer</caption>
						<tr>
							  <th scope='col'>De</th>
							  <th scope='col'>Para</th>
							  <th scope='col'>Operadoras</th>
							  <th scope='col'>Clientes</th>
							  <th scope='col'>Data</th>
							  <th scope='col'>Duração</th>
							  <th scope='col'>Valor</th>
						</tr>
				  </thead>
				  <tbody>";
				  while($linha=mysqli_fetch_array($result1)){
							$linha2=mysqli_fetch_array($result2);
							echo"<tr>
								  <th scope='row'>".$linha['numEntrada']."</th>".
								  "<td>".$linha['numSaida']."</td>".
								  "<td>".$linha['nomeOperadora']."/".$linha2['nomeOperadora']."</td>".
								  "<td>".$linha['nome']."/".$linha2['nome']."</td>".
								  "<td>".$linha['inserido']."</td>".
								  "<td>".$linha['tempoChamada']."</td>".
								  "<td>".$linha['custoFinal']."</td></tr>";
				  }
						
	echo	  "</tbody>
		</table>";

}
	