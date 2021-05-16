<?php 

	namespace Consulta;
	
	class Consulta {

		private $Id;
		private $data_hora;
		private Medico $medico;
		private Paciente $paciente;
		private $motivo;
		private $historico;

		function __construct($data,$hora,$medico,$paciente,$motivo,$historico){
			$this->data=$data;
			$this->hora=$hora;
			$this->medico=$medico;
			$this->paciente=$paciente;
			$this->motivo=$motivo;
			$this->historico=$historico;
		}
		
		public function __set($outroAtributo, $valorDoOutroAtributo){
			$this->$outroAtributo = $valorDoOutroAtributo;
		}
	 
		public function __get($atributoQueSeQuerPegar){
			return $this->$atributoQueSeQuerPegar;
		}	
		
		public static function marcar($mysqli,$cpf,$motivoConsulta,$idConsulta){
			mysqli_select_db($mysqli,"ajax_demo");
			$sql="SELECT idPaciente FROM PACIENTE WHERE cpf='".$cpf."'";
			$result = mysqli_query($mysqli, $sql);
			$row = mysqli_fetch_all($result, MYSQLI_ASSOC);		
			foreach ($row as $obj){
				foreach($obj as $chave=>$valor){
					$idPac=$valor;
				}
			}
			$sql2="UPDATE consulta SET idPacienteTC=".$idPac.",motivo='".$motivoConsulta."' WHERE idConsulta=".$idConsulta;
			$result = mysqli_query($mysqli, $sql2);
			mysqli_close($mysqli);
		}
		
		public static function cancelar(){
			
		}
		
		public function consultar(){
			
		}
		
		public function atualizar(){
			
		}
		

	}

?>