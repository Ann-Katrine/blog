<?php
	include_once('db.php');
	include_once('BlogPost.php');

	class blogPosts{
		public function getAllPosts(){
			$post = array();
			$this->DB = new DB();
			
			$sql = "SELECT * FROM BlogPost";
			
			$result = $this->DB->conn->query($sql);
			
			while($row = $result->fetch_object()){
				$post[] = new post($row->Title, $row->Dato, $row->Sted,$row->Tekst);
			}
			return $post;
		}
	}
?>