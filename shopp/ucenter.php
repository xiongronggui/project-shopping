<?php
	require_once 'include/common.php';
	require_once (CLASS_DIR."UCenterClass.class.php");

	$ucenter = new UCenterClass;

	$a = _g('op');
	switch ($a)
	{
		case "goods_order_close":				//订单关闭
				$order_id = _g('order_id');
				$goodsOrderClose = $ucenter->goodsOrderClose($order_id);
			break;
		case "goods_order_del":				//订单删除
				$order_id = _g('order_id');
				$goodsOrderDel = $ucenter->goodsOrderDel($order_id);
			break;
		case "modify_pwd":						//密码修改
				$t = _g('t');
				if ($t == "form")
				{
					$mobile = _g('mobile');
					$type_id = _g('type_id');
					$code = _g('code');
					$password = _g('password');

					$ucenter->pwdModify($mobile, $type_id, $code, $password);
				}
				else
				{
					$tpl->display('password_modify.html');
				}
			break;
		case "send_sms_code":				//发送订单密码
				$order_id = _g('order_id');
				$result = $ucenter->sendSMSCodeByOrderId($order_id);
				echo json_encode($result, JSON_UNESCAPED_UNICODE);
			break;
		case "see_code":
				$order_id = _g('order_id');

				$result = $ucenter->goodsSeePwd($order_id);
				echo json_encode($result, JSON_UNESCAPED_UNICODE);
			break;
		case "logout":						//登出
				$ucenter->logout();
			break;
		default:

				$page = _g('page');
				$goodsOrderTimeoutClose = $ucenter->goodsOrderTimeoutClose();
				$goodsOrderList = $ucenter->goodsOrderList($page);
				$tpl->assign("result", $goodsOrderList);
				$tpl -> assign('server_name',$server_name[$_SERVER['SERVER_NAME']]);
				$tpl->display("ucenter_goods_order_list.html");
			break;
	}
?>