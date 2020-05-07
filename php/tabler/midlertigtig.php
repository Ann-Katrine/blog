<?php
	class tabelForEnDag{
		private $Id;
		private $Number_read;
		private	$PostId;
		
		function __construct($Id, $Number_read, $PostId){
			$this->id = $Id;
			$this->number_read = $Number_read;
			$this->postId = $PostId;
		}
		
		public function jsonSerialize(){
			return[
				"id" => $this->id,
				"number_read" => $this->number_read,
				"postId" => $this->postId
			];
		}
	}
?>