<?php 
// SESSION
session_start();

// DB
require_once "db.php";

// SESSION unset
if (isset($_POST['session_unset'])) {
	unset($_SESSION['user_login']);
	header("Location: index.php");
}
?>