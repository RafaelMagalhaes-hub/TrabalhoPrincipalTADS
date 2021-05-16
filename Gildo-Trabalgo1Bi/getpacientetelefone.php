<?php
	include_once ("conexao.php");

	$f = $_GET['f'];
	mysqli_select_db($mysqli,"ajax_demo");
	$sql="SELECT telefone FROM PACIENTE WHERE cpf='".$f."'";
	$result = mysqli_query($mysqli, $sql);
	$row = mysqli_fetch_all($result, MYSQLI_ASSOC);	
	if ($row !=null){
		foreach ($row as $obj){
			foreach($obj as $chave=>$valor){
				echo "<input type='text' name='telefonePaciente' id='telefonePacienteCad' readonly value=\"$valor\" />";	
			}
		}	
	}
	else{
		echo "<input type='text' name='telefonePaciente' id='telefonePaciente' onblur='validacao(\"telefonePaciente\",\"Formato inválido para o telefone. Use exatamente 10 ou 11 caracteres numéricos.\")' pattern='^[\d*]{10}|^[\d*]{11}' maxlength='11' required/>";
	}	
	mysqli_close($mysqli);
?>