<?php
	require_once 'include/common.php';
	require_once (CLASS_DIR."UserClass.class.php");

	$user = new UserClass;

	$a = _g('op');
	switch ($a)
	{
		case "reg":							//注册
				$mobile = _g('mobile');
				$type_id = _g('type_id');
				$code = _g('code');
				$password = _g('password');
				$realname = _g('realname');
				$people_id = _g('people_id');
				$user->register($mobile, $type_id, $code, $password, $people_id, $realname);
			break;
		case "login":						//登录
				$tid = _g('tid');
				$mobile = _g('mobile');
				$password = _g('password');
				$type_id = _g('type_id');
				$code = _g('code');
				$user->login($tid, $mobile, $type_id, $code, $password);
			break;
		case "back":						//密码找回
				$mobile = _g('mobile');
				$type_id = _g('type_id');
				$code = _g('code');
				$password = _g('password');
				$user->pwdBack($mobile, $type_id, $code, $password);
			break;
		case "send_sms":
				$type_id = _g('type_id');
				$mobile = _g('mobile'); 
				$result = $user->createCode($type_id, $mobile);
				echo json_encode($result, JSON_UNESCAPED_UNICODE);
			break;
	}
?>