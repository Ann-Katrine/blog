<?php
	include_once('db.php');
	include_once('BlogPost.php');

	class blogPosts{
		public function getAllPosts(){
			$post = array();
			$DB = new DB();

			$sql = "SELECT * FROM BlogPost";

			$result = $DB->conn->query($sql);

			while($row = $result->fetch_object()){
				$post[] = new blogpost($row->idBlogPost, $row->tekst, $row->title, $row->sted,$row->dato);
			}
			return $post;
		}

		public function createPosts($Tekst, $Sted, $Title, $Dato){
			$DB = new DB();

			$stmt = $DB->conn->prepare("INSERT INTO BlogPost (tekst, sted,title,dato) VALUES (?, ?, ?, ?)");

			$stmt->bind_param("ssss", $tekst, $sted, $title, $dato);

			$Tekst = $tekst;
			$Sted = $sted;
			$Title = $title;
			$Dato = $dato;
			$stmt->execute();

			$stmt->close();
			$DB->conn->close();
		}
		
		public function deltePost($id){
			$DB = new DB();
			
			$stmt = $DB->conn->prepare("DELETE FROM BlogPost WHERE idBlogPost = ?");
			
			$stmt->bind_param("i", $idblogpost);
			
			$id = $idblogpost;
			
			$stmt->close();
			$DB->conn->close();
		}
	}
?>
