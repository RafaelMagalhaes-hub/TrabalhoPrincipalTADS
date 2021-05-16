<?php
	include_once ("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Marcação de consulta médica</title>		
		<meta charset="utf-8" />
		<link rel="stylesheet" href="folhaEstilo.css" type="text/css" />
		<link rel="icon" type="image/png" href="img/" />	
	</head>
	<body>
		<h1>Preencha o formulário abaixo para efetuar a marcação de sua consulta médica:</h1>
		<fieldset>
			<legend>Informações da consulta</legend>
			<form id="formulario" name="formulario" method="GET" action="chamaappbd.php">
				<table>
					<input type="hidden" id="aux" value="inicio" />
					<span id="spanValidacao"><span>
					<span id="spanValidacao2"></span>
					<tr>
						<td><label for="cpfPaciente">Seu CPF (apenas números):&nbsp;</label></td><td><input type="text" pattern="[0-9]{11}" maxlength="11" required 
							id="cpfPaciente" name="cpfPaciente" onchange="chamaPacienteCadastrado();" onblur="validacao('cpfPaciente','Formato inválido para o \'cpf\'. Use exatamente 11 caracteres numéricos.');"/></td>
					</tr>
					<tr>
						<td><label for="nomePaciente">Nome completo:&nbsp;</td><td><div id="txtHint2"><input type="text" maxlength="70" pattern="^[A-Za-záàâãéèêíïóôõöüúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÜÇÑ'\s]+$" required id="nomePaciente" name="nomePaciente" 
							onblur="validacao('nomePaciente','Formato inválido para o \'nome\'. Use apenas caracteres alfabéticos.')" /></div></td>
					</tr>
					<tr>
						<td><label for="nascimentoPaciente">Sua data de nascimento:&nbsp;</label></td><td><div id="dataNascimento"><input type="date" id="nascimentoPaciente" name="nascimentoPaciente" onfocus="chamaDataAtual();" required /></div></td>
					</tr>
					<tr>
						<td><label>Seu sexo:&nbsp;</label></td><td><div id="sexoPacienteC"><input type="radio" class="sexo" id="SexoM" name="sexoPaciente" value="M" checked /><label class="sexo" for="SexoM">Masculino</label>&nbsp;&nbsp;&nbsp;<input type="radio" class="sexo" id="SexoF" name="sexoPaciente" value="F" /><label class="sexo" for="SexoF">Feminino</label></div></td>
					</tr>
					<tr>
						<td><label for="telefonePaciente">DDD + telefone (apenas números):&nbsp;</label></td><td><div id="telefonePacienteC" ><input type="text" pattern="^[\d*]{10}|^[\d*]{11}" maxlength="11" required name="telefonePaciente" 
							id="telefonePaciente" onblur="validacao('telefonePaciente','Formato inválido para o telefone. Use exatamente 10 ou 11 caracteres numéricos\.');" /></div></td>
					</tr>
					<tr>
					<?php 
						mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
						$sql="SELECT DISTINCT especialidade FROM MEDICO";
						$result = mysqli_query($mysqli, $sql);
						$row = mysqli_fetch_all($result, MYSQLI_ASSOC);	
					?>				
						<td><label for="especialidadeMedico">Escolha a especialidade do médico:&nbsp;</td><td><select id="especialidadeMedico" name="especialidadeMedico" onchange="chamaMedicoPorEspecialidade();"><option value="-2">Selecione a especialidade:</option><optgroup><?php foreach ($row as $obj){ foreach($obj as $chave=>$valor){ ?><option value="<?php echo $valor;
						?>"><?php echo "&nbsp;&nbsp;&nbsp;$valor";  ?></option><?php } } ?></optgroup></select></td>
					</tr>
					<tr>
						<td><label for="medicoEscolhido">Escolha seu médico:&nbsp;</td><td><select onchange="chamaHorario()" name="medicoEscolhido" id="medicoEscolhido" required><option>Selecione o médico:</option><optgroup id="txtHint"></optgroup></select></td>
					</tr>
					<tr>
						<td><label for="dataHoraConsulta">Informe a data e hora da consulta:</label></td><td><select required id="dataHoraConsulta" name="dataHoraConsulta"><option disabled>Selecione o horário:</option><optgroup id="mostraHorario"></optgroup></select></td>
					</tr>
					<tr>
						<td><label for="motivoConsulta">Informe o motivo da consulta:</label></td><td><input type="text" id="motivoConsulta" name="motivoConsulta" maxlength="40" required ></td>
					</tr>
					<tr>
						<td><button type="submit" name="btnSubmit" id="btnSubmit">Enviar</button></td>
					</tr>
				</table>
			</form>			
		</fieldset>		
		<script>
			function validacao(id,msg){
				if(!((document.getElementById(id)).validity.valid) && ((document.getElementById(id)).value!="")){
					(document.getElementById(id)).setCustomValidity("");
					(document.getElementById(id)).value="";
					document.getElementById('spanValidacao').innerText=msg+" Conteúdo do campo removido.";
					document.getElementById('aux').value=id;
				}
				else if (((document.getElementById(id)).validity.valid) && document.getElementById('aux').value==id){
					document.getElementById('spanValidacao').innerText="";
				}
			}
			function chamaDataAtual(){
				let today = new Date().toISOString().slice(0, 10);
				document.getElementById("nascimentoPaciente").setAttribute("max",today);				
			}	
			function chamaMedicoPorEspecialidade(){
				var str=document.getElementById("especialidadeMedico").value;
				console.log(str);
				if(str !=-1){
					console.log(str);
					var xmlhttp = new XMLHttpRequest();
					console.log(str);
					console.log(str);					
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200 && this.responseText!="") {
							document.getElementById('txtHint').innerHTML = this.responseText;
						}
					console.log(str);
					};
					xmlhttp.open("GET","getlista.php?q="+str,true);
					xmlhttp.send();
				}

				document.getElementById('mostraHorario').innerHTML="";
			}
			function chamaHorario(){
				var idMedico=document.getElementById("medicoEscolhido").value;
				if (idMedico!=null){
					var xmlhttp = new XMLHttpRequest();					
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							if (this.responseText!=""){
								document.getElementById('mostraHorario').innerHTML = this.responseText;
							}else{
								document.getElementById('mostraHorario').setAttribute('value','');
							}
						}
					};
					xmlhttp.open("GET","gethorario.php?h="+idMedico,true);
					xmlhttp.send();		
				}
				if (document.getElementById("medicoEscolhido").value==-1){
					document.getElementById('mostraHorario').innerHTML="";
				}				
			}
			function chamaPacienteCadastrado(){
				var cpfInserido=document.getElementById("cpfPaciente").value;
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					console.log("teste");
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById('txtHint2').innerHTML = this.responseText;						
					}					
				};
				console.log("teste");
				xmlhttp.open("GET","getpaciente.php?c="+cpfInserido,true);
				xmlhttp.send();	
				console.log("teste");
				chamaDataDeNascimento(cpfInserido);
				chamaSexoDoPaciente(cpfInserido);
				chamaTelefoneDoPaciente(cpfInserido);
			}		
			function chamaDataDeNascimento(cpf){
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					console.log("teste");
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById('dataNascimento').innerHTML = this.responseText;						
					}				
				};
				console.log("teste");
				xmlhttp.open("GET","getpacienteNascimento.php?d="+cpf,true);
				xmlhttp.send();	
				return;
			}
			function chamaSexoDoPaciente(cpf){
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById('sexoPacienteC').innerHTML = this.responseText;						
					}					
				};
				xmlhttp.open("GET","getpacienteSexo.php?e="+cpf,true);
				xmlhttp.send();	
				return;				
			}
			function chamaTelefoneDoPaciente(cpf){
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					console.log("teste");
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById('telefonePacienteC').innerHTML = this.responseText;						
					}					
				};
				xmlhttp.open("GET","getpacientetelefone.php?f="+cpf,true);
				xmlhttp.send();	
				return;		
			}
		</script>
	</body>
</html>