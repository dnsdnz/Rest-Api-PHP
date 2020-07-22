<?php

	$url = "127.0.0.1";
	$database = "db";
	$username = "root";
	$password = "";			

	$conn = mysqli_connect($url, $username, $password, $database);

	if (!$conn) {
		die("Connection failed: " .$conn->connect_error);
	}

	$method = $_SERVER['REQUEST_METHOD'];

	if($method == "GET"){
		$sql = "SELECT * FROM news";
		$result = mysqli_query($conn, $sql);
		$rows = array();

			if (mysqli_num_rows($result) > 0) {
				while ($r = mysqli_fetch_assoc($result)) {
					array_push($rows, $r);
		}
		print json_encode($rows);
	}
	else{
		echo "No data";
		}
	}

	else if($method == "POST"){

		
		$title = $_POST['title'];
		$content = $_POST['content'];
		$category = $_POST['category'];
		$photo_path = $_POST['photo_path'];

		$sql_insert = "INSERT INTO news(title, content, category, photo_path) VALUES ('$title', '$content', '$category', '$photo_path')";

		if (mysqli_query($conn, $sql_insert)){
			echo "Item succesfully added to the database.";
		}
		else{
			echo "ERROR: $sql_insert didn't run.".mysqli_error($conn);
		}
	}
	mysqli_close($conn);
?>
