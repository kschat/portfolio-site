<?php
$database = 'kyle_portfolio_site';
$host = 'localhost';
$user = 'kyle_db';
$password = '121689kyle';
$table = 'user';

try {
	$dbh = new PDO("mysql:host=$host;dbname=$database;", $user, $password);
}
catch(PDOException $e) {
	echo $e->getMessage();
}