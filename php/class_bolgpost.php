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
		
		public function createPosts($tekst, $sted, $title, $dato){
			$stmt = $this->$DB->conn->prepare("INSERT INTO BlogPost (tekst, sted,title,dato) VALUES (?, ?, ?, ?)");
			
			$stmt->bind_param("ssss", $Tekst, $Sted, $Title, $Dato);
			
			$Tekst = $tekst;
			$Sted = $sted;
			$Title = $title;
			$Dato = $dato;
			$stmt->execute();
			
			$stmt->close();
			$this->$DB->conn->close();
		}
		
		public function deltePost(){
			
		}
	}
?>