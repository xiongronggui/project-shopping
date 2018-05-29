<?php
	require_once 'BaseClass.class.php';

	class UserClass extends BaseClass
	{
		//用户修改
		function userUpdate($id, $people_id, $realname, $status='0')
		{
			global $db;
			if ($id && $people_id && $realname)
			{
				$status = $status ? $status : 0;
				$sql = "update core_user set realname = '$realname', people_id ='$people_id', `status` = $status where id = $id";
				$result = $db->query($sql) or die($db->error());
				if ($result)
				{
					$this->goToUrl("修改成功！", "user.php"); 
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

		//用户查看
		function userList()
		{
			global $db;
			$sql = "select * from core_user order by id desc";
			$result = $db->query($sql) or die($db->error());
			while ($rs = $db->fetch_array($result))
			{
				if ($rs['status'] == 0)
				{
					$rs['status_show'] = "正常";
				}
				else
				{
					$rs['status_show'] = "停用";
				}

				$rs['addtime_show'] = date("Y-m-d H:i:s", $rs['addtime']);

				if (strlen($rs['people_id']) == 18)
				{
					if (substr($rs['people_id'], -2, 1) % 2 == 1)
					{
						$rs['gender'] = "男";
					}
					else
					{
						$rs['gender'] = "女";
					}
				}
				else if (strlen($rs['people_id']) == 15)
				{
					if (substr($rs['people_id'], -1, 1) % 2 == 1)
					{
						$rs['gender'] = "男";
					}
					else
					{
						$rs['gender'] = "女";
					}
				}
				else
				{
					$rs['gender'] = "未知";
				}
				$rs_result[] = $rs;
			}
			$db->free_result($result);
			return $rs_result;
		}
		
		//用户状态变更
		function userModifyStatus($id)
		{
			global $db;
			$sql="update core_user set `status` = (`status`+1)%2 where id = $id";
			$result = $db->query($sql) or die($db->error());
			if ($result)
			{
				$this->goToUrl("状态改变成功！", "user.php");
			}
			else
			{
				$this->gotoUrl("状态改变失败！");
			}
		}

		//用户密码重置
		function userResetPassword($id)
		{
			global $db;
			$newPassword = md5("123456");
			$sql = "update core_user set password = '$newPassword' where id = $id";
			$result = $db->query($sql) or die($db->error());
			if ($result)
			{
				$this->goToUrl("密码重置成功，默认密码为123456！", "user.php");
			}
			else
			{
				$this->gotoUrl("密码重置失败！");
			}
		}
		
		//用户充值验证码更新
		function userResetCode($mobile, $type_id)
		{
			global $db;

			if ($mobile)
			{
				$sqlu = "select * from core_user where mobile = '$mobile' and status = 0";
				$resultu = $db->query($sqlu) or die($db->error());
				$numu = $db->num_rows($resultu);
				if ($numu || $type_id == 1)
				{
					$time = time();
					$code = rand(100000, 999999);
					$sqls = "select * from core_user_sms where type_id = $type_id and mobile = '$mobile'";
					$results = $db->query($sqls) or die($db->error());
					$nums = $db->num_rows($results);
					if ($nums)
					{
						$sql = "update core_user_sms set code = '$code', sendtime = '$time' where type_id = $type_id and mobile = '$mobile'";
					}
					else
					{
						$sql = "insert into core_user_sms (type_id, mobile, code, sendtime) values ($type_id, '$mobile', '$code', '$time')"; 
					}
					$result = $db->query($sql) or die($db->error());
					if ($result)
					{
						$this->goToUrl("用户验证码更新成功，验证码为【" . $code. "】，有效期10分钟！", "user_reset_code.php");
					}
					else
					{
						$this->gotoUrl("用户验证码更新失败！");
					}
				}
				else
				{
					$this->gotoUrl("该手机号未注册或被停封！");
				}
			}
			else
			{
				$this->gotoUrl("请输入手机号！");
			}
		}
		
		//用户详细信息
		function userGetInfo($id)
		{
			global $db;
			$sql = "select * from core_user where id = $id";
			$result = $db->query($sql) or die($db->error());
			$rs = $db->fetch_array($result);

			if ($rs['status'] == 0)
			{
				$rs['status_show'] = "正常";
			}
			else
			{
				$rs['status_show'] = "停用";
			}

			$rs['addtime_show'] = date("Y-m-d H:i:s", $rs['addtime']);

			return $rs;
		}
	}
?>