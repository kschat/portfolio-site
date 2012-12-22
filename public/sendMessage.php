<?php
session_start();
include_once 'databaseConnect.php';

$response['error'] = true;
$response['message'] = 'Required fields are empty.';

if(isset($_POST['sender-name']) && isset($_POST['sender-email']) && isset($_POST['sender-message'])
	&& !empty($_POST['sender-name']) && !empty($_POST['sender-email']) && !empty($_POST['sender-message'])) {
	
	if($dbh->sendMessage($_POST['sender-name'], $_POST['sender-email'], $_POST['sender-message'])) {
		$response['error'] = false;
		$response['message'] = 'Message sent.';
	}
}

echo json_encode($response);