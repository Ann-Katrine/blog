<?php
	include_once('db.php');
	include_once('follows.php');

	class followship{
		public function createFollowship($Name, $Mail, $Brugernavn, $Password, $Idtitle){
			$DB = new DB();

			$stmt = $DB->conn->prepare("INSERT INTO Follows (name, mail, brugernavn, password, dato, Title_idTitle) VALUES (?, ?, ? ,?, NOW() ,?)");

			$Hash = password_hash($Password, PASSWORD_DEFAULT);

			$stmt->bind_param("ssssi", $Name, $Mail, $Brugernavn, $Hash, $Idtitle);

//			$name = $Name;
//			$mail = $Mail;
////			$brugernavn = $Brugrnavn;
//			$password = $Password;
//			$Title_idTitle = $Idtitle;
			$stmt->execute();

			$stmt->close();
			$DB->conn->close();
		}
		
		public function getFollowship($Brugernavn, $Password){
			$DB = new DB();
			
			$stmt = $DB->conn->prepare("SELECT brugernavn, password from Follows WHERE brugernavn = ?");
			
			$stmt->bind_param("s", $Brugernavn);
			$stmt->execute();
			
			$row = $stmt->get_result()->fetch_object();
			
			$stmt->close();
			$DB->conn->close();
			
			$Hash = $row->password;
			if(password_verify($Password, $Hash)){
				echo "du er logget ind";
			}
			else{
				echo "du har skrivet brugernavn eller kodeord forkert";
			}
			
		}

		public function getFollowsByWeek($date1/*, $date2*/){
			$DB = new DB();

			//$stmt = $DB->conn->prepare("SELECT idFollows, dato FROM Follows WHERE dato BETWEEN ? AND ?");
			$stmt = $DB->conn->prepare("SELECT idFollows, dato FROM `Follows` WHERE dato = ?");

			//$stmt->bind_param("ss", $date1, $date2);
			$stmt->bind_param("s", $date1);
			$stmt->execute();

            $data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

			$stmt->close();
			$DB->conn->close();

			return $data;
		}

		public function countHowManyFollowsOnAMonth($date1, $date2){
			$DB = new DB();

			$stmt = $DB->conn->prepare("SELECT COUNT(idFollows) FROM Follows WHERE dato BETWEEN ? AND ?");

			$stmt->bind_param("ss", $date1, $date2);
			$stmt->execute();

			$data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

			$stmt->close();
			$DB->conn->close();
		}

		public function getDatoFromToDato($date1, $date2){
			$DB = new DB();

			$stmt = $DB->conn->prepare("SELECT dato FROM Follows WHERE dato BETWEEN ? AND ?");

			$stmt->bind_param("ss", $date1, $date2);
			$stmt->execute();

			$data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)/*["number_Read"]*/;

			$stmt->close();
			$DB->conn->close();

			return $data;
		}

		public function countHowManyDatoFromTwoDato($date1, $date2){
			$DB = new DB();

			$stmt = $DB->conn->prepare("SELECT COUNT(dato) AS dato FROM Follows WHERE dato BETWEEN ? AND ?");

			$stmt->bind_param("ss", $date1, $date2);
			$stmt->execute();

			$data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)/*["number_Read"]*/;

			$stmt->close();
			$DB->conn->close();

			return $data;
		}
	}
?>
