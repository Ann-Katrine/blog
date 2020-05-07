<?php
	class statik{
		private $Idstatik;
		private $Dato;
		private $Number_read;
		private $Postid;
		
		function __construct($Idstatik, $Dato, $Number_read, $Postid){
			$this->idstatik = $Idstatik;
			$this->dato = $Dato;
			$this->number_read = $Number_read;
			$this->postid = $Postid;
		}
		
		public function jsonSerialize(){
			return[
				"idstatik" => $this->idstatik,
				"dato" => $this->dato,
				"number_read" => $this->number_read,
				"postid" => $this->postid
			];
		}
	}
?>