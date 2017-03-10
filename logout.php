<?php
// stop the session
session_start();
session_destroy();
$_SESSION['username'] = '';
header("Location: login.html");
?>
