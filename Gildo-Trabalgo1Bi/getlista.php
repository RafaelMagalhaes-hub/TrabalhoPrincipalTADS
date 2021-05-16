<?php
	include_once ("conexao.php");
	
	$q =$_GET['q'];
	mysqli_select_db($mysqli,"ajax_demo");
	$sql="SELECT DISTINCT idMedico,nome FROM MEDICO WHERE especialidade='".$q."'";
	$result = mysqli_query($mysqli, $sql);
	$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
	if ($row !=null){
		foreach ($row as $obj){
			echo "<option value=".$obj['idMedico'].">&nbsp;&nbsp;&nbsp;".$obj['nome']."</option>";
		}
	}
	mysqli_close($mysqli);				
?>
