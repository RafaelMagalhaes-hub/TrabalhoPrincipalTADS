<?php	
	include_once ("conexao.php");
	
	$q =$_GET['h'];
	mysqli_select_db($mysqli,"ajax_demo");
	$sql="SELECT idConsulta,data_hora FROM CONSULTA WHERE idMedicoTC=".$q." AND idPacienteTC is null";
	$result = mysqli_query($mysqli, $sql);
	$row = mysqli_fetch_all($result, MYSQLI_ASSOC);	
	if ($row !=null){
		foreach ($row as $obj){
			echo "<option selected value=".$obj['idConsulta'].">&nbsp;&nbsp;".$obj['data_hora']."</option>";
		}
	}
	else{
		//echo "<option disabled style='font-style:oblique;'>&nbsp;&nbsp;Sem horário liberado.</option>";
		echo "";
	}
	mysqli_close($mysqli);
?>