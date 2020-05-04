<?php 
	include_once('db.php');
	include_once('billeder.php');

	class billed{
		public function getAllBilleder(){
			
		}
		
		public function createBillede($billeder){
			$DB = new DB();
			
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;

			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				$stmt = $DB->conn->prepare("INSERT INTO billeder (billeder) VALUES (?)");
			
				$stmt->bind_param("s", $billeder);
				$stmt->execute();
				
				$stmt->close();
			}
			
			$DB->conn->close();
		}
	}
?>