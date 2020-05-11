<?php
	include_once('db.php');
	include_once('comment.php');

	class comments{
		public function getAllCommentById($id){
			$DB = new DB();
			
			$stmt = $DB->conn->prepare("SELECT Follows.name, Comment.Comment from Comment LEFT JOIN Follows ON Comment.Follows_idFollows = Follows.idFollows where `BlogPost_idBlogPost` = ?");
			
			$stmt->bind_param("i", $id);
			$stmt->execute();
			
			$stmt->close();
			$DB->conn->close();
		}
		
		public function createComment($comment, $follows_idfollows, $blogpost_idblogpost){
			$DB = new DB();
			
			$stmt = $DB->conn->prepare("INSERT INTO Comment (Comment, Follows_idFollows, BlogPost_idBlogPost) VALUES (?, ?, ?)");
			
			$stmt->bind_param("sii", $comment, $follows_idfollows, $blogpost_idblogpost);
			$stmt->execute();
			
			$stmt->close();
			$DB->conn->close();
		}
	}
?>