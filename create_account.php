<html>
<head>
    <title> Creating Account... </title>
</head>
<body>

<?php

    // get user input data
	$fname = $_POST["fname"];
	$lname = $_POST["lname"];
	$email = $_POST["email"];
    $user = $_POST["login"];
    $pass = $_POST["password"];

	// Connect to MySQL
	$db = mysql_connect("db1.cs.uakron.edu:3306", "ajh158", "aiHo8jeh");
	if (!$db) {
		print "Error - Could not connect to MySQL";
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
		if (mysql_num_rows($result) == 0) {
			$query = "INSERT into accounts (first_name, last_name, email, login, password) values('$fname', 
			'$lname', '$email', '$user', '$pass')";
			mysql_query($query);
			$query = "INSERT into album1 (login) values('$user')";
			mysql_query($query);
			$query = "INSERT into album2 (login) values('$user')";
			mysql_query($query);
			$query = "INSERT into album3 (login) values('$user')";
			mysql_query($query);
			$query = "INSERT into album4 (login) values('$user')";
			mysql_query($query);
			$query = "INSERT into album5 (login) values('$user')";
			mysql_query($query);
			header ("Location: login.html");
		}
		else {
			header ("Location: register.html");
		}
	}
?>
</body>
</html>
