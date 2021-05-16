<?php
	include_once ("conexao.php");
	
	$d = $_GET['d'];
	mysqli_select_db($mysqli,"ajax_demo");
	$sql="SELECT nascimento FROM Paciente WHERE cpf='".$d."'";
	$result = mysqli_query($mysqli, $sql);
	$row = mysqli_fetch_all($result, MYSQLI_ASSOC);	
	if ($row !=null){
		foreach ($row as $obj){
			foreach($obj as $chave=>$valor){
				echo "<input type='date' id='nascimentoPaciente' readonly name='nascimentoPaciente' value=\"$valor\">";
			}
		}
	}
	if ($row==null){
		echo "<input required type='date' onfocus='chamaDataAtual()' id='nascimentoPaciente' name='nascimentoPaciente' />";
	}
	mysqli_close($mysqli);
?>