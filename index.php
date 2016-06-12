<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; ?>
<?php

$user = new User();
if ($user->isLoggedIn()) {

	if(Session::exists('home')){
		echo '<h2>' . Session::flash('home') . '</h2>';
	}
	?>

	<h3>Hello <a href='/profile.php?user=<?php echo escape($user->data()->Id) ?>'><?php echo escape($user->data()->Forename) . ' ' . escape($user->data()->Surname); echo '</a>'; if($user->hasPermission('admin')){echo ' (admin)';}?>.</h3>
	<p>Please select an option from the following:</p>
	<ul>
		<li><a href='/profile.php?user=<?php echo escape($user->data()->Id) ?>'>View purchase history</a></li>
		<li><a href='/update.php'>Update details</a></li>
		<li><a href='/changePassword.php'>Change password (account function)</a></li>
		<li><a href='/logout.php'>Logout</a></li>
	</ul>

	<?php
		

	}else{
	?>
	<h2>
	<br /><br /><br />
		You need to <a href="/login.php">login</a> or <a href="/register.php">register</a> to view purchase history.
	</h2>
	<?php
}

?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php';?>
