<?php
	require_once 'include/common.php';
	require_once (ADMIN_CLASS_DIR."AdminClass.class.php");

	$admin = new AdminClass;

	$a = _g('op');
	switch ($a)
	{
		case 'add':
				$adminActionFidList = $admin->adminActionFidList();
				$tpl->assign("result", $adminActionFidList);

				for ($i = 0; $i < 10; $i++)
				{
					$index_arr[$i] = $i;
				}
				$tpl->assign("results", $index_arr);

				$tpl->display("admin_action_add.html");
			break;
		case 'del':
				$id = _g('id');
				$admin->adminActionDel($id);
			break;
		case 'update':
				$id = _g('id');
				$adminActionGetInfo = $admin->adminActionGetInfo($id);
				$adminActionFidList = $admin->adminActionFidList($id);
				$tpl->assign("result", $adminActionFidList);
				$tpl->assign("info", $adminActionGetInfo);

				for ($i = 0; $i < 10; $i++)
				{
					$index_arr[$i] = $i;
				}
				$tpl->assign("results", $index_arr);

				$tpl->display("admin_action_update.html");
			break;
		case 'save':
				$t = _g('t');
				$title = _g('title');
				$url = _g('url');
				$fid = _g('fid');
				$index = _g('index');

				if ($fid == 0)
				{
					$url = "";
				}
		
				if ($t == 'add')
				{
					$admin->adminActionAdd($title, $url, $fid, $index);
				}
				else if ($t == 'update')
				{
					$id = _g('id');
					$admin->adminActionUpdate($id, $title, $url, $fid, $index);
				}
				else if ($t == 'status')
				{
					$id = _g('id');
					$admin->adminActionModifyStatus($id);
				}
			break;
		default:
				$adminActionList = $admin->adminActionList();
				//echo "<pre>";
				//print_r($adminActionList);
				$tpl->assign("result", $adminActionList);
				$tpl -> assign('server_name',$server_name[$_SERVER['HTTP_HOST']]);
				$tpl->display("admin_action_list.html");
			break;
	}
?>