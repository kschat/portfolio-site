<?php
include_once 'DatabaseHandler.php';
$database = 'kyle_portfolio_site';
$host = 'localhost';
$user = 'kyle_db';
$password = '121689kyle';
$table = 'user';

try {
	$dbh = new DatabaseHandler($database, $host, $user, $password);
}
catch(PDOException $e) {
	echo $e->getMessage();
}