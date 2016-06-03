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
			'forename' => array(
				'required' => true,
				'min' => 2,
				'max' => 25
			),
			'surname' => array(
				'required' => true,
				'min' => 2,
				'max' => 25
			)
		));

		if($validation->passed()){
			try{
				$user->update(array(
					'Forename' => Input::get('forename'),
					'Surname' => Input::get('surname')
				));

				Session::flash('home', 'Your details have been updated.');
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
		<h2 class="form-signin-heading">Update details</h2>
		
		<div class="form-group">
			<label for="inputForename" class="sr-only">Forename</label>
			<input type="id" id="inputForename" class="form-control" placeholder="Forename" name="forename" value="<?php echo escape($user->data()->Forename); ?>" required>
		</div>
		
		<div class="form-group">
			<label for="inputSurname" class="sr-only">Surname</label>
			<input type="id" id="inputSurname" class="form-control" placeholder="Surname" name="surname" value="<?php echo escape($user->data()->Surname); ?>" required>
		</div>

		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
		<button class="btn btn-lg btn-primary btn-block" type="submit">Update</button>
	</form>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php';?>
