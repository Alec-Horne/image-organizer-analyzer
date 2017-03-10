<?php
// Start the session
session_start();

foreach($_POST as $name => $content) {
}

list($one, $two) = explode(":", $name);
$user = $_SESSION["username"];

$deleteImage = $_SESSION['source'];
unlink($deleteImage);
	
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

		$query = "UPDATE " . $one . " SET " . $two . "=NULL WHERE login='$user'";

		if($query != ""){
			trim($query);
			$query_html = htmlspecialchars($query);
			
			$result = mysql_query($query);
			if (!$result) {
				print "Error - the query could not be executed";
				$error = mysql_error();
				print "<p>" . $error . "</p>";
			}
		
		} else {
			echo "Sorry, there was an error deleting your file.";
		}
		
		header("Location: albums.php");
?>
