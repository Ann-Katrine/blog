<?php 
	include_once('db.php');
	include_once('billeder.php');
	include_once('blogpost_billeder.php');

	class mt_billeder_posts{
		public function createIdBillederPosts($billeder, $postId){
			$DB = new DB();
			$billed = new billed();
			
			//$billed->createBillede($billeder); /* hjælp */
			$billedId = $billed->createBillede($billeder);
			
			$stmt = $DB->conn->prepare("INSERT INTO BlogPost_has_billeder (BlogPost_idBlogPost,	billeder_idbilleder) VALUES (?, ?)");
			
			$stmt->bind_param("ii", $postId, $billedId/* hjælp */ );
			$stmt->execute();
			
			$stmt->close();
			$DB->conn->close();
		}
	}

	class billed{
		public function getAllBilleder(){
			
		}
		
		public function createBillede($billeder){
			$DB = new DB();
			
			$stmt = $DB->conn->prepare("INSERT INTO billeder (billeder) VALUES (?)");
			
			$stmt->bind_param("s", $billeder);
			$stmt->execute();
			
			$id = $stmt->insert_id;
			
			$stmt->close();
			$DB->conn->close();
			
			return $id;
		}
	}
?>