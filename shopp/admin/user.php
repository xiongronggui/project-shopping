<?php
	require_once 'include/common.php';
	require_once (ADMIN_CLASS_DIR."UserClass.class.php");

	$user = new UserClass;

	$a = _g('op');
	switch ($a)
	{
		case 'update':
				$id = _g('id');
				$userInfo = $user->userGetInfo($id);
				$tpl->assign("info", $userInfo);
				$tpl->display("user_update.html");
			break;
		case 'save':
				$t = _g('t');
				$password = _g('password');
				$group_id = _g('group_id');
				$realname = _g('realname');
				$status = _g('status');

				if ($t == 'update')
				{
					$id = _g('id');
					$user->userUpdate($id, $people_id, $realname, $status);
				}
				else if ($t == 'reset')
				{
					$id = _g('id');
					$user->userResetPassword($id);
				}
				else if ($t == 'status')
				{
					$id = _g('id');
					$user->userModifyStatus($id);
				}
			break;
		default:
				$userList = $user->userList();
				$tpl->assign("result", $userList);
				$tpl->display("user_list.html");
			break;
	}
?>