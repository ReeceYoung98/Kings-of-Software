<?php 
function logged_in(){
	return (isset($_SESSION['userid'])) ? true: false;
}

function user_exists($username){
	$username = sanitize($username);
	return (mysql_result(mysql_query("SELECT COUNT(`Username`) FROM `Users` WHERE `Username` = '$username'"), 0) == 1) ? true : false;
}

function user_active($username){
	$username = sanitize($username);
	return (mysql_result(mysql_query("SELECT COUNT(`Username`) FROM `Users` WHERE `Username` = '$username' AND `Active` = '1'"), 0) == 1) ? true : false;
}

function userid_from_username($username){
	$username = sanitize($username);
	return mysql_result(mysql_query("SELECT `UserId` FROM `Users` WHERE `Username` = '$username'"), 0, 'UserId');
}

function login($username, $password){
	$userid = userid_from_username($username);

	$username = sanitize($username);
	$password = md5($password);

	return (mysql_result(mysql_query("SELECT COUNT(`UserId) FROM `Users` WHERE `Username` = '$username' AND `Password` = '$password'"), 0) == 1) ? $userid : false;
}
?>