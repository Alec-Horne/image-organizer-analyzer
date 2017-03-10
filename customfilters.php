<?php
// Start the session
session_start();

if (!(isset($_SESSION['username'])) || $_SESSION['username'] == '')
	header("Location: login.html");
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Process - Filters</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script type="text/javascript" src="scripts/caman.full.min.js"></script>
  <script type="text/javascript" src="scripts/analyzeImage.js"></script>
  <script type="text/javascript" src="scripts/customfilters.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href='style.css' rel='stylesheet' type='text/css'/>
  <?php 
	echo "<link href='style.css' rel='stylesheet' type='text/css'/>";
	echo '<script type="text/javascript" src="scripts/analyzeImage.js"></script>'
  ?>
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
  
  <body onload="init2()">
  <header>
    <div class="nav">
      <ul>
        <li class="home"><a id="home" href="home.php">Home</a></li>
        <li class="processing"><a class="active" id="process" href="">Process</a>
          <ul>
            <li><a href="filters.php">Preset Filters</a></li>
            <li><a href="customfilters.php" class="active">Custom Filters</a></li>
            <li><a href="">Crop Image</a></li>
            <li><a href="">Resize Image</a></li>
          </ul>
        </li>
        <li><a href="analyze.php">Analyze</a></li>
        <li><a href="albums.php">Albums</a></li>
        <li><a href="info.html">Project Info</a></li>
      </ul>
    </div>
  </header>
  <br><br>
	<div class="analyzeDiv" style="text-align: center;">
	  <canvas id="canvas" width="300" height="300" onload="init2()" ondrop="drop2(event)" ondragover="allowDrop2(event)"></canvas>
	  <br><br>
  <div class="col-lg-4" style="display: inline-block;">
    <label for="hue">Hue</label>
    <input id="hue" name="hue" type="range" min="0" max="100" value="0">
	<br><br>
    <label for="contrast">Contrast</label>
    <input id="contrast" name="contrast" type="range" min="-20" max="20" value="0">
	<br><br>
	<label for="brightness">Brightness</label>
    <input id="brightness" name="brightness" type="range" min="-100" max="100" value="0">
	<br><br>
	<label for="saturation">Saturation</label>
    <input id="saturation" name="saturation" type="range" min="-100" max="100" value="0">
  </div>
  <div class="col-lg-4" style="display: inline-block;">
    <label for="vibrance">Vibrance</label>
    <input id="vibrance" name="vibrance" type="range" min="-100" max="100" value="0">
	<br><br>
    <label for="sepia">Sepia</label>
    <input id="sepia" name="sepia" type="range" min="0" max="100" value="0">
	<br><br>
	<label for="gamma">Gamma</label>
    <input id="gamma" name="gamma" type="range" min="1" max="10" value="1">
	<br><br>
	<label for="noise">Noise</label>
    <input id="noise" name="noise" type="range" min="0" max="100" value="0">
  </div>
  <div class="col-lg-4" style="display: inline-block; vertical-align: top;">
    <label for="exposure">Exposure</label>
    <input id="exposure" name="exposure" type="range" min="-100" max="100" value="0">
	<br><br>
    <label for="clip">Clip</label>
    <input id="clip" name="clip" type="range" min="0" max="100" value="0">
	<br><br>
	<label for="sharpen">Sharpen</label>
    <input id="sharpen" name="sharpen" type="range" min="0" max="100" value="0">
  </div>
    <button id="resetbtn" style="margin-top: 5%;" class="btn btn-success">Reset Photo</button>
    <button id="savebtn" style="margin-top: 5%;" class="btn btn-success">Save Image</button>
	</div>
	<div style="float: right; width: 20%; height: 100%;">
	
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
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	print '<div style="margin-left: 4%;"><h2 style="font-family: Architect;">Album 1</h2>';
	for ($i = 1; $i <= 10; $i++) {
		$source = $row['pic' . (string)$i];
		if ($source != null)
			print "<img src='$source' id='album1:pic" . $i . "' ondragstart='dragStart2(event);' draggable='true' width='100' height='100'>";
	}
	print '</div>';
	
	$query = "SELECT * from album2 WHERE login='$name'";
	trim($query);
	$query_html = htmlspecialchars($query);
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	print '<div style="margin-left: 4%;"><h2 style="font-family: Architect;">Album 2</h2>';
	for ($i = 1; $i <= 10; $i++) {
		$source = $row['pic' . (string)$i];
		if ($source != null)
			print "<img src='$source' id='album2:pic" . $i . "' ondragstart='dragStart2(event);' draggable='true' width='100' height='100'>";
	}
	print '</div>';
	
	$query = "SELECT * from album3 WHERE login='$name'";
	trim($query);
	$query_html = htmlspecialchars($query);
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	print '<div style="margin-left: 4%;"><h2 style="font-family: Architect;">Album 3</h2>';
	for ($i = 1; $i <= 10; $i++) {
		$source = $row['pic' . (string)$i];
		if ($source != null)
			print "<img src='$source' id='album3:pic" . $i . "' ondragstart='dragStart2(event);' draggable='true' width='100' height='100'>";
	}
	print '</div>';
	
	$query = "SELECT * from album4 WHERE login='$name'";
	trim($query);
	$query_html = htmlspecialchars($query);
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	print '<div style="margin-left: 4%;"><h2 style="font-family: Architect;">Album 4</h2>';
	for ($i = 1; $i <= 10; $i++) {
		$source = $row['pic' . (string)$i];
		if ($source != null)
			print "<img src='$source' id='album4:pic" . $i . "' ondragstart='dragStart2(event);' draggable='true' width='100' height='100'>";
	}
	print '</div>';
	
	$query = "SELECT * from album5 WHERE login='$name'";
	trim($query);
	$query_html = htmlspecialchars($query);
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	print '<div style="margin-left: 4%;"><h2 style="font-family: Architect;">Album 5</h2>';
	for ($i = 1; $i <= 10; $i++) {
		$source = $row['pic' . (string)$i];
		if ($source != null)
			print "<img src='$source' id='album5:pic" . $i . "' ondragstart='dragStart2(event);' draggable='true' width='100' height='100'>";
	}
	print '</div>';
	?>
	
	</div>
  </body>
</html>
