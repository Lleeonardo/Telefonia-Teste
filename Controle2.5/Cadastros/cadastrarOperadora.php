<?php
		
		require('.././conexao.php');
		require('.././funcoes.php');
		
		$objt = filter_input(INPUT_GET, "json");
		$obj = json_decode($objt);
		echo $obj;

		foreach($obj as $Ob){
			CadastroOpe($link,$Ob->operadora, $Ob->preco);
		}
		
?>