<?php

if(isset($_GET['page']) && !empty($_GET['page'])) {
	$page = substr($_GET['page'], -1);
}
else {
	$page = -1;
}

if($page == 0) {
	include 'home.php';
}
else if($page == 1) {
	include 'project.php';
}
else if($page == 2) {
	include 'resume.php';
}
else if($page == 3) {
	include 'contact.php';
}
else {
	include 'pageNotFound.php';
}