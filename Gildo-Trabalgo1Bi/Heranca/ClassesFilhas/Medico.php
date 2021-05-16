<?php 

	namespace Heranca\ClassesFilhas;

	require_once ("../ClassePai/Pessoa.php");
	require_once ("../../Conexao.php");
	
	class Medico extends Pessoa { 

		private $crm;
		private $especialidade;
		private $senhaM

		function __construct($nomeM,$nascimentoM,$cpfM,$sexoM,$telefoneM,$crm,$especialidade,$senhaM){
			parent::__construct($nomeM,$nascimentoM,$cpfM,$sexoM,$telefoneM);
			$this->crm=$crm;
			$this->especialidade=$especialidade;
			$this->senhaM=$senhaM;
		}
		
		public function __set($outroAtributo, $valorDoOutroAtributo){
			$this->$outroAtributo = $valorDoOutroAtributo;
		}
	 
		public function __get($atributoQueSeQuerPegar){
			return $this->$atributoQueSeQuerPegar;
		}		
		
		static function Consultar ($mysqli,$cpfP,$nomeP,$nascimentoP,$sexoP,$telefoneP){}
		
		static function Cadastrar ($id,$nome,$cpf,$nascimento,$sexo,$telefone,$mysqli){}

	}

?>