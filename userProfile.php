<?php 
// BOOTSTRAP
require_once "bootstrap.php";
if (!isset($_SESSION['user_login'])) {
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php 
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
<h3>User profile</h3>
<a href="index.php">Home</a>
<br>
<br>

<?php 
$user_login = $_SESSION['user_login'];

$query = "SELECT * FROM `users` WHERE user_login = :user_login";
$params = [':user_login' => $user_login];

$stmt = $pdo->prepare($query);
$stmt->execute($params);

$result = $stmt->fetch();

echo "<form action='' method='POST'>";
?>
	<label for="user_login">Login
		<input type="text" name="user_login" value="<?php echo $result['user_login'] ?>">
	</label>
	<br>
	<label for="user_password">Old password
		<input type="text" name="user_password" value="<?php echo $_POST['user_password'] ?>">
	</label>
	<br>
	<label for="user_password">New password
		<input type="text" name="user_password" value="">
	</label>
	<br>
	<label for="user_repeat_password">Repeat new password
		<input type="text" name="user_repeat_password" value="<?php echo $_POST['user_repeat_password'] ?>">
	</label>
	<br>
	<label for="user_email">Email
		<input type="text" name="user_email" value="<?php echo $result['user_email'] ?>">
	</label>
	<br>
	<input type="submit" name="update" value="Update"> 
<?php
echo "</form>";
?>
	

</body>
</html>