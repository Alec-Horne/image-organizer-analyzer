<?php
// Start the session
session_start();
?>
<html>
<head>
    <title> Login Check... </title>
</head>
<body>

<?php

    // get user input data
    $user = $_POST["username"];
    $pass = $_POST["password"];

	// Connect to MySQL
	$db = mysql_connect("db1.cs.uakron.edu:3306", "ajh158", "aiHo8jeh");
	if (!$db) {
		print "Error - Could not connect to MySQL";
		print mysql_errno($db) . ": " . mysql_error($db). "\n";
		exit;
	}

	// Select the database
	$er = mysql_select_db("ISP_ajh158");
	if (!$er) {
		print "Error - Could not select the database";
		exit;
	}

	$query = "SELECT * from accounts WHERE login='$user' AND password='$pass'";

	if($query != ""){
		trim($query);
		$query_html = htmlspecialchars($query);
    
		$result = mysql_query($query);
		if (mysql_num_rows($result) == 1) {
			$_SESSION["username"] = $user;
			header ("Location: albums.php");
		}
		else {
			header ("Location: login.html");
		}
	}
?>
</body>
</html>
