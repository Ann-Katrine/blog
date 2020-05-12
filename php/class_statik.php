<?php
	include_once('db.php');
	include_once('tabler/statik.php');

	class statiker{
		public function getStatikPrDag($id){
			$DB = new DB();

			$stmt = $DB->conn->prepare("SELECT number_Read FROM statik WHERE Postid = ?");

			$stmt->bind_param("i", intval($id));
			$stmt->execute();

//			while($row = $stmt->get_result()->fetch_row()) {
//				$data[] = $row;
//			}

			$data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)/*["number_Read"]*/;

			$stmt->close();
			$DB->conn->close();

			return $data;
		}

		public function countHowManyReadOnOnePost($id){
			$DB = new DB();

			$stmt = $DB->conn->prepare("SELECT COUNT(number_read) AS number_read FROM statik WHERE postid = ?");

			$stmt->bind_param("i", intval($id));
			$stmt->execute();

			$data = $stmt->get_result()->fetch_array(MYSQLI_ASSOC)["number_read"];

			$stmt->close();
			$DB->conn->close();
			return $data;
		}
	}
?>
