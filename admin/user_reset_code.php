<?php
	require_once 'include/common.php';
	require_once (ADMIN_CLASS_DIR."UserClass.class.php");
	require_once (ADMIN_CLASS_DIR."UUserClass.class.php");

	$a = _g('op');
	switch ($a)
	{
		case 'reset':
				$user = new UserClass;
				$mobile = _g('mobile');
				$type_id = _g('type_id');
				$user->userResetCode($mobile, $type_id);
			break;
		case 'ureset':
				$uuser = new UUserClass;
				$order_id = _g('order_id');	
				$mobile = _g('mobile');
				$type_id = _g('type_id');
				$result = $uuser->userResetCode($mobile, $type_id);
				echo json_encode($result, JSON_UNESCAPED_UNICODE);exit;
		default:
				$user = new UserClass;
				$tpl -> assign('server_name',$server_name[$_SERVER['HTTP_HOST']]);
				$tpl->display("user_reset_code.html");
			break;
	}
?>