<?php
	require_once 'include/common.php';
	require_once (ADMIN_CLASS_DIR."AdminClass.class.php");

	$admin = new AdminClass;

	$a = _g('op');
	switch ($a)
	{
		case 'add':
				$adminActionTreeList = $admin->adminActionTreeList();
				$tpl->assign("result", $adminActionTreeList);
				$tpl->display("admin_group_add.html");
			break;
		case 'del':
				$id = _g('id');
				$admin->adminGroupDel($id);
			break;
		case 'update':
				$id = _g('id');
				$adminGroupInfo = $admin->adminGroupGetInfo($id);
				$adminActionTreeList = $admin->adminActionTreeList($adminGroupInfo['aid']);
				$tpl->assign("groupInfo", $adminGroupInfo);
				$tpl->assign("result", $adminActionTreeList);
				$tpl->display("admin_group_update.html");
			break;
		case 'save':
				$t = _g('t');
				$group = _g('group');
				$action = $_POST['action'];
				if ($t == 'add')
				{
					$admin->adminGroupAdd($group, $action);
				}
				else if ($t == 'update')
				{
					$id = _g('id');
					$admin->adminGroupUpdate($id, $group, $action);
				}
			break;
		default:
				$adminGroupList = $admin->adminGroupList();
				$tpl->assign("result", $adminGroupList);
				$tpl->display("admin_group_list.html");
			break;
	}
?>