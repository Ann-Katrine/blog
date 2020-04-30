<?php 
	class follow{
		private $IdFollows;
		private $Name;
		private $Mail;
		private $Brugernavn;
		private $Password;
		private $Title_IdTitle;
		
		function __construct($IdFollows, $Name, $Mail, $Brugernavn, $Password, $Title_IdTitle){
			$this->idFollows = $IdFollows;
			$this->name = $Name;
			$this->Mail = $Mail;
			$this->brugernavn = $Brugernavn;
			$this->password = $Password;
			$this->Title_idTitle = $Title_IdTitle;
		}
		
		public function jsonSerialize(){
			return[
				"idFollows" => $this->idFollows,
				"name" => $this->name,
				"mail" => $this->Mail,
				"brugernavn" => brugernavn,
				"password" => password,
				"Title_idTitle" => title_idTitle
			];
		}
	}
?>