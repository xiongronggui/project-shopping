<?php
	require_once 'include/common.php';
	require_once (ADMIN_CLASS_DIR."AdminClass.class.php");

	$admin = new AdminClass;

	$a = _g('op');
	switch ($a)
	{
		case 'add':
				$adminGroupList = $admin->adminGroupList();
				$tpl->assign("result", $adminGroupList);
				$tpl->display("admin_add.html");
			break;
		case 'del':
				$id = _g('id');
				$admin->adminDel($id);
			break;
		case 'update':
				$id = _g('id');
				$adminInfo = $admin->adminGetInfo($id);
				$adminGroupList = $admin->adminGroupList();
				$tpl->assign("info", $adminInfo);
				$tpl->assign("result", $adminGroupList);
				$tpl->display("admin_update.html");
			break;
		case 'password':
				$tpl->assign("id", $_SESSION['admin']['id']);
				$tpl->display("admin_password.html");
			break;
		case 'save':
				$t = _g('t');
				$password = _g('password');
				$group_id = _g('group_id');
				$realname = _g('realname');
				$status = _g('status');

				if ($t == 'add')
				{
					$username = _g('username');
					$admin->adminAdd($username, $password, $group_id, $realname, $status);
				}
				else if ($t == 'update')
				{
					$id = _g('id');
					$admin->adminUpdate($id, $password, $group_id, $realname, $status);
				}
				else if ($t == 'reset')
				{
					$id = _g('id');
					$admin->adminResetPassword($id);
				}
				else if ($t == 'status')
				{
					$id = _g('id');
					$admin->adminModifyStatus($id);
				}
			break;
		default:
				$adminList = $admin->adminList();
				$tpl->assign("result", $adminList);
				$tpl->display("admin_list.html");
			break;
	}
?>