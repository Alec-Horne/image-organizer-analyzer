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
  <script type="text/javascript" src="scripts/filters.js"></script>
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
  
  <body onload="init2()">
  <header>
    <div class="nav">
      <ul>
        <li class="home"><a id="home" href="home.php">Home</a></li>
        <li class="processing"><a class="active" id="process" href="">Process</a>
          <ul>
            <li><a href="filters.php" class="active">Preset Filters</a></li>
            <li><a href="customfilters.php">Custom Filters</a></li>
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
	  <nav class="filters">
		<button id="resetbtn" class="btn btn-success">Reset Photo</button>
		<button id="brightnessbtn" class="btn btn-primary">Brightness</button>
		<button id="noisebtn" class="btn btn-primary">Noise</button>
		<button id="sepiabtn" class="btn btn-primary">Sepia</button>
		<button id="contrastbtn" class="btn btn-primary">Contrast</button>
        <button id="colorbtn" class="btn btn-primary">Colorize</button>
	  </nav><br>

	  <nav class="filters">
		<button id="vintagebtn" class="btn btn-primary">Vintage</button>
		<button id="lomobtn" class="btn btn-primary">Lomo</button>
		<button id="embossbtn" class="btn btn-primary">Emboss</button>
		<button id="tiltshiftbtn" class="btn btn-primary">Tilt Shift</button>
		<button id="radialblurbtn" class="btn btn-primary">Radial Blur</button>
		<button id="edgeenhancebtn" class="btn btn-primary">Edge Enhance</button>
	  </nav><br>

	  <nav class="filters">
		<button id="posterizebtn" class="btn btn-primary">Posterize</button>
		<button id="claritybtn" class="btn btn-primary">Clarity</button>
		<button id="orangepeelbtn" class="btn btn-primary">Orange Peel</button>
		<button id="sincitybtn" class="btn btn-primary">Sin City</button>
		<button id="sunrisebtn" class="btn btn-primary">Sun Rise</button>
		<button id="crossprocessbtn" class="btn btn-primary">Cross Process</button>
	  </nav><br>

	  <nav class="filters">
		<button id="hazydaysbtn" class="btn btn-primary">Hazy</button>
		<button id="lovebtn" class="btn btn-primary">Love</button>
		<button id="grungybtn" class="btn btn-primary">Grungy</button>
		<button id="jarquesbtn" class="btn btn-primary">Jarques</button>
		<button id="pinholebtn" class="btn btn-primary">Pin Hole</button>
		<button id="oldbootbtn" class="btn btn-primary">Old Boot</button>
		<button id="glowingsunbtn" class="btn btn-primary">Glow Sun</button>
	  </nav><br>

	  <nav class="filters">
		<button id="hdrbtn" class="btn btn-warning">HDR Effect</button>
		<button id="oldpaperbtn" class="btn btn-warning">Old Paper</button>
		<button id="pleasantbtn" class="btn btn-warning">Pleasant</button>
		<button id="savebtn" class="btn btn-success">Save Image</button>
	  </nav>
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
