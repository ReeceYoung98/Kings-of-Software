<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; ?>
<?php

if(Input::exists()) {
	if(Token::check(Input::get('token'))){
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'id' => array(
				'required' => true,
				'min' => 7,
				'max' => 11,
				'unique' => 'users'
			),
			'forename' => array(
				'required' => true,
				'min' => 2,
				'max' => 25
			),
			'surname' => array(
				'required' => true,
				'min' => 2,
				'max' => 25
			),
			'password' => array(
				'required' => true,
				'min' => 8
			),
			'passwordConfirm' => array(
				'required' => true,
				'matches' => 'password'
			)
		));

		if($validation->passed()){
			$user = new User();

			$salt = Hash::salt(32);

			try{
				$user->create(array(
					'Id' => Input::get('id'),
					'Password' => Hash::make(Input::get('password'), $salt),
					'Salt' => $salt,
					'Forename' => Input::get('forename'),
					'Surname' => Input::get('surname'),
					'Joined' => date('Y-m-d H:i:s'),
					'Group' => 2
				));

				Session::flash('home', 'You have been registered and can now login.');
				Redirect::to('/');

			}catch(Exception $e){
				die($e->getMessage());
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
		<h2 class="form-signin-heading">Please register</h2>
		
		<div class="form-group">
			<label for="inputId" class="sr-only">Student Id</label>
			<input type="id" id="inputId" class="form-control" placeholder="Student Id" name="id" value="<?php echo escape(Input::get('id')); ?>" required autofocus>
		</div>
		
		<div class="form-group">
			<label for="inputForename" class="sr-only">Forename</label>
			<input type="id" id="inputForename" class="form-control" placeholder="Forename" name="forename" value="<?php echo escape(Input::get('forename')); ?>" required>
		</div>
		
		<div class="form-group">
			<label for="inputSurname" class="sr-only">Surname</label>
			<input type="id" id="inputSurname" class="form-control" placeholder="Surname" name="surname" value="<?php echo escape(Input::get('surname')); ?>" required>
		</div>

		<div class="form-group">
			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
		</div>

		<div class="form-group">
			<label for="inputPasswordConfirm" class="sr-only">Confirm Password</label>
			<input type="password" id="inputPasswordConfirm" class="form-control" name="passwordConfirm" placeholder="Confirm Password" required>
		</div>

		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
		<button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
	</form>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php';?>
