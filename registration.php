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
<h3>Registration</h3>
<a href="index.php">Home</a>
<br>
<br>
<?php 
// VALIDATION
$errors = array();
if (isset($_POST['registration'])) {
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
	// user_repeat_password
	if (empty($_POST['user_repeat_password'])) {
		$errors[] = "Please repeat your password.";
	}
	else if ($_POST['user_password'] !== $_POST['user_repeat_password']) {
		$errors[] = "Your passwords is not similar."; 
	}
	else {
		$user_repeat_password = trim($_POST['user_repeat_password']);
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
	else {
		// DB
		// Check user existing
		$query = "SELECT * FROM `users` WHERE user_login = '$user_login'";

		$stmt = $pdo->query($query);


		// check response 
		if ($stmt->rowCount() > 0) {
			echo "<p style='color: red'>Sorry, but this login: '{$user_login}' is busy. Try another.</p>";
		}
		else {
			// Make registration
			$query = "INSERT INTO `users` 
				(user_login, user_password, user_email, date_registration) 
				VALUES 
				(:user_login, :user_password, :user_email, :date_registration)";

			$params = [
				':user_login' => $user_login,
				':user_password' => $user_password,
				':user_email' => $user_email,
				':date_registration' => $date_registration
			];

			$stmt = $pdo->prepare($query);
			$stmt = $stmt->execute($params);
			 
			if ($stmt === TRUE) {

				// Session
				$_SESSION['user_login'] = $user_login;

		 		echo "<p style='color:green'><span style='color:red'>{$_SESSION['user_login']}</span> You have successfully registered.</p>";
		 	}
		 	else {

		    echo "PDO::errorInfo():";
		    print_r($pdo->errorInfo());

		 		echo "<p style='color:red'>Something wrong with stmt</p>";
		 		var_dump($stmt);
		 	}
		}


		// mysqli
		// $connect = new mysqli("localhost", "root", "toor", "loginregistration"); 
		
		// $select = "SELECT * FROM users where user_login = '$user_login'";
		// $result = $connect->query($select);

		// if ($result->fetch_assoc() == NULL) {

		// 	$insert = "INSERT INTO `users` 
		// 		  (user_login, user_password, user_email)
		// 		  VALUES
		// 		  ('$user_login', '$user_password', '$user_email')";

		// 	if ($connect->query($insert) === TRUE) {
		// 		echo "<p style='color:green'>You have successfully registered.</p>";
		// 	}
		// 	else {
		// 		echo "Error:" . $connect->error;
		// 	}
		// }
		// else {
		// 	echo "You must change your login";
		// }

		
	}


	


}
 ?>
<!-- HTML
user_login 
user_password
user_repeat_password
user_email
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
	<label for="user_email">Email
		<input type="text" name="user_email" value="<?php echo $_POST['user_email'] ?>">
	</label>
	<br>
	<input type="submit" name="registration" value="Registration">
</form>
</body>
</html>
