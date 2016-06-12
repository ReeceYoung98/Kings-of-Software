<?php include $_SERVER['DOCUMENT_ROOT'].'/core/init.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<title>Kings of Software</title>
		
		<meta name="description" content="H17834 - Team Working in Computing">
		<meta name="author" content="Kings of Software">

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</head>

	<body bgcolor="#FA6607">
		<div class="container">
			<header>
				<nav class="navbar navbar-default navbar-static-top">
					<div class="container">
						<a href="/"><img src="/logo.png" width="" height="" alt="Kings of Software" /></a>
						<?php
						$user = new User();
						if (!$user->isLoggedIn()) {
							?>
							<p class="navbar-text navbar-right">
								<br />
								You need to <a href="/login.php">login</a> or <a href="/register.php">register</a>.
							</p>
							<?php
						}else{
							?>
							<p class="navbar-text navbar-right">
								<br />
								<a href='/logout.php'>Logout</a>
							</p>
							<?php
						}
						?>
					</div>
				</nav>
			</header>
			<div class="row">