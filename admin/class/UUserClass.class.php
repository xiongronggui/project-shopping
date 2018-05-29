<?php

	class UUserClass
	{
		//用户充值验证码更新
		function userResetCode($mobile, $type_id)
		{
			global $db;
			$arr['IsSuccess'] = false;
			$arr['Message'] = '';
			if ($mobile)
			{
				$sqlu = "select * from core_user where mobile = '$mobile' and status = 0";
				$resultu = $db->query($sqlu) or die($db->error());
				$numu = $db->num_rows($resultu);
				if ($numu)
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
						$arr['IsSuccess'] = true;
						$arr['Message'] = $code;
					}
					else
					{
						$arr['Message'] = '用户验证码更新失败！';
					}
				}
				else
				{
					//$arr['Message'] = '该手机号未注册或被停封！';
					$time = time();
					$code = rand(100000, 999999);
					$sql = "insert into core_user_sms (type_id, mobile, code, sendtime) values ($type_id, '$mobile', '$code', '$time')";
					$result = $db->query($sql) or die($db->error());
					if ($result) {
						$arr['IsSuccess'] = true;
						$arr['Message'] = $code;
					} else {
						$arr['Message'] = '用户验证码更新失败！';
					}
				}
			}
			else
			{
				$arr['Message'] = '请输入手机号！';
			}
			return $arr;
		}
	}
?>