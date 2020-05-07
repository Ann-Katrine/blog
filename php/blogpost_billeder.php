<?php 
	class mtbilleder_blogpost{
		private $BlogPost_IdBlogPost;
		private $Billeder_idbilleder;
		
		function __construct($BlogPost_IdBlogPost, $Billeder_idbilleder){
			$this->BlogPost_idBlogPost = $BlogPost_IdBlogPost;
			$this->billeder_idbilleder = $b$Billeder_idbilleder;
		}
		
		public function jsonSerialize(){
			return[
				"BlogPost_idBlogPost" => $this->BlogPost_idBlogPost,
				"billeder_idbilleder" => $this->billeder_idbilleder
			];
		}
	}
?>