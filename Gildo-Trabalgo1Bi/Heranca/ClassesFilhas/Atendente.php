<?php 

	namespace Heranca\ClassesFilhas;
	
	require_once ("../ClassePai/Pessoa.php");
	require_once ("../../Conexao.php");
	
	class Atendente extends Pessoa {

		private $senhaA;

		function __construct($nomeA,$nascimentoA,$cpfA,$sexoA,$telefoneA,$senhaA){
			parent::__construct($nomeA,$nascimentoA,$cpfA,$sexoA,$telefoneA);
			$this->senhaA=$senhaA;
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