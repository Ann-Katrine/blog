<?php
	include_once('class_bolgpost.php');

	// viser alle fejl fra php filen
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	
	$sql = "SELECT * FROM BlogPost";

	$blogPosts = new blogPosts();

	$result = $blogPosts->getAllPosts();
	echo json_encode($result);

	/*$result = $DB->conn->query($sql);
	// hvis der er nogle i tablen
	if($result->num_rows > 0){
		$x = 0;
		while($row = $result->fetch_assoc()){
			echo $row["title"], "'";
			echo $row["dato"], "'";
			echo $row["sted"], "'";
			if(x == ($result->num_rows)){
				echo $row["tekst"];	
			}
			else{
				echo $row["tekst"], ":";
			}
			
		}
	}
	else{
		echo "ingen resultater";
	}*/
?>