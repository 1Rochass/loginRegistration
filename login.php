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
<h3>Login</h3>
<a href="index.php">Home</a>

<?php
// User profile
if (isset($_SESSION['user_login'])) {
	echo "<br>";
	echo "<a href='userProfile.php'>Profie</a>";	
}
?>
<br>
<br>
<?php
// Login
// Validation
$errors = array();
if (isset($_POST['login'])) {
	// user_login
	if (empty($_POST['user_login'])) {
		$errors[] = "Please write your login.";
	}
	else {
		$user_login = trim($_POST['user_login']);
	}
	// user_password
	if (empty($_POST['user_password'])) {
		$errors[] = "Please write your password.";
	}
	else {
		// HASH
		$user_password = md5(trim($_POST['user_password']));
	}
	if (!empty($errors)) {
		$error = array_shift($errors);
		echo "<p style='color:red'>{$error}</p>";
	}
	else {
		// DB
		$query = "
			SELECT * FROM `users` WHERE 
			user_login = :user_login 
			AND
			user_password = :user_password";
		
		$params = [
			':user_login' => $user_login,
			':user_password' => $user_password
			];

		$stmt = $pdo->prepare($query);
		$stmt->execute($params);

		$row = $stmt->fetch();
		
		if ($row == false) {
			echo "<p style='color:red'>Your login or password is incorrect. Try again.</p>";
		}
		else {
			
			// Session
			$_SESSION['user_login'] = $row['user_login'];

	 		echo "<p style='color:green'><span style='color:red'>{$_SESSION['user_login']}</span> You have successfully logged.</p>";

	 		// Session unset
			if (isset($_SESSION['user_login'])) {
				echo "
				<form  action='' method='POST'>
				<input type='submit' name='session_unset' value='Выйти'>
				</form><br>";
			}
		}
	}
}

?>

<form action="" method="POST">
	<label for="user_login">Login
		<input type="text" name="user_login" value="<?php echo $_POST['user_login'] ?>">
	</label>
	<br>
	<label for="user_password">Password
		<input type="text" name="user_password" value="<?php echo $_POST['user_password'] ?>">
	</label>
	<br>
	<input type="submit" name="login" value="Log in">
</form>
</body>
</html>