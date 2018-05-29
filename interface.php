<?php
	require_once 'include/common.php';
	require_once (CLASS_DIR."InterfaceClass.class.php");

	$interface = new InterfaceClass;

	$json_data =  isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");
	logInfo($json_data);
    $data = json_decode($json_data, true);
	$a = $data['op'];
	$result['IsSuccess'] = false;
	$result['Message'] = '未找到方法';
	switch ($a)
	{
		//订单有效性验证
		case "check_order_id":
				$order_id = $data['order_id'];
				$password = $data['password'];
				$result = $interface->checkOrderId($order_id, $password);
			break;
		//充值验证短信发送
		case "sendsms_by_order_id":
				$order_id = $data['order_id'];
				$password = $data['password'];
				$result = $interface->sendSMSByOrderId($order_id, $password); 
			break;
		//充值验证
		case "recharge_order_id":
				$order_id = $data['order_id'];
				$password = $data['password'];
				$code = $data['code']; 
				$result = $interface->rechargeOrderId($order_id, $password, $code);
			break;
		//充值完成状态修改
		case "change_code_status":
				$order_id = $data['order_id'];
				$password = $data['password'];
				//$code = $data['code']; 
				$recharge_platform = $data['recharge_platform']; 
				$recharge_account = $data['recharge_account']; 
				$recharge_total = $data['recharge_total']; 
				$usetime = strtotime($data['usetime']);
				$result = $interface->changeCodeStatus($order_id,$password,$recharge_platform,$usetime,$recharge_account,$recharge_total);
			break;
	}
	logInfo($a.'->'.$data['order_id']);
	echo json_encode($result, JSON_UNESCAPED_UNICODE);exit;
?>