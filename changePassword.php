<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; ?>

<?php

$user = new User();

if(!$user->isLoggedIn()){
	Redirect::to('/');
}

if(Input::exists()){
	if(Token::check(Input::get('token'))){
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'password' => array(
				'required' => true,
				'min' => 8
			),
			'newPassword' => array(
				'required' => true,
				'min' => 8
			),
			'newPasswordConfirm' => array(
				'required' => true,
				'matches' => 'password'
			)
		));

		if($validation->passed()){
			if(Hash::make(Input::get('password'), $user->data()->Salt) !== $user->data()->Password){
				echo 'Your current password is wrong.';
			}else{
				$salt = Hash::salt(32);
				try{
					$user->update(array(
						'Password' => Hash::make(Input::get('newPassword'), $salt),
						'Salt' => $salt,
					));

					Session::flash('home', 'Your password has been updated.');
					Redirect::to('/');

				}catch(Exception $e){
					die($e->getMessage());
				}
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
		<h2 class="form-signin-heading">Update password</h2>

		<div class="form-group">
			<label for="inputCurrentPassword" class="sr-only">Current Password</label>
			<input type="password" id="inputCurrentPassword" class="form-control" name="password" placeholder="Current Password" required>
		</div>

		<div class="form-group">
			<label for="inputNewPassword" class="sr-only">New Password</label>
			<input type="password" id="inputNewPassword" class="form-control" name="newPassword" placeholder="New Password" required>
		</div>

		<div class="form-group">
			<label for="inputNewPasswordConfirm" class="sr-only">Confirm New Password</label>
			<input type="password" id="inputNewPasswordConfirm" class="form-control" name="newPasswordConfirm" placeholder="Confirm New Password" required>
		</div>

		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
		<button class="btn btn-lg btn-primary btn-block" type="submit">Update</button>
	</form>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php';?>
