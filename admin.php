<?php
// BOOTSTRAP
require_once "bootstrap.php";

if (!isset($_SESSION['admin'])) {
	header("Location: index.php?error=Your are not administrator. Please login again.");
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
<h3>Admin panel</h3>
<a href="index.php">Home</a>



<?php 
// Delete user
if (isset($_POST['delete_user'])) {
	if ($_SESSION['admin'] == 1) {
		$user_login = $_POST['user_login'];

		$query = "DELETE FROM `users` WHERE user_login = :user_login";
		$prepare = [':user_login' => $user_login];

		$stmt = $pdo->prepare($query);
		$stmt->execute($prepare);

		if ($stmt == TRUE) {
			echo "<p style='color:red'>User {$user_login} was deleted</p>";
		}
	}
	else {
		echo "<p style='color:red'>You have not permission.</p>";
	}
}
// Make admin
if (isset($_POST['make_admin'])) {
	$user_login = $_POST['user_login'];

	$query = "UPDATE `users` SET admin = :admin WHERE user_login = :user_login";
	$prepare = [':admin' => 2, ':user_login' => $user_login];

	$stmt = $pdo->prepare($query);
	$stmt->execute($prepare);

	if ($stmt == TRUE) {
		echo "<p style='color:green'>User {$user_login} now is admin.</p>";
	}
}


// Show users
$query = "SELECT * FROM `users`";

$stmt = $pdo->query($query);
$result = $stmt->fetchAll();

echo "<table border = 1 >";
echo "<tr>
			<td>User name</td>
			<td>Admin</td>
	  </tr>";
foreach ($result as $key => $array) {
	echo "
		<tr>
			<td>{$array['user_login']}</td>
			<td>{$array['admin']}</td>
			<td>
				<form action='' method='POST'>
					<input type='text' name='user_login' value='{$array['user_login']}' hidden>
					<input type='submit' name='delete_user' value='Delete user'>
				</form>
			</td>
			<td>
				<form action='' method='POST'>
					<input type='text' name='user_login' value='{$array['user_login']}' hidden>
					<input type='submit' name='make_admin' value='Make admin'>
				</form>
			</td>
		</tr>
	";
}
echo "</table>";

?>
</body>
</html>