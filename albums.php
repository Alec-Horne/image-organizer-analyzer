<?php
// Start the session
session_start();

if (!(isset($_SESSION['username'])) || $_SESSION['username'] == '')
	header("Location: login.html");
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Albums</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="scripts/caman.full.min.js"></script>
	<script type="text/javascript" src="scripts/filters.js"></script>
	<script type="text/javascript" src="scripts/utilities.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href='style.css' rel='stylesheet' type='text/css'/>
	<style>
		@font-face {
			font-family: Infinity;
			src: url(res/Infinity.ttf);
		}
		@font-face {
			font-family: Nord;
			src: url(res/Nord.ttf);
		}
		@font-face {
			font-family: MacNord;
			src: url(res/MacNord.ttf);
		}
		@font-face {
			font-family: Architect;
			src: url(res/ArchitectsDaughter.ttf);
		}
    </style>
  </head>
  <body>
  <header>
    <div class="nav">
      <ul>
        <li class="home"><a id="home" href="home.php">Home</a></li>
        <li class="processing"><a id="process" href="">Process</a>
          <ul>
            <li><a href="filters.php">Preset Filters</a></li>
            <li><a href="customfilters.php">Custom Filters</a></li>
            <li><a href="">Crop Image</a></li>
            <li><a href="">Resize Image</a></li>
          </ul>
        </li>
        <li><a href="analyze.php">Analyze</a></li>
        <li><a href="albums.php" class="active">Albums</a></li>
        <li><a href="info.html">Project Info</a></li>
      </ul>
    </div>
  </header>
  <br><br>
  
<?php
	$name = $_SESSION["username"];
	
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

	$query = "SELECT * from album1 WHERE login='$name'";
	trim($query);
	$query_html = htmlspecialchars($query);
    $count = 0;
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	print '<div style="margin-left: 4%;"><h2 style="font-family: Architect;">Album 1</h2>';
	for ($i = 1; $i <= 10; $i++) {
		$source = $row['pic' . (string)$i];
		if ($source == null) {
			if ($count != 1) {
				print '<form style="display: inline-block;" action="upload_image.php" method="post" enctype="multipart/form-data">
				Select image to upload:
				<input type="file" name="fileToUpload" id="fileToUpload">
				<input type="submit" name="album1:pic' . $i . '" value="Upload Image">
				</form>';
				$count = 1;
			}
		} else {
			$_SESSION['source'] = $source;
			print "<form action='delete_image.php' method='post' enctype='multipart/form-data' 
			style='display: inline-block; margin-right: 10px; margin-top: 10px;'>
			<input type='submit' name='album1:pic" . $i . "' value='delete' style='position: absolute;'>
			<img src='$source' width='200' height='200'></form>";
		}
	}
	print '</div><br>';
	
	$query = "SELECT * from album2 WHERE login='$name'";
	trim($query);
	$query_html = htmlspecialchars($query);
    $count = 0;
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	print '<div style="margin-left: 4%;"><h2 style="font-family: Architect;">Album 2</h2>';
	for ($i = 1; $i <= 10; $i++) {
		$source = $row['pic' . (string)$i];
		if ($source == null) {
			if ($count != 1) {
				print '<form style="display: inline-block;" action="upload_image.php" method="post" enctype="multipart/form-data">
				Select image to upload:
				<input type="file" name="fileToUpload" id="fileToUpload">
				<input type="submit" name="album2:pic' . $i . '" value="Upload Image">
				</form>';
				$count = 1;
			}
		} else {
			$_SESSION['source'] = $source;
			print "<form action='delete_image.php' method='post' enctype='multipart/form-data' 
			style='display: inline-block; margin-right: 10px; margin-top: 10px;'>
			<input type='submit' name='album2:pic" . $i . "' value='delete' style='position: absolute;'>
			<img src='$source' width='200' height='200'></form>";
		}
	}
	print '</div><br>';
	
	$query = "SELECT * from album3 WHERE login='$name'";
	trim($query);
	$query_html = htmlspecialchars($query);
    $count = 0;
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	print '<div style="margin-left: 4%;"><h2 style="font-family: Architect;">Album 3</h2>';
	for ($i = 1; $i <= 10; $i++) {
		$source = $row['pic' . (string)$i];
		if ($source == null) {
			if ($count != 1) {
				print '<form style="display: inline-block;" action="upload_image.php" method="post" enctype="multipart/form-data">
				Select image to upload:
				<input type="file" name="fileToUpload" id="fileToUpload">
				<input type="submit" name="album3:pic' . $i . '" value="Upload Image">
				</form>';
				$count = 1;
			}
		} else {
			$_SESSION['source'] = $source;
			print "<form action='delete_image.php' method='post' enctype='multipart/form-data' 
			style='display: inline-block; margin-right: 10px; margin-top: 10px;'>
			<input type='submit' name='album3:pic" . $i . "' value='delete' style='position: absolute;'>
			<img src='$source' width='200' height='200'></form>";
		}
	}
	print '</div><br>';
	
	
	
	$query = "SELECT * from album4 WHERE login='$name'";
	trim($query);
	$query_html = htmlspecialchars($query);
    $count = 0;
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	print '<div style="margin-left: 4%;"><h2 style="font-family: Architect;">Album 4</h2>';
	for ($i = 1; $i <= 10; $i++) {
		$source = $row['pic' . (string)$i];
		if ($source == null) {
			if ($count != 1) {
				print '<form style="display: inline-block;" action="upload_image.php" method="post" enctype="multipart/form-data">
				Select image to upload:
				<input type="file" name="fileToUpload" id="fileToUpload">
				<input type="submit" name="album4:pic' . $i . '" value="Upload Image">
				</form>';
				$count = 1;
			}
		} else {
			$_SESSION['source'] = $source;
			print "<form action='delete_image.php' method='post' enctype='multipart/form-data' 
			style='display: inline-block; margin-right: 10px; margin-top: 10px;'>
			<input type='submit' name='album4:pic" . $i . "' value='delete' style='position: absolute;'>
			<img src='$source' width='200' height='200'></form>";
		}
	}
	print '</div><br>';
	
	$query = "SELECT * from album5 WHERE login='$name'";
	trim($query);
	$query_html = htmlspecialchars($query);
    $count = 0;
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	print '<div style="margin-left: 4%;"><h2 style="font-family: Architect;">Album 5</h2>';
	for ($i = 1; $i <= 10; $i++) {
		$source = $row['pic' . (string)$i];
		if ($source == null) {
			if ($count != 1) {
				print '<form style="display: inline-block;" action="upload_image.php" method="post" enctype="multipart/form-data">
				Select image to upload:
				<input type="file" name="fileToUpload" id="fileToUpload">
				<input type="submit" name="album5:pic' . $i . '" value="Upload Image">
				</form>';
				$count = 1;
			}
		} else {
			$_SESSION['source'] = $source;
			print "<form action='delete_image.php' method='post' enctype='multipart/form-data' 
			style='display: inline-block; margin-right: 10px; margin-top: 10px;'>
			<input type='submit' name='album5:pic" . $i . "' value='delete' style='position: absolute;'>
			<img src='$source' width='200' height='200'></form>";
		}
	}
	print '</div>';
?>

  </body>
</html>