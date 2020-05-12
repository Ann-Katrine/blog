<?php 
	include_once('db.php');
	include_once('follows.php');

	class followship{
		public function createFollowship($Name, $Mail, $Brugernavn, $Password, $Idtitle){
			$DB = new DB();
			
			$stmt = $DB->conn->prepare("INSERT INTO Follows (name, mail, brugernavn, password, Title_idTitle) VALUES (?, ?, ? ,? ,?)");
			
			$stmt->bind_param("sssss", $name, $mail, $brugenavn, $password, $Title_idTitle);
			
			$name = $Name;
			$mail = $Mail;
			$brugernavn = $Brugrnavn;
			$password = $Password;
			$Title_idTitle = $Idtitle;
			$stmt->execute();
			
			$stmt->close();
			$DB->conn->close();
		}
		
		public function getFollowsByMonth($date1, $date2){
			$DB = new DB();
			
			$stmt = $DB->conn->prepare("SELECT idFollows FROM Follows WHERE dato BETWEEN ? AND ?");
			
			$stmt->bind_param("ss", $date1, $date2);
			$stmt->execute();
			
			$stmt->close();
			$DB->conn->close();
		}
		
		public function getFollowsByWeek($date1, $date2){
			$DB = new DB();
			
			$stmt = $DB->conn->prepare("SELECT idFollows FROM Follows WHERE dato BETWEEN ? AND ?");
			
			$stmt->bind_param("ss", $date1, $date2);
			$stmt->execute();
			
			$stmt->close();
			$DB->conn->close();
		}
		
		public function getFollowsByDay($date1){
			$DB = new DB();
			
			$stmt = $DB->conn->prepare("SELECT idFollows FROM Follows WHERE dato = ?");
			
			$stmt->bind_param("s", $date1);
			$stmt->execute();
			
			$stmt->close();
			$DB->conn->close();
		}
	}
?>