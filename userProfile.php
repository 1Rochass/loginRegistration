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
// Update user info
// VALIDATION
if (isset($_POST['update'])) {
	
	$errors = array();
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
	// new_user_password
	if (empty($_POST['new_user_password'])) {
		$errors[] = "Please write new your password.";
	}
	else {
		// HASH
		$new_user_password = md5(trim($_POST['new_user_password']));
	}
	// repeat_new_user_password
	if (empty($_POST['repeat_new_user_password'])) {
		$errors[] = "Please repeat your new password.";
	}
	else if ($_POST['new_user_password'] !== $_POST['repeat_new_user_password']) {
		$errors[] = "Your new passwords is not similar."; 
	}
	else {
		$repeat_new_user_password = trim($_POST['repeat_new_user_password']);
	}
	// user_email
	if (empty($_POST['user_email'])) {
		$errors[] = "Please write your email.";
	}
	else {
		$user_email = trim($_POST['user_email']);
	}
	// date_registration
	$date_registration = date('Y-m-d H:i:s', time());

	// ERROR
	if (!empty($errors) ) {
		$error = array_shift($errors);
		echo "<p style='color:red'>{$error}</p>";
	}
	// Check old password
	else {
		$query = "SELECT * FROM `users` WHERE user_login = :user_login AND user_password = :user_password";
		$prepare = [":user_login" => $user_login, ":user_password" => $user_password];

		$stmt = $pdo->prepare($query);
		$stmt->execute($prepare);

		$result = $stmt->fetch();

		// If old password ok
		if (
			$result['user_login'] == $user_login
			AND
			$result['user_password'] == $user_password) {
			
			$query = "UPDATE `users` SET user_password = :user_password, user_email = :user_email WHERE user_login = :user_login";
			$prepare = [":user_password" => $new_user_password, ":user_email" => $user_email, ":user_login" => $user_login];

			$stmt = $pdo->prepare($query);
			$stmt->execute($prepare);

			if ($stmt == true) {
				echo "<p style='color:green'>Your profile information have been changed.</p>";
			}
			else {
				echo "<p style='color:red'>Something wrong with DB.</p>";
			}
		}
		else {
			echo "<p style='color:red'>Please write your real password.</p>";
		}
	}
}



// Show user info
$user_login = $_SESSION['user_login'];

$query = "SELECT * FROM `users` WHERE user_login = :user_login";
$params = [':user_login' => $user_login];

$stmt = $pdo->prepare($query);
$stmt->execute($params);

$result = $stmt->fetch();
?>

<!-- Html form -->
<form action='' method='POST'>
	<label for="user_login">Login
		<input type="text" name="user_login" value="<?php echo $result['user_login'] ?>" readonly>
	</label>
	<br>
	<label for="user_password">Old password
		<input type="text" name="user_password" value="">
	</label>
	<br>
	<label for="new_user_password">New password
		<input type="text" name="new_user_password" value="">
	</label>
	<br>
	<label for="repeat_new_user_password">Repeat new password
		<input type="text" name="repeat_new_user_password" value="">
	</label>
	<br>
	<label for="user_email">Email
		<input type="text" name="user_email" value="<?php echo $result['user_email'] ?>">
	</label>
	<br>
	<input type="submit" name="update" value="Update"> 
</form>

</body>
</html>