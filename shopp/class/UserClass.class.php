<?php
	require_once 'BaseClass.class.php';

	class UserClass extends BaseClass
	{
		//构造函数
		function __construct() { }

		//用户注册
		function register($mobile, $type_id, $code, $password, $people_id, $realname)
		{
			global $db;

			if (!preg_match("/^[a-zA-Z0-9]{6,12}$/", $password))
			{
				$this->goToUrl("登录密码格式不正确，请输入6-12位数字+字母组合！");
				die();
			}

			if ($mobile && $code && $password && $people_id && $realname)
			{
				$sqlm = "select * from core_user where mobile = '$mobile'"; 
				$resultm = $db->query($sqlm) or die($db->error());
				$numm = $db->num_rows($resultm);
				if ($numm)
				{
					$this->goToUrl("该手机已被注册！", "goods.php");
					die();
				}

				$sqlp = "select * from core_user where people_id = '$people_id'"; 
				$resultp = $db->query($sqlp) or die($db->error());
				$nump = $db->num_rows($resultp);
				if ($nump)
				{
					$this->goToUrl("该身份证已被注册！", "goods.php");
					die();
				}
				
				$realtime = time() - 600;
				$sqls = "select * from core_user_sms where type_id = $type_id and mobile = '$mobile' and code = '$code' and sendtime >= $realtime"; 
				$results = $db->query($sqls) or die($db->error());
				$nums = $db->num_rows($results);
				if (!$nums)
				{
					$this->goToUrl("验证码错误！", "goods.php");
					die();
				}
				
				//注册开始
				$pwd = md5($password);
				$pay_pwd = md5($pay_password);
				$addtime = time();
				$sql = "insert into core_user (mobile, password, people_id, realname, addtime) values ('$mobile', '$pwd', '$people_id', '$realname', $addtime)"; 
				$result = $db->query($sql) or die($db->error());
				if ($result)
				{
					//注册后登录
					$sql = "select * from core_user where mobile = '$mobile'";
					$result = $db->query($sql) or die($db->error());
					$rs = $db->fetch_array($result);
					$_SESSION['members']['info'] = $rs;

					$this->goToUrl("注册成功！", "goods.php");
				}
				else
				{
					$this->goToUrl("注册失败！", "goods.php");
				}
			}
			else
			{
				$this->goToUrl("请输入完整的注册信息！", "goods.php");
			}
		}

		//用户登录
		function login($tid, $mobile, $type_id, $code, $password)
		{
			global $db;

			switch ($tid)
			{
				case 0:						//密码登录
						if ($mobile && $password)
						{
							$pwd = md5($password);

							$sqls = "select * from core_user where mobile = '$mobile' and `password` = '$pwd'";
							$results = $db->query($sqls) or die($db->error());
							$nums = $db->num_rows($results);
							if ($nums)
							{
								$rs = $db->fetch_array($results);
								if ($rs['status'] == 0)
								{
									$_SESSION['members']['info'] = $rs;
								}
								else
								{
									$this->gotoUrl("该用户被禁用！");
								}
							}
							else
							{
								$this->gotoUrl("用户名或密码错误！");
							}
						}
						else
						{
							$this->gotoUrl("请输入完整的登录信息！");
						}
					break;
				case 1:						//手机登录
						if ($mobile && $code)
						{
							$realtime = time() - 600;
							$sqls = "select * from core_user_sms where type_id = $type_id and mobile = '$mobile' and code = '$code' and sendtime >= $realtime"; 
							$results = $db->query($sqls) or die($db->error());
							$nums = $db->num_rows($results);
							if ($nums)
							{
								$sql = "select * from core_user where mobile = '$mobile'";
								$result = $db->query($sql) or die($db->error());
								$rs = $db->fetch_array($result);
								if ($rs['status'] == 0)
								{
									$_SESSION['members']['info'] = $rs;
								}
								else
								{
									$this->gotoUrl("该用户被禁用！");
								}
							}
							else
							{
								$this->goToUrl("验证码错误！");
							}
						}
						else
						{
							$this->gotoUrl("请输入完整的登录信息！");
						}
					break;
			}

			$this->goToUrl("", "goods.php");
		}

		//密码找回
		function pwdBack($mobile, $type_id, $code, $password)
		{
			global $db;
			if (!preg_match("/^[a-zA-Z0-9]{6,12}$/", $password))
			{
				$this->goToUrl("密码格式不正确，请输入6-12位数字+字母组合！");
				die();
			}

			if ($mobile && $code && $password)
			{
				$realtime = time() - 600;
				$sqls = "select * from core_user_sms where type_id = $type_id and mobile = '$mobile' and code = '$code' and sendtime >= $realtime"; 
				$results = $db->query($sqls) or die($db->error());
				$nums = $db->num_rows($results);
				if (!$nums)
				{
					$this->goToUrl("验证码错误！");
					die();
				}
				
				//密码找回
				$pwd = md5($password);
				$sql = "update core_user set password = '$pwd' where mobile = '$mobile'";
				$result = $db->query($sql) or die($db->error());
				if ($result)
				{
					$this->goToUrl("密码修改成功！", "goods.php");
				}
				else
				{
					$this->goToUrl("密码修改失败！");
				}
			}
			else
			{
				$this->goToUrl("请输入完整的密码找回信息！");
			}
		}
		
		function golden()
        {
            global $db;
            $sql = "SELECT paytime,goods,sum(uid)as id_sum FROM `goods_order` where  order_status = 1  GROUP BY uid HAVING id_sum = 1";
            $result = $db->query($sql) or die($db->error());
            $rs = $db->fetch_array($result);
            if (empty($rs)) {
                returnData(0,'没有数据',[]);
            }
            $data['source'] =  SOURCE ;
            $data['website'] =  1;
            $data['medium'] =  $rs['goods'];
            $data['id_sum'] =  $rs['id_sum'];
            $data['time'] =  $rs['paytime'];
            $data['ident'] =  'vpiVOrCu2qPkKCKUziTfHWgKaTqHE21jRSwl8LwXcdA=';
            returnData(1,'',$data);
        }
	}
?>