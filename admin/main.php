<?php
	require_once 'include/common.php';
	require_once (ADMIN_CLASS_DIR."AdminClass.class.php");

	$admin = new AdminClass;
	$tpl -> assign('server_name',$server_name[$_SERVER['HTTP_HOST']]);
	$tpl->display("main.html");
?>