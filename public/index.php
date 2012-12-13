<?php 
session_start();
if(isset($_COOKIE['username']) && !isset($_SESSION['username'])) {
	$_SESSION['username'] = $_COOKIE['username'];
}

if(!isset($_SESSION['username']) || !isset($_COOKIE['username'])) {
	$_SESSION['username'] = null;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="description" content="Kyle Schattlers' portfolio page.">
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
		<title>Kyle Schattlers' Portfolio</title>
		
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-con" />
		<link rel="stylesheet" type="text/css" href="css/mainStyle.css" />
		
		<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="js/top-nav.js"></script>
		<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-34754817-1']);
		  _gaq.push(['_setDomainName', 'kyleschattler.com']);
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>
	</head>

	<body>
		<div id="nav-shadow">
		</div>
		<div id="main-nav" class="nav">
			<div id="nav-container">
				<div id="top-nav">
					<ul>
						<li><a id="nav-link-0" class="selected-link" href="?home">Home</a></li>
						<li><a id="nav-link-1" href="projects.php">Projects</a></li>
						<li><a id="nav-link-2" href="resume.php">Resume</a></li>
						<li><a id="nav-link-3" href="contact.php">Contact Me</a></li>
					</ul>
				</div>
				
				<div id="right-nav" class="right-options">
					<div id="login" class="right-button">
						<ul>
							<li><a id="login-link" href="">Login</a></li>
						</ul>
					</div>

					<div id="settings" class="right-button">
						<ul>
							<li><a id="settings-link" href="">
							<?php if(isset($_SESSION['username'])) {
								echo $_SESSION['username'];
							}?>
							</a></li>
						</ul>
					</div>
					
					<div id="signup" class="right-button">
						<ul>
							<li><a id="signup-link" href="">Sign up</a></li>
						</ul>
					</div>
					
					<div id="button-overlay" class="right-button">
					</div>
					
					<div id="site-search" class="left-button">
						<form id="site-search-form" method="" action="">
							<input id="site-search-text" type="text" value="Search" />
						</form>
					</div>
				</div>
			</div>
		</div>

		<div id="panel-body">
			<div id="panel-container">
				<div id="login-panel" class="nav-panel">
					<div id="login-message" class="error-panel">
					</div>

					<form id="login-panel-form" action="" method="post">
						<table id="login-table">
						<tr>
							<td><label for="login-email">Email:</label></td>
							<td><input type="text" id="login-email" name="login-email" /></td>
						</tr>
						<tr>
							<td><label for="login-password">Password:</label></td>
							<td><input type="password" id="login-password" name="login-password" /></td>
						</tr>
						<tr>
							<td><label for="login-remember">Remember me</label></td>
							<td><input type="checkbox" id="login-remember" name="login-remember" /></td>
						</tr>
						</table>
						<a id="login-signup" href="">Sign up</a><br />
						<button type="submit" id="login-submit" name="login-submit" value="login" >login</button>
						<!--<input type="submit" id="login-submit" name="login-submit" value="login" />-->
					</form>
				</div>

				<div id="panel-overlay" class="nav-panel">
					<img class="overlay-load-image" src="images/ajax-loader.gif">
				</div>

				<div id="signup-panel" class="nav-panel">
					<div id="signup-message" class="error-panel">
					</div>
					
					<form id="signup-panel-form" action="" method="post">
						<table id="signup-table">
						<tr>
							<td><label for="signup-fname">First name:</label></td>
							<td><input type="text" id="signup-fname" name="signup-fname" /></td>
						</tr>
						<tr>
							<td><label for="signup-lname">Last name:</label></td>
							<td><input type="text" id="signup-lname" name="signup-lname" /></td>
						</tr>
						<tr>
							<td><label for="signup-email">Email:</label></td>
							<td><input type="text" id="signup-email" name="signup-email" /></td>
						</tr>
						<tr>
							<td><label for="signup-password1">Password:</label></td>
							<td><input type="password" id="signup-password1" name="signup-password1" /></td>
						</tr>
						<tr>
							<td><label for="signup-password2">Confirm password:</label></td>
							<td><input type="password" id="signup-password2" name="signup-password2" /></td>
						</tr>
						</table>
						<button type="submit" id="signup-submit" value="Sign up" >Sign up</button>
					</form>
				</div>

				<div id="settings-panel" class="nav-panel">
					<div class="panel-content">
						<img src="" />
					</div>
					
					<form>
						<a id="signout-link" href="">Sign out</a>
					</form>
				</div>
			</div>
		</div>

		<div id="main-content">
			<noscript>
				<div id="javascript-warning" class="error-panel">
					<p>Please enable Javascript to properly use this site</p>
				</div>
			</noscript>
			<div id="banner" class="page-panel">
				<div id="banner-header" class="page-panel-header">
					<h2>Kyle Schattler: Portfolio</h2>
				</div>
				<div id="banner-content" class="content">
					<img src="images/me.jpg" class="profile-image" />
					
					<div id="aboutme-description" class="description">
						<p>
							I am a 23 year old Web and Application Programmer from Allentown Pennsylvania. I'm currently in my last year at Pennsylvania College of Technology
							for a Bachelors in Software Engineering. I've been programming for 6 years now and have loved every second of it. I started out with C++ and Java in
							high school, but switched gears a bit to web development in college. In my free time I like to work on open source projects. Over the summer I worked
							as freelance developer for a hair style website called blacknaps.org where I developed both the front and back end of a WordPress plugin. Being as that
							project is now in the maintance phase I'm looking to take on more freelance work.
							<br /><br />
							You can view all the projects I've worked on my "Projects" page. If you would like to contact please leave me an email. If you'd like to know 
							anything else about me feel free to view or download my resume.
						</p>
					</div>
				</div>
			</div>
			<div id="center-content">
			</div>
		</div>
	</body>
</html>
