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
</body>
</html>
