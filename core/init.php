<?php 
if(!isset($_SESSION)){
	session_start();
}

date_default_timezone_set('Europe/London');

$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => '127.0.0.1',
		'port' => '3306', //8889
		'username' => 'KingsofSoftware', //aws
		'password' => 'G29MMsv9yUqa7rFN', //ApAjfbBtx9DcCpeN
		'db' => 'KingsofSoftware'
	),
	'remember' => array(
		'cookie_name' => 'hash',
		'cookie_expiry' => 604800
	),
	'session' => array(
		'session_name' => 'user',
		'token_name' => 'token'
	)
);

spl_autoload_register(function($class){
	require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/' . $class . '.php';
});

require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/sanitize.php';

if (Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))) {
	$hash = Cookie::get(Config::get('remember/cookie_name'));
	$hashCheck = DB::getInstance()->get('users_sessions', array('Hash', '=', $hash));

	if ($hashCheck->count()) {
		$user = new User($hashCheck->first()->UserId);
		$user->login();
	}
}
