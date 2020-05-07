<?php
	include_once('db.php');
	include_once('statik.php');

	class statiker{
		public function getStatikPrDag($id){
			$DB = new DB();
			
			$stmt = $DB->conn->prepare()"SELECT number_Read FROM statik WHERE Postid = ?");
			
			$stmt->bind_param("i", $id);
			$stmt->execute();
			
			$stmt->close();
			$DB->conn->close();
		}
	}
?>