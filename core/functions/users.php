<?php 
function logged_in(){
	return (isset($_SESSION['userid'])) ? true: false;
}

function user_exists($username){
	$username = sanitize($username);
	return (mysql_result(mysql_query("SELECT COUNT(`username`) FROM `users` WHERE `username` = '$username'"), 0) == 1) ? true : false;
}

function user_active($username){
	$username = sanitize($username);
	return (mysql_result(mysql_query("SELECT COUNT(`username`) FROM `users` WHERE `username` = '$username' AND `active` = '1'"), 0) == 1) ? true : false;
}

function userid_from_username($username){
	$username = sanitize($username);
	return mysql_result(mysql_query("SELECT `userId` FROM `users` WHERE `username` = '$username'"), 0, 'userId');
}

function login($username, $password){
	$userid = userid_from_username($username);

	$username = sanitize($username);
	$password = md5($password);

	return (mysql_result(mysql_query("SELECT COUNT(`userId) FROM `users` WHERE `username` = '$username' AND `password` = '$password'"), 0) == 1) ? $userid : false;
}
?>