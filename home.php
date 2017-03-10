<?php
// Start the session
session_start();

if (!(isset($_SESSION['username'])) || $_SESSION['username'] == '')
	header("Location: login.html");
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Home</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script type="text/javascript" src="scripts/caman.full.min.js"></script>
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
  
  <body>
  <header>
    <div class="nav">
      <ul>
        <li class="home"><a class="active" id="home" href="home.php">Home</a></li>
        <li class="processing"><a id="process" href="">Process</a>
          <ul>
            <li><a href="filters.php">Preset Filters</a></li>
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
  <div>
    <form style="display: inline;" action="logout.php" method="post">
		Logout:  
		<input type="submit" name="submit" value="Logout">
	</form>
  </div>
  </body>
</html>