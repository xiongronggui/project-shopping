<?php
	require_once 'BaseClass.class.php';

	class AdminClass extends BaseClass
	{
		/**************管理员管理**************/
		//管理员添加
		function adminAdd($username, $password, $group_id, $realname, $status='0')
		{
			global $db;
			if ($username && $password && $group_id && $realname)
			{
				$status = $status ? $status : 0;
				$sqls = "select * from core_admin where username = '$username'";
				$results = $db->query($sqls) or die($db->error());
				$nums = $db->num_rows($results);
				if ($nums == 0)
				{
					$password = md5($password);
					$addtime = time();
					$sql = "insert into core_admin (username, password, group_id, realname, `addtime`,  `status`) values ('$username', '$password', $group_id, '$realname', $addtime, $status)";
					$result = $db->query($sql) or die($db->error());
					if ($result)
					{
						$this->gotoUrl("添加成功！", "admin.php"); 
					}
					else
					{
						$this->gotoUrl("添加失败！");
					}
				}
				else
				{
					$this->gotoUrl("该用户名已经存在！");
				}
			}
			else
			{
				$this->gotoUrl("请确认信息是否完整！");
			}
		}

		//管理员删除
		function adminDel($id)
		{
			global $db;
			$sql = "delete from core_admin where id = $id";
			$result = $db->query($sql) or die($db->error());
			if($result)
			{
				$this->gotoUrl("删除成功！");
			}
			else
			{
				$this->gotoUrl("删除失败！");
			}
		}

		//管理员修改
		function adminUpdate($id, $password='', $group_id, $realname, $status='0')
		{
			global $db;
			if ($id && $group_id && $realname)
			{
				$status = $status ? $status : 0;
				$sql = "update core_admin set group_id = $group_id, realname = '$realname', `status` = $status where id = $id";
				$result = $db->query($sql) or die($db->error());

				if ($password)
				{
					$password = md5($password);
					$sqls = "update core_admin set password = '$password' where id = $id";
					$results = $db->query($sqls) or die($db->error());
				}

				if ($result)
				{
					$this->goToUrl("修改成功！", "admin.php"); 
				}
				else
				{
					$this->gotoUrl("修改失败！");
				}
			}
			else
			{
				$this->gotoUrl("请确认信息是否完整！");
			}
		}

		//管理员查看
		function adminList()
		{
			global $db;
			$sql = "select core_admin.*, core_admin_group.group from core_admin inner join core_admin_group on core_admin.group_id = core_admin_group.id order by core_admin.id";
			$result = $db->query($sql) or die($db->error());
			while ($rs = $db->fetch_array($result))
			{
				if ($rs['status'] == 0)
				{
					$status = "正常";
				}
				else
				{
					$status = "停用";
				}
				$rs_result[] = array("id" => $rs['id'], "realname" => $rs['realname'], "username" => $rs['username'], "group_id" => $rs['group_id'], "group" => $rs['group'], "addtime" => date("Y-m-d H:i:s", $rs['addtime']), "status" => $status); 
			}
			$db->free_result($result);
			return $rs_result;
		}
		
		//管理员状态变更
		function adminModifyStatus($id)
		{
			global $db;
			$sql="update core_admin set `status` = (`status`+1)%2 where id = $id";
			$result = $db->query($sql) or die($db->error());
			if ($result)
			{
				$this->goToUrl("状态改变成功！", "admin.php");
			}
			else
			{
				$this->gotoUrl("状态改变失败！");
			}
		}

		//管理员密码修改
		function adminModifyPassword($id, $oldPassword, $newPassword, $verifyPassword)
		{
			global $db;
			if ($id && $oldPassword && $newPassword && $verifyPassword)
			{
				if($newPassword == $verifyPassword)
				{
					$oldPassword = md5($oldPassword);
					$sqlold = "select * from core_admin where id = $id and password = '$oldPassword'";
					$resultold = $db->query($sqlold) or die($db->error());
					$num = $db->num_rows($resultold);
					if($num > 0)
					{
						$newPassword = md5($newPassword);
						$sql = "update core_admin set password = '$newPassword' where id = $id";
						$result = $db->query($sql) or die($db->error());
						if ($result)
						{
							$this->goToUrl("密码修改成功！");
						}
						else
						{
							$this->gotoUrl("密码修改失败！");
						}
					}
					else
					{
						$this->gotoUrl("原密码输入错误！");    
					}
				}
				else
				{
					$this->gotoUrl("两次密码不一致！");
				}
			}
			else
			{
				$this->gotoUrl("请输入完整信息！");
			}
		}

		//管理员密码重置
		function adminResetPassword($id, $newPassword='123456')
		{
			global $db;
			$newPassword = $newPassword ? $newPassword : '123456';
			$newPassword = md5($newPassword);
			$sql = "update core_admin set password = '$newPassword' where id = $id";
			$result = $db->query($sql) or die($db->error());
			if ($result)
			{
				$this->goToUrl("密码重置成功，默认密码为123456！", "admin.php");
			}
			else
			{
				$this->gotoUrl("密码重置失败！");
			}
		}
		
		//管理员详细信息
		function adminGetInfo($id)
		{
			global $db;
			$sql = "select * from core_admin where id = $id";
			$result = $db->query($sql) or die($db->error());
			$rs = $db->fetch_array($result);
			$rs_result = array("id" => $rs['id'], "username" => $rs['username'], "group_id" => $rs['group_id'], "realname" => $rs['realname'], "status" => $rs['status']); 
			return $rs_result;
		}

		/**************用户组管理**************/
		//用户组添加
		function adminGroupAdd($group, $action)
		{
			global $db;
			if ($group && $action)
			{
				$aid = implode("|", $action);
				$sqls = "select * from core_admin_group where `group` = '$group'";
				$results = $db->query($sqls) or die($db->error());
				$nums = $db->num_rows($results);
				if ($nums == 0)
				{
					$sql = "insert into core_admin_group (`group`, aid) values ('$group', '$aid')";
					$result = $db->query($sql) or die($db->error());
					if ($result)
					{
						$this->goToUrl("添加成功！", "admin_group.php"); 
					}
					else
					{
						$this->gotoUrl("添加失败！");
					}
				}
				else
				{
					$this->gotoUrl("该用户组已经存在！");
				}
			}
			else
			{
				$this->gotoUrl("请确认信息是否完整！");
			}
		}

		//用户组删除
		function adminGroupDel($id)
		{
			global $db;
			$sqlc = "select * from core_admin where group_id = $id";
			$resultc = $db->query($sqlc) or die($db->error());
			$numc = $db->num_rows($resultc);
			if ($numc == 0)
			{
				$sql="delete from core_admin_group where id = $id";
				$result= $db->query($sql) or die($db->error());
				if($result)
				{
					$this->gotoUrl("删除成功！");
				}
				else
				{
					$this->gotoUrl("删除失败！");
				}
			}
			else
			{
				$this->gotoUrl("删除失败，该用户组正在使用！");
			}
		}

		//用户组修改
		function adminGroupUpdate($id, $group, $action)
		{
			global $db;
			if ($group && $action)
			{
				$aid = implode("|", $action);
				$sqls = "select * from core_admin_group where `group` = '$group' and id <> $id";
				$results = $db->query($sqls) or die($db->error());
				$nums = $db->num_rows($results);
				if ($nums == 0)
				{
					$sql = "update core_admin_group set `group` = '$group', aid = '$aid' where id = $id";
					$result = $db->query($sql) or die($db->error());
					if ($result)
					{
						$this->goToUrl("修改成功！", "admin_group.php"); 
					}
					else
					{
						$this->gotoUrl("修改失败！");
					}
				}
				else
				{
					$this->gotoUrl("该用户组已经存在！");
				}
			}
			else
			{
				$this->gotoUrl("请确认信息是否完整！");
			}
		}

		//用户组查看
		function adminGroupList()
		{
			global $db;
			$sql = "select * from core_admin_group order by id";
			$result = $db->query($sql) or die($db->error());
			while ($rs = $db->fetch_array($result))
			{
				$rs_result[] = $rs; 
			}
			$db->free_result($result);
			return $rs_result;
		}

		//用户组详细信息
		function adminGroupGetInfo($id)
		{
			global $db;
			$sql = "select * from core_admin_group where id = $id";
			$result = $db->query($sql) or die($db->error());
			$rs = $db->fetch_array($result);
			$rs_result = array("id" => $rs['id'], "group" => $rs['group'], "aid" => $rs['aid']); 
			return $rs_result;
		}

		//权限添加
		function adminActionAdd($title, $url, $fid='0', $index='0')
		{
			global $db;
			if ($fid)
			{
				if (!$url)
				{
					$this->gotoUrl("请确认信息是否完整！");
				}
			}

			if ($title)
			{
				$sql = "insert into core_admin_action ( title, url, fid, `index`) values ('$title', '$url', $fid, $index)";
				$result = $db->query($sql) or die($db->error());
				if ($result)
				{
					$this->goToUrl("添加成功！", "admin_action.php"); 
				}
				else
				{
					$this->gotoUrl("添加失败！");
				}
			}
			else
			{
				$this->gotoUrl("请确认信息是否完整！");
			}
		}

		//权限删除
		function adminActionDel($id)
		{
			global $db;

			$sqls = "select * from core_admin_action where fid = $id";
			$results = $db->query($sqls) or die($db->error());
			$nums = $db->num_rows($results);
			if ($nums == 0)
			{
				$sql = "delete from core_admin_action where id = $id";
				$result = $db->query($sql) or die($db->error());
				if($result)
				{
					$this->gotoUrl("删除成功！");
				}
				else
				{
					$this->gotoUrl("删除失败！");
				}
			}
			else
			{
				$this->gotoUrl("删除失败，节点正在被使用！");
			}
		}

		//权限修改
		function adminActionUpdate($id, $title, $url, $fid='0', $index='0')
		{
			global $db;
			$fid = $fid ? $fid : 0;
			$index = $index ? $index : 0;
			if ($fid)
			{
				if (!$url)
				{
					$this->gotoUrl("请确认信息是否完整！");
				}
			}

			if ($id && $title)
			{
				$sql = "update core_admin_action set title = '$title', url = '$url', fid = $fid, `index` = $index where id = $id";
				$result = $db->query($sql) or die($db->error());
				if ($result)
				{
					$this->goToUrl("修改成功！", "admin_action.php"); 
				}
				else
				{
					$this->gotoUrl("修改失败！");
				}
			}
			else
			{
				$this->gotoUrl("请确认信息是否完整！");
			}
		}

		//权限列表
		function adminActionList()
		{
			global $db;
			$sql = "select a.*, b.title as btitle from core_admin_action as a left join core_admin_action as b on a.fid = b.id order by a.id";
			$result = $db->query($sql) or die($db->error());
			while ($rs = $db->fetch_array($result))
			{
				if ($rs['status'] == 0)
				{
					$rs['status_show'] = "显示";
				}
				else
				{
					$rs['status_show'] = "隐藏";
				}
				$rs_result[] = $rs;
			}
			$db->free_result($result);
			return $rs_result;
		}

		//权限查看详情
		function adminActionGetInfo($id)
		{
			global $db;
			$sql = "select * from core_admin_action where id = $id";
			$result = $db->query($sql) or die($db->error());
			$rs = $db->fetch_array($result);
			return $rs;
		}

		//管理员状态变更
		function adminActionModifyStatus($id)
		{
			global $db;
			$sql="update core_admin_action set `status` = (`status`+1)%2 where id = $id";
			$result = $db->query($sql) or die($db->error());
			if ($result)
			{
				$this->goToUrl("权限状态改变成功！", "admin_action.php");
			}
			else
			{
				$this->gotoUrl("权限状态改变失败！");
			}
		}

		//权限父节点列表
		function adminActionFidList($id='0')
		{
			global $db;
			$id = $id ? $id : 0;
			if ($id)
			{
				$remove = "and id <> ".$id;
			}
			$sql = "select * from core_admin_action where fid = 0 ".$remove." order by id";
			$result = $db->query($sql) or die($db->error());
			$rs_result[0]['id'] =0;
			$rs_result[0]['title'] ='顶级节点';
			while ($rs = $db->fetch_array($result))
			{
				$rs_result[] = array("id" => $rs['id'], "title" => $rs['title']); 
			}
			$db->free_result($result);
			return $rs_result;
		}

		//权限树
		function adminActionTreeList($aid='')
		{
			global $db;
			$action = explode("|", $aid);
			$sql = "select * from core_admin_action where fid = 0 order by `index` desc, id";
			$result = $db->query($sql) or die($db->error());
			while ($rs = $db->fetch_array($result))
			{
				$rss_result = "";
				$sqls = "select * from core_admin_action where fid = ".$rs['id']." order by `index` desc, id";
				$results = $db->query($sqls) or die($db->error());
				while ($rss = $db->fetch_array($results))
				{
					if (in_array($rss['id'], $action))
					{
						$checked = "checked";
					}
					else
					{
						$checked = "";
					}
					$rss['checked'] = $checked;
					$rss_result[] = $rss;
				}
				$rs['son'] = $rss_result;
				$rs_result[] = $rs; 
			}
			$db->free_result($result);
			return $rs_result;
		}
	}
?>