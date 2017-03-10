
<?php
// Start the session
session_start();

foreach($_POST as $name => $content) {
}

list($one, $two) = explode(":", $name);
$user = $_SESSION["username"];

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST[$name])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		chmod($target_file, 0777);
	
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

		$query = "UPDATE " . $one . " SET " . $two . "='$target_file' WHERE login='$user'";

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
			echo "Sorry, there was an error uploading your file.";
		}
		header ("Location: albums.php");
	}
}
?>
