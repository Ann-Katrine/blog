<?php
	class comments{
		private $IdComment;
		private $Comment;
		private $Follows_IdFollows;
		private $BlogPost_IdBlogPost;
		
		function __construct($IdComment, $Comment, $Follows_IdFollows, $BlogPost_IdBlogPost){
			$this->idComment = $IdComment;
			$this->Comment = $comment;
			$this->Follows_idFollows = $Follows_IdFollows;
			$this->BlogPost_idBlogPost = $BlogPost_IdBlogPost;
		}
		
		public function jsonSerialize(){
			return[
				"idComment" => $this->idComment,
				"Comment" => $this->Comment,
				"Follows_idFollows" => $this->Follows_idFollows,
				"BlogPost_idBlogPost" => $this->BlogPost_idBlogPost
			];
		}
	}
?>