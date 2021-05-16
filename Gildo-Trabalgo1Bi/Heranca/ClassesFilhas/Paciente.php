<?php


	namespace Heranca\ClassesFilhas;
	use Heranca\ClassePai\Pessoa;
	
	require_once($_SERVER['DOCUMENT_ROOT'].'/Gildo-Trabalgo1Bi/Heranca/ClassePai/Pessoa.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/Gildo-Trabalgo1Bi/Conexao.php');
	
	class Paciente extends Pessoa{
				
		function __construct($nomeP,$nascimentoP,$cpfP,$sexoP,$telefoneP){
			parent::__construct($nomeP,$nascimentoP,$cpfP,$sexoP,$telefoneP);			
		}
		
		public function __set($outroAtributo, $valorDoOutroAtributo){
			$this->$outroAtributo = $valorDoOutroAtributo;
		}
	 
		public function __get($atributoQueSeQuerPegar){
			return $this->$atributoQueSeQuerPegar;
		}		
		
		static function Cadastrar($id,$nomeP,$cpf,$nascimento,$sexo,$telefone,$mysqli){
			$sql2="INSERT INTO Paciente VALUES (0,'".$nomeP."','".$cpf."','".$nascimento."','".$sexo."','".$telefone."')";
			mysqli_query($mysqli, $sql2);		
		}
		
		static function Consultar($mysqli,$cpf,$nome,$nascimento,$sexo,$telefone){
			mysqli_select_db($mysqli,"ajax_demo");
			$sql="SELECT cpf FROM PACIENTE WHERE cpf='".$cpf."'";
			$result = mysqli_query($mysqli, $sql);
			$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
			if ($row==null){			
				$pac=new Paciente($nome,$nascimento,$cpf,$sexo,$telefone);
				Paciente::Cadastrar(0,$nome,$cpf,$nascimento,$sexo,$telefone,$mysqli);		
			}
		}
	}

?>