<?php
$server = array(
	'host' => $_SERVER['HTTP_HOST'],
	'name' => $_SERVER['SERVER_NAME'],
	'connection' => $_SERVER['HTTP_CONNECTION'],
	'agnet' => $_SERVER['HTTP_USER_AGENT'],
	'ip' => $_SERVER['REMOTE_ADDR']

);
var_dump($server);
phpinfo();
?>