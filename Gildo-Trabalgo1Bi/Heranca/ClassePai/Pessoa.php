<?php
	
	
	namespace Heranca\ClassePai;
	
	abstract class Pessoa{

		private $nome;
		private $nascimento;
		private $cpf;
		private $sexo;
		private $telefone;
		
		function __construct($nome,$nascimento,$cpf,$sexo,$telefone){
			$this->nome=$nome;
			$this->nascimento=$nascimento;
			$this->cpf=$cpf;
			$this->sexo=$sexo;    
			$this->telefone=$telefone;			
		}
		
		public function __set($outroAtributo, $valorDoOutroAtributo){
			$this->$outroAtributo = $valorDoOutroAtributo;
		}
	 
		public function __get($atributoQueSeQuerPegar){
			return $this->$atributoQueSeQuerPegar;
		}
		
		abstract static function Cadastrar($id,$nome,$cpf,$nascimento,$sexo,$telefone,$mysqli);
		
		abstract static function Consultar($mysqli,$cpfP,$nomeP,$nascimentoP,$sexoP,$telefoneP);
		
	}

?>