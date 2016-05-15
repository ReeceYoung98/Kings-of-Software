<?php 
function sanitize($data){
	return mysql_real_escape_string($data);
}
?>