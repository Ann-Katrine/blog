<?php
	class DB{
		// Attributer
		public $conn;
		private $host = "localhost";		// hvor den lægger
		private $user = "ak.ak";			// brugernavn
		private $password = "admin123";		// kodeord
		private $db = "ak";					// serverens navn
		
		function __construct(){
			// for at få forbindelse
			$this->conn = new mysqli($this->host, $this->user, $this->password, $this->db);
			
			// hvis der ikke er forbindelse til databasen
			if($this->conn->connect_errno != ""){
				echo '<h1>'.$this->conn->connect_error.'</h1>';
				die('der er ikke forbindelse til database.');
			}
			// hvis der er forbindelse til databasen
			else{
				echo 'forbindelse virker'; 
				$this->conn->set_charset('UTF8');
			}
		}
	}
?>