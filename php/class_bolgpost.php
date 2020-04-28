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
	}
?>