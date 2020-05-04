<?php 
	include_once('db.php');
	include_once('billeder.php');

	class billed{
		public function getAllBilleder(){
			
		}
		
		public function createBillede($billeder){
			$DB = new DB();
			
			$stmt = $DB->conn->prepare("INSERT INTO billeder (billeder) VALUES (?)");
			
			$stmt->bind_param("s", $billeder);
			$stmt->execute();
			
			$stmt->close();
			$DB->conn->close();
		}
	}
?>