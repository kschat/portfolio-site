<?php 
error_reporting(E_ALL);
ini_set('display_errors','On');
session_start();
include_once 'database.php';
include_once 'Bcrypt.php';

$response['error'] = true;
$response['message'] = 'Fields cannot be empty.';
$response['firstname'] = '';

if(isset($_POST['login-email']) && trim($_POST['login-email']) !== '' &&
	isset($_POST['login-password']) && trim($_POST['login-password']) !== '') {
	$email = trim($_POST['login-email']);
	$password = trim($_POST['login-password']);
	$bcrypt = new Bcrypt(12);
	
	$sql = 'SELECT user.user_password, user.user_firstname, user.user_id, roles.title 
			FROM 
				(user LEFT JOIN permission_to 
					ON user.user_id = permission_to.user_id)
				LEFT JOIN roles
					ON permission_to.role_id = roles.role_id
			WHERE user.user_email = ?;';

	$sth = $dbh->prepare($sql);
	$sth->execute(array($email));
	
	if($row = $sth->fetch(PDO::FETCH_NUM)) {
		if($bcrypt->verify($password, $row[0])) {
			$response['error'] = false;
			$_SESSION['firstname'] = $response['firstname'] = $row[1];
			$_SESSION['user_id'] = $row[2];
			$_SESSION['user_role'] = $row[3];
		}
	}
	
	if($response['error']) {
		$response['message'] = 'Incorrect email or password.';
	}
}

//sleep(5);
echo json_encode($response);
$dbh = null;
