<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php';?>
<body bgcolor="#FA6607">
<div class="col-md-6 col-md-offset-3">
	<form>
		<h2 class="form-signin-heading">Please sign in</h2>
		
		<div class="form-group">
			<label for="inputEmail" class="sr-only">Email address</label>
			<input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
		</div>

		<div class="form-group">
			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
		</div>

		<div class="checkbox">
			<label>
				<input type="checkbox" value="remember-me"> Remember me
			</label>
		</div>

		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
	</form>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php';?>
