<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php if (isset($_GET['error'])) {
	echo "<div style='color:red'>" . $_GET['error'] ."</div><br>"; }
?>	
<a href="login.php">Login</a>
<br>
<a href="registration.php">Registration</a>

<?php
if (isset($_SESSION['user_login'])) {
	echo "<br>";
	echo "<a href='userProfile.php'>Profie</a>";	
}

?>
</body>
</html>
