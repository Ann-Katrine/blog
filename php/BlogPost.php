<?php 
	class blog{
		private $IdBlogPost
		private $Tekst;
		private $Sted;
		private $Title;
		private Dato;
		
		function __construct($IdBlogPost, $Tekst, $Sted, $Title, Dato){
			$this->idBlogPost = $IdBolgPost;
			$this->tekst = $Tekst;
			$this->sted = $Sted;
			$this->title = $Title;
			$this->dato = $Dato;
		}
		
		public function jsonSerialize(){
			return[
				"idBolgPost" => $this->idBolgPost,
				"tekst" => $this->tekst,
				"sted" => $this->sted,
				"title" => $this->title,
				"dato" => $this->dato
			];
		}
	}
?>