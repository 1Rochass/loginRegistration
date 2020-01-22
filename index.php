<?php 
// BOOTSTRAP
require_once "bootstrap.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
// Errors
if (isset($_GET['error'])) {
	echo "<div style='color:red'>" . $_GET['error'] ."</div><br>"; }
// Session
if (isset($_SESSION['user_login'])) {
	echo "<p style='color:green'>Your login: {$_SESSION['user_login']}</p>";
	echo "
	<form  action='' method='POST'>
	<input type='submit' name='session_unset' value='Выйти'>
	</form>";
}
?>
<!-- MENU -->
<h3>Home</h3>
<a href="login.php">Login</a>
<br>
<a href="registration.php">Registration</a>

<?php
// User profile
if (isset($_SESSION['user_login'])) {
	echo "<br>";
	echo "<a href='userProfile.php'>Profie</a>";	
}
?>
</body>
</html>
