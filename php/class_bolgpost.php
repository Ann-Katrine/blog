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
			$DB = new DB();

			$stmt = $DB->conn->prepare("INSERT INTO BlogPost (tekst, sted,title,dato) VALUES (?, ?, ?, ?)");

			$stmt->bind_param("ssss", $tekst, $sted, $title, $dato);
			$stmt->execute();

			// Ikke nødvendig mere.
			//ny ting
//			$mt_billeder_posts = new mt_billeder_posts();
//			$mt_billeder_posts->createIdBillederPosts($billede, mysqli_insert_id($this->$DB->conn));

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
