<?php
	require_once ("conexao.php");
	require_once ("Heranca/ClassesFilhas/Paciente.php");
	require_once ("Consulta/Consulta.php");
	use Heranca\ClassesFilhas\Paciente;
	use Consulta\Consulta;
	
	$cpf=$_GET['cpfPaciente'];
	$nome=$_GET['nomePaciente'];
	$nascimento=$_GET['nascimentoPaciente'];
	$sexo=$_GET['sexoPaciente'];
	$telefone=$_GET['telefonePaciente'];
	$idMedico=$_GET['medicoEscolhido'];
	$idConsulta=$_GET['dataHoraConsulta'];
	$motivoConsulta=$_GET['motivoConsulta'];
	Paciente::Consultar($mysqli,$cpf,$nome,$nascimento,$sexo,$telefone);
	Consulta::marcar($mysqli,$cpf,$motivoConsulta,$idConsulta);
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
		<h1>Consulta marcada com sucesso.</h1>
	</body>
</html>
