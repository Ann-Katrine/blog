<?php 
	class blogpost{
		private $IdBlogPost;
		private $Tekst;
		private $Sted;
		private $Title;
		private $Dato;
		
		function __construct($IdBlogPost, $Tekst, $Sted, $Title, $Dato){
			$this->idBlogPost = $IdBlogPost;
			$this->tekst = $Tekst;
			$this->sted = $Sted;
			$this->title = $Title;
			$this->dato = $Dato;
		}
		
		public function jsonSerialize(){
			return[
				"idBlogPost" => $this->idBlogPost,
				"tekst" => $this->tekst,
				"sted" => $this->sted,
				"title" => $this->title,
				"dato" => $this->dato
			]; 
		}
	}
?>