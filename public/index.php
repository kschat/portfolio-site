<?php 
session_start();
if(isset($_COOKIE['username']) && !isset($_SESSION['username'])) {
	$_SESSION['username'] = $_COOKIE['username'];
}

if(!isset($_SESSION['username']) || !isset($_COOKIE['username'])) {
	$_SESSION['username'] = null;
}

include_once '../config.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="description" content="Kyle Schattlers' portfolio page.">
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
		<title>Kyle Schattlers' Portfolio</title>
		
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-con" />
		<link rel="stylesheet" type="text/css" href="css/mainStyle.css" />
		<link rel="stylesheet" type="text/css" href="css/font-awesome-ie7.css" />
		<link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
		
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
					
					<!--<div id="site-search" class="left-button">
						<form id="site-search-form" method="" action="">
							<input id="site-search-text" type="text" value="Search" />
						</form>
					</div>-->
				</div>
			</div>
		</div>

		<div id="panel-body">
			<div id="panel-container">
				<div id="login-panel" class="nav-panel">
					<div id="login-message" class="error-panel">
					</div>

					<form id="login-panel-form" action="" method="post">
						<label for="login-email">Email:</label><br />
						<input type="text" id="login-email" name="login-email" /><br />
						<label for="login-password">Password:</label><br />
						<input type="password" id="login-password" name="login-password" /><br />
						<label for="login-remember">Remember me</label>
						<input type="checkbox" id="login-remember" name="login-remember" /><br />

						<a id="login-signup" href="">Sign up</a><br />
						<button type="submit" id="login-submit" name="login-submit" value="login" >login</button>
					</form>
				</div>

				<div id="panel-overlay" class="nav-panel">
					<img class="overlay-load-image" src="images/ajax-loader.gif">
				</div>

				<div id="signup-panel" class="nav-panel">
					<div id="signup-message" class="error-panel">
					</div>
					
					<form id="signup-panel-form" action="" method="post">
						<label for="signup-fname">First name:</label><br />
						<input type="text" id="signup-fname" name="signup-fname" /><br />

						<label for="signup-lname">Last name:</label><br />
						<input type="text" id="signup-lname" name="signup-lname" /><br />

						<label for="signup-email">Email:</label><br />
						<input type="text" id="signup-email" name="signup-email" /><br />

						<label for="signup-password1">Password:</label><br />
						<input type="password" id="signup-password1" name="signup-password1" /><br />

						<label for="signup-password2">Confirm password:</label><br />
						<input type="password" id="signup-password2" name="signup-password2" /><br />

						<button type="submit" id="signup-submit" value="Sign up" >Sign up</button>
					</form>
				</div>

				<div id="settings-panel" class="nav-panel">
					<div class="panel-content nav-settings">
						<ul>
							<li><a href="#">Messages</a></li>
							<li><a id="signout-link" href="">Sign out</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div id="main-content">
			<?php 
				if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
					include_once 'messagePanel.php';
				} 
			?>
			<noscript>
				<div id="javascript-warning" class="error-panel">
					<p>Please enable Javascript to properly use this site.</p>
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
							high school, but switched gears a bit to web development in college. In my free time I like to work on open source projects and learn more about programming.
							 Over the summer I worked as freelance developer for a hair style website called blacknaps.org where I developed both the front and back end of a WordPress plugin.
							 Being as that project is now in the maintance phase I'm looking to take on more freelance work.
							<br /><br />
							There are two places you can view the projects I am or have worked on. One being here, on the projects page; the second being on my github.
							If you're interested in me doing web development for you, please feel free to contact me view email. My resume is also here to view and download.
							It contains my most recient projects and my academic information.


						</p>
					</div>
				</div>
			</div>
			<div id="center-content">
			</div>
		</div>
	</body>
</html>
