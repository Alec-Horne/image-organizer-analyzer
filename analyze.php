<?php
// Start the session
session_start();

if (!(isset($_SESSION['username'])) || $_SESSION['username'] == '')
	header("Location: login.html");
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Analyze</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="scripts/caman.full.min.js"></script>
	<script type="text/javascript" src="scripts/analyzeImage.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet" type="text/css"/>
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
  <body onload="init()">
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
        <li><a href="analyze.php" class="active">Analyze</a></li>
        <li><a href="albums.php">Albums</a></li>
        <li><a href="info.html">Project Info</a></li>
      </ul>
    </div>
  </header>
  <br><br>
	<div class="analyzeDiv" style="text-align: center;">
	  <canvas id="analyzeCanvas" width="300" height="300" onload="init()" ondrop="drop(event)" ondragover="allowDrop(event)"></canvas>
	  <br><br>
	  <canvas id="histogramCanvasR" style="margin-right: 10px;" width="256" height="200"></canvas>
	  <canvas id="histogramCanvasG" width="256" height="200"></canvas>
	  <canvas id="histogramCanvasB" width="256" height="200"></canvas>
	  <br><br>
	  <label id="avgColorTitleLbl" style="font-family: Architect; font-size: 24px;"></label>
	  <canvas id="avgColorCanvas" width="256" height="50"></canvas>
	  <label id="avgColorLbl" style="font-family: Architect; font-size: 24px;"></label>
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
			print "<img src='$source' id='album1:pic" . $i . "' ondragstart='dragStart(event);' draggable='true' width='100' height='100'>";
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
			print "<img src='$source' id='album2:pic" . $i . "' ondragstart='dragStart(event);' draggable='true' width='100' height='100'>";
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
			print "<img src='$source' id='album3:pic" . $i . "' ondragstart='dragStart(event);' draggable='true' width='100' height='100'>";
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
			print "<img src='$source' id='album4:pic" . $i . "' ondragstart='dragStart(event);' draggable='true' width='100' height='100'>";
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
			print "<img src='$source' id='album5:pic" . $i . "' ondragstart='dragStart(event);' draggable='true' width='100' height='100'>";
	}
	print '</div>';
	?>
	
	</div>

	<script type="text/javascript" src="scripts/dragImage.js"></script>
	<script type="text/javascript" src="scripts/utilities.js"></script>
	
  </body>
</html>
