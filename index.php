<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; ?>
<?php

if(Session::exists('home')){
	echo '<p>' . Session::flash('home') . '</p>';
}

$user = new User();
if ($user->isLoggedIn()) {
?>
<p>Hello <a href='/profile.php?user=<?php echo escape($user->data()->Id) ?>'><?php echo escape($user->data()->Forename) . ' ' . escape($user->data()->Surname); ?></a>.</p>
<ul>
	<li><a href='/update.php'>Update details</a></li>
	<li><a href='/changePassword.php'>Change password</a></li>
	<li><a href='/logout.php'>Logout</a></li>
</ul>
<?php
	if($user->hasPermission('admin')){
		echo '<p>You are an admin.</p>';
	}

}else{
	echo 'You need to <a href="/login.php">login</a> or <a href="/register.php">register</a>.';
}

?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php';?>
