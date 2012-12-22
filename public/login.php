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
	
	$sql = 'SELECT user.user_password, user.user_firstname, user.user_id FROM user WHERE user.user_email = ?;';
	$sth = $dbh->prepare($sql);
	$sth->execute(array($email));
	
	if($row = $sth->fetch(PDO::FETCH_NUM)) {
		if($bcrypt->verify($password, $row[0])) {
			$response['error'] = false;
			$_SESSION['firstname'] = $response['firstname'] = $row[1];
			$_SESSION['user_id'] = $row[2];
		}
	}
	
	if($response['error']) {
		$response['message'] = 'Incorrect email or password.';
	}
}

//sleep(5);
echo json_encode($response);
$dbh = null;
