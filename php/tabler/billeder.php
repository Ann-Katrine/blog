<?php 
	class billede{
		private $Idbilleder;
		private $Billeder;
		
		function __construct($Idbilleder, $Billeder){
			$this->idbilleder = $Idbilleder;
			$this->billeder = $Billeder;
		}
		
		public function jsonSerialize(){
			return[
				"idbilleder" => $this->idbilleder,
				"billeder" => $this->billeder
			];
		}
	}
?>