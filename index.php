<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php';?>
<div class="col-md-6 col-md-offset-3">
	<?php 
	if (logged_in() === true){
		echo 'Logged in. <a href=\'logout.php\'>Log out</a>';
	}else{
	?>
	<form action="login.php" method="POST">
		<h2 class="form-signin-heading">Please sign in</h2>
		
		<div class="form-group">
			<label for="inputUsername" class="sr-only">Email address</label>
			<input type="username" id="inputUsername" class="form-control" placeholder="Username" name="username" required autofocus>
		</div>

		<div class="form-group">
			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
		</div>

		<div class="checkbox">
			<label>
				<input type="checkbox" value="remember-me"> Remember me
			</label>
		</div>

		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
	</form>
	<?php } ?>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php';?>
