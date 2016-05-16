<?php 
session_start();
error_reporting(E_ERROR);

require('database/connect.php');
require('functions/general.php');
require('functions/users.php');

$errors = array();

?>