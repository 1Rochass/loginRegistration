<a href="index.php">Home</a>
<br>
<?php 
// validation
$error = array();
if (isset($_POST['registration'])) {
	// user_login
	if (empty($_POST['user_login'])) {
		$error[] = "Please write your login.";
	}
	else {
		$user_login = $_POST['user_login'];
	}
	// user_password
	if (empty($_POST['user_password'])) {
		$error[] = "Please write your password.";
	}
	else {
		$user_password = $_POST['user_password'];
	}
	// user_repeat_password
	if (empty($_POST['user_repeat_password'])) {
		$error[] = "Please repeat your password.";
	}
	else if ($_POST['user_password'] !== $_POST['user_repeat_password']) {
		$error[] = "Your passwords is not similar."; 
	}
	else {
		$user_repeat_password = $_POST['user_repeat_password'];
	}
	// user_email
	if (empty($_POST['user_imail'])) {
		$error[] = "Please write your email.";
	}
	else {
		$user_imail = $_POST['user_imail'];
	}

	if ($error !== NULL) {
		$errorMessage = array_shift($error);
		echo "<p style='color:red'>{$errorMessage}</p>";
	}
}
 ?>
<!-- HTML
user_login 
user_password
user_repeat_password
user_imail
 -->

<form action="" method="POST">
	<label for="user_login">Login
		<input type="text" name="user_login" value="<?php echo $_POST['user_login'] ?>">
	</label>
	<br>
	<label for="user_password">Password
		<input type="text" name="user_password" value="<?php echo $_POST['user_password'] ?>">
	</label>
	<br>
	<label for="user_repeat_password">Repeat password
		<input type="text" name="user_repeat_password" value="<?php echo $_POST['user_repeat_password'] ?>">
	</label>
	<br>
	<label for="user_imail">Email
		<input type="text" name="user_imail" value="<?php echo $_POST['user_imail'] ?>">
	</label>
	<br>
	<input type="submit" name="registration" value="Registration">
</form>

