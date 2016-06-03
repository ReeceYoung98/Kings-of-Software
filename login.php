<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; ?>
<?php

if(Input::exists()){
	if(Token::check(Input::get('token'))){
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'id' => array(
				'required' => true,
				'min' => 7,
				'max' => 11,
			),			
			'password' => array(
				'required' => true,
				'min' => 8
			)
		));

		if($validation->passed()){
			$user = new User();

			$remember = (Input::get('remember') === 'on') ? true : false;
			$login = $user->login(Input::get('id'), Input::get('password'), $remember);

			if($login){
				Redirect::to('/');
			}else{
				echo 'Sorry, logging in failed.';
			}
		}else{
			foreach($validation->errors() as $error){
				echo $error, '<br />';
			}
		}
	}
}
?>
<div class="col-md-6 col-md-offset-3">
	<form action="" method="POST">
		<h2 class="form-signin-heading">Please sign in</h2>
		
		<div class="form-group">
			<label for="inputId" class="sr-only">Student Id</label>
			<input type="id" id="inputId" class="form-control" placeholder="Student Id" name="id" value="<?php echo escape(Input::get('id')); ?>" required autofocus>
		</div>

		<div class="form-group">
			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
		</div>

		<div class="checkbox">
			<label for="remember">
				<input type="checkbox" name="remember" id="remember"> Remember me
			</label>
		</div>

		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
	</form>
</div>