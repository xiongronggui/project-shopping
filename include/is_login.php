<?php
	//判断是否登录
	$current_url = $_SERVER['PHP_SELF'];
	$current_page = end(explode("/", $current_url));
	$current_file = substr($current_page, 0, strrpos($current_page, '.'));

	if ($current_file != 'index' && $current_file != 'login')
	{
		if(!isset($_SESSION['soong_admin']) || $_SESSION['soong_admin'] == '' || !isset($_SESSION['soong_admin_id']) || $_SESSION['soong_admin_id'] == '' || !isset($_SESSION['soong_action']) || $_SESSION['soong_action'] == '')
		{
			die("<script>window.location.href = 'index.php'; alert('请登录！');</script>");
		}
	}
?>