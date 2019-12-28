<?php
// check admin 
session_start();

if ($_SESSION['auth'] !== "true") {
	header("Location: index.php?error=Your are not administrator. Please login again.");
}
?>
<h1>Hello <?php echo $_SESSION['user_login']?></h1>