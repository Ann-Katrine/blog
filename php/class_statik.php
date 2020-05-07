<?php
	include_once('db.php');
	include_once('tabler/statik.php');

	class statiker{
		public function getStatikPrDag($id){
			$DB = new DB();

			$stmt = $DB->conn->prepare("SELECT number_Read FROM statik WHERE Postid = ?");

			$stmt->bind_param("i", $id);
			$stmt->execute();

			$stmt->close();
			$DB->conn->close();
		}

		public function countHowManyReadOnOnePost($id){
			$DB = new DB();

			$stmt = $DB->conn->prepare("SELECT COUNT(number_read) FROM statik WHERE postid = ?");

			$stmt->bind_param("i", $id);
			$stmt->execute();

			$stmt->close();
			$DB->conn->close();
		}
	}
?>
