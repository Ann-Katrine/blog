<?php
	include_once('db.php');
	// Bliver ikke brugt.
//	include_once('billeder.php');

	class billed{
		public function getAllBilleder(){

		}

		public function createBillede($billeder){
			$DB = new DB();

			// sætter data der sendes tilbage til at være null.
			$response = null;

			// Mappen på serveren der skal gemmes billeder i.
			$target_dir = "/home/sebathefox/domains/ak.sebathefox.dk/public_html/uploads/";

			// Navnet på filen med mappe og det hele.
			$target_file = $target_dir . basename($_FILES["file"]["name"]);

			// Bruges hvis alt kører fint.
			$uploadOk = 1;

			// Forsøger at flytte filen fra den midlertidige mappe og hen til vores uploads mappe.
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				$stmt = $DB->conn->prepare("INSERT INTO billeder (billeder) VALUES (?)");

				// URL'en til at få fat på billedet.
				$dbUrl = "https://ak.sebathefox.dk/uploads/" . basename($_FILES["file"]["name"]);

				$stmt->bind_param("s", $dbUrl);
				$stmt->execute();

				$stmt->close();

				// Formaterer et svar til klienten om at alt er okay, i JSON.
				$response = array("success" => $uploadOk, "file" => array("url" => $dbUrl));
			}

			$DB->conn->close();

			// Sender svaret til klienten.
			return json_encode($response);
		}
	}
?>
