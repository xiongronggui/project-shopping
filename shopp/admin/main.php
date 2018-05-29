<?php
	require_once 'include/common.php';
	require_once (ADMIN_CLASS_DIR."AdminClass.class.php");

	$admin = new AdminClass;

	$tpl->display("main.html");
?>