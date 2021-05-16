<?php
	include_once ("conexao.php");
	
	$c = $_GET['c'];
	mysqli_select_db($mysqli,"ajax_demo");
	$sql="SELECT nome FROM PACIENTE WHERE cpf='".$c."'";
	$result = mysqli_query($mysqli, $sql);
	$row = mysqli_fetch_all($result, MYSQLI_ASSOC);	
	if ($row !=null){
		foreach ($row as $obj){
			foreach($obj as $chave=>$valor){
				echo "<input type='text' name='nomePaciente' id='nomePacienteQueChegou' readonly value=\"$valor\" />";	
			}
		}
	}
	if ($row==null){		
		echo "<input type='text' maxlength='70' pattern=\"^[A-Za-záàâãéèêíïóôõöüúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÜÇÑ'\s]+$\" required id='nomePaciente' name='nomePaciente' onblur='validacao(\"nomePaciente\",\"Formato inválido para o nome. Use apenas caracteres alfabéticos.\")' />";
	}
	mysqli_close($mysqli);		
?>		