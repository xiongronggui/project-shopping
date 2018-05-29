<?php
	require_once 'include/common.php';
	require_once (ADMIN_CLASS_DIR."LoginClass.class.php");

	$login = new LoginClass;

	$a = _g('op');
	switch ($a)
	{
		case 'login':
				$username = _g('username');
				$password = _g('password');
				$login->login($username, $password);
			break;
		case 'logout':
				$login->logout();
			break;
		default:
				$tpl -> assign('server_name',$server_name[$_SERVER['HTTP_HOST']]);
				$tpl->display('index.html');
			break;
	}
?>