<?php
	include_once ("conexao.php");
	
	$e = $_GET['e'];
	mysqli_select_db($mysqli,"ajax_demo");
	$sql="SELECT sexo FROM Paciente WHERE cpf='".$e."'";
	$result = mysqli_query($mysqli, $sql);
	$row = mysqli_fetch_all($result, MYSQLI_ASSOC);				
	foreach ($row as $obj){
		foreach($obj as $chave=>$valor){
			if($valor=="M"){
				echo "<input type='radio' id='SexoM' name='sexoPaciente' value=\"$valor\" checked><label for='sexoPaciente'>Masculino</label>";
			}
			else{
				echo "<input type='radio' id='SexoF' name='sexoPaciente' value=\"$valor\" checked><label for='sexoPaciente'>Feminino</label>";
			}
		}
	}
	if ($row==null){
		echo "<input type='radio' id='SexoM' name='sexoPaciente' value='M' checked /><label for='sexoPaciente'>Masculino</label>&nbsp;&nbsp;&nbsp;<input type='radio' id='SexoF' name='sexoPaciente' value='F'><label for='sexoPaciente'>Feminino</label>" ;
	}
	mysqli_close($mysqli);
?>