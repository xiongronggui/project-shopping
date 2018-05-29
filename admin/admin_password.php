<?php
	require_once 'include/common.php';
	require_once (ADMIN_CLASS_DIR."AdminClass.class.php");

	$admin = new AdminClass;

	$a = _g('op');
	switch ($a)
	{
		case 'save':
				$id = _g('id');
				$oldPassword = _g('oldPassword');
				$newPassword = _g('newPassword');
				$verifyPassword = _g('verifyPassword');
				$admin->adminModifyPassword($id, $oldPassword, $newPassword, $verifyPassword);
		default:
				$tpl->assign("id", $_SESSION['admin']['info']['id']);
				$tpl -> assign('server_name',$server_name[$_SERVER['HTTP_HOST']]);
				$tpl->display("admin_password.html");
			break;
	}
?>