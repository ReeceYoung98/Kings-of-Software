<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; ?>
<?php

if(!$user = Input::get('user')){
	Redirect::to('/');
}else{
	$user = new User($user);
	if(!$user->exists()){
		Redirect::to(404);
	}else{
		$data = $user->data();
	}
}

?>
	<h3>Student <?php echo escape($data->Id); ?></h3>
	<p><?php echo escape($data->Forename); ?> <?php echo escape($data->Surname); ?></p>
<?php 
?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php';?>
