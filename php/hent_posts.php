<?php
	// viser alle fejl fra php filen
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	include_once('./class_bolgpost.php');

	$blogPosts = new blogPosts();

	$result = $blogPosts->getAllPosts();
	echo json_encode($result);  
?>