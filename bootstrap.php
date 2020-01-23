<?php 
// SESSION
session_start();

// DB
require_once "db.php";

// SESSION unset
if (isset($_POST['session_unset'])) {
	unset($_SESSION['user_login']);
	unset($_SESSION['admin']);
	header("Location: index.php");
}
?>