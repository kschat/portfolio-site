<?php
session_start();
include_once 'database.php';
include_once 'Bcrypt.php';

$response['error'] = true;
$response['message'] = 'You must fill out all the fields.';
$response['selector'] = '#signup-panel-form :input:not(:submit)';

if(isset($_POST['signup-fname']) &&
	isset($_POST['signup-lname']) &&
	isset($_POST['signup-email']) &&
	isset($_POST['signup-password1']) &&
	isset($_POST['signup-password2'])) {
	
	$firstname = trim($_POST['signup-fname']);
	$lastname = trim($_POST['signup-lname']);
	$email = trim($_POST['signup-email']);
	$password1 = trim($_POST['signup-password1']);
	$password2 = trim($_POST['signup-password2']);
	
	$sql = 'SELECT user.user_email FROM user WHERE user.user_email = ?';
	$sth = $dbh->prepare($sql);
	$sth->execute(array($email));

	if($sth->fetch(PDO::FETCH_NUM)) {
		$response['message'] = 'Email is already in use.';
		$response['selector'] = '#signup-email';
	}
	else if(strlen($firstname) < 2) { 
		$response['message'] = 'Your first name field is too short.';
		$response['selector'] = '#signup-fname';
	}
	else if(strlen($firstname) > 35) {
		$response['message'] = 'Your first name field is too long.';
		$response['selector'] = '#signup-fname';
	}
	else if(strlen($lastname) < 2) {
		$response['message'] = 'Your last name field is too short.';
		$response['selector'] = '#signup-lname';
	}
	else if(strlen($lastname) > 35) {
		$response['message'] = 'Your last name field is too long.';
		$response['selector'] = '#signup-lname';
	}
	else if(strlen($password1) < 8) {
		$response['message'] = 'Your password is too short.';
		$response['selector'] = '#signup-password1';
	}
	else if(strlen($password2) > 50) {
		$response['message'] = 'Your password is too long.';
		$response['selector'] = '#signup-password1';
	}
	else if($password1 != $password2) {
		$response['message'] = 'The password fields must match.';
		$response['selector'] = '[id^="signup-password"]';
	}
	else {
		$bcrypt = new Bcrypt(12);
		$hash = $bcrypt->hash($password1);
		$response['message'] = 'Problem connecting to the database.';
		$response['selector'] = '';
		
		$sql = 'INSERT INTO user(user.user_id, user.user_firstname, user.user_lastname, user.user_email, user.user_password) 
				VALUES (?, ?, ?, ?, ?);';
		$sth = $dbh->prepare($sql);
		if($sth->execute(array(null, $firstname, $lastname, $email, $hash))) {
			$response['error'] = false;
			$response['message'] = 'Success.';
			$_SESSION['username'] = $response['firstname'] = $firstname;
		}
	}
}

sleep(5);
echo json_encode($response);
$dbh = null;