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
	}
?>