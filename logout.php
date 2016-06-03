<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; ?>
<?php
$user = new User();
$user->logout();

Redirect::to('/');
?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php';?>