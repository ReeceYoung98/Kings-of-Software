<?php
include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php';
include $_SERVER['DOCUMENT_ROOT'].'/core/init.php';

if (empty($_POST) === false){
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (empty($username) || empty($password)){
		$errors[] = 'You need to enter a username and password.';
	}elseif(user_exists($username) === false){
		$errors[] = 'We can\'t find that username. Have you registered?';
	}elseif(user_active($username) === false){
		$errors[] = 'Your account has been suspended.';
	}else{
		$login = login($username, $password);
		if($login === false){
			$errors[] = 'That username/password combination is incorrect.';
		}else{
			$_SESSION['userid'] = $login;
			header('Location: index.php');
			exit();
		}
	}

	print_r($errors);
}
include $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php';
?>