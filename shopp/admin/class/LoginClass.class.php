<?php
	require_once 'BaseClass.class.php';

	class LoginClass extends BaseClass
	{
		function __construct() { }
		//用户登录
		function login($username, $password)
		{
			global $db;
			if ($username && $password)
			{
				$sql = "select core_admin.*, core_admin_group.group, core_admin_group.aid from core_admin inner join core_admin_group on core_admin.group_id = core_admin_group.id where core_admin.username = '$username' and core_admin.status = 0";
				$result = $db->query($sql) or die($db->error());
				$num = $db->num_rows($result);
				if ($num > 0)
				{
					$rs = $db->fetch_array($result);
					if ($rs['password'] == md5($password))
					{
						$_SESSION['admin']['info'] = $rs;
						$this->goToUrl("", "main.php");
					}
					else
					{
						$this->gotoUrl("密码错误！");
					}
				}
				else
				{
					$this->gotoUrl("用户名错误！");
				}
			}
			else
			{
				$this->gotoUrl("请完整的输入登录信息！");
			}
		}

		//退出登录
		function logout()
		{
			unset($_SESSION['admin']);
			$this->goToUrl("你已成功注销本次登陆！", "index.php");
		}
	}
?>