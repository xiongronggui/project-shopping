<?php
	require_once 'include/common.php';
	$data = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");
	$pay_class = empty($_GET['p_c']) ? 'weixin' : $_GET['p_c'];
	$host = $_SERVER['SERVER_NAME'];
	require_once 'payment/'.$pay_class . 'pay/notify.php';
	logInfo($pay_class.'->'.json_encode($data));
	$notify_class = $pay_class.'_notify';
	$config_name = $server_name[$host]['img'].'_'.$pay_class . '_config';
	$payment = new $notify_class($$config_name);
	$orderNo = $payment->order;
	
	$payResult = $payment->submit();
	
	if($payResult)
	{
		if($pay_class == 'doudou'){
			echo !empty($payment->success) ? $payment->success : "SUCCESS";		//请不要修改或删除
		}else{
			echo !empty($payment->success) ? $payment->success : "success";		//请不要修改或删除
		}
		logInfo($pay_class.'->订单号:'.$orderNo);
		$sql = "select goods_order.*, core_user.mobile from goods_order inner join core_user on goods_order.uid = core_user.id where order_status <> 1 and order_id = '$orderNo'";
		$result = $db->query($sql) or die($db->error());
		$rs = $db->fetch_array($result);
		if(!$rs){
			logInfo($pay_class.'->订单号异常:'.$orderNo );
			exit;
		}
		
		$paytime = time();
		$password = mt_rand(10000000, 99999999);
		$pwd = authcode($password, "ENCODE");
		$sqlu = "update goods_order set paytime = $paytime, pwd = '$pwd', order_status = 1 where order_id = '$orderNo'";
		$resultu = $db->query($sqlu) or die($db->error());
		if ($resultu)
		{
			//推送数据U+ logInfo('push->U+:'.json_encode($user_data));
			logInfo('push->U+:start','U');
			require_once 'class/FaceClass.class.php';
            $user = new FaceClass();
            $user_data = $user->golden($rs['uid'],$rs['paytime'],$rs['goods']);
			logInfo('push->U+:'.json_encode($user_data),'U');
            if($user_data['success']){
                $url = 'http://139.199.75.178:8080/achieveBuyCount';
               $reresult = _curlPost($url,$user_data['data']);
			   logInfo('push-return->U+:'.json_encode($reresult),'U');
            }
			
			include SMS_LIB."TopSdk.php";

			$appkey = "24802154";
			$secret = "48af266ccac4d014ff36f29a6e23b504";

			$sign_name = "鑫圣";
			$temp_code = "SMS_125865060";

			$time = date("Y-m-d H:i", $rs['addtime']);
			$order_id = $orderNo;
			$mobile = $rs['mobile'];

			$c = new TopClient;
			$c->appkey = $appkey;
			$c->secretKey = $secret;
			$req = new AlibabaAliqinFcSmsNumSendRequest;
			$req->setSmsType("normal");
			$req->setSmsFreeSignName($sign_name);
			$req->setSmsParam("{'time':'$time', 'order_id':'$order_id', 'pwd':'$password'}");
			$req->setRecNum($mobile);
			$req->setSmsTemplateCode($temp_code);
			$resp = $c->execute($req);
			
			/*推送成功订单数据到.net*/
			$rs['paytime'] = $paytime;
			$rs['pwd'] = $password;
			$rs['order_status'] = 1;
			$push_result = push_order($interface_url['net'].'/InsertRechargeInfoToXS',$rs);
			if($push_result['IsSuccess']){
				$sql_notify = "update goods_order set notify_status = 2 where order_id = '$orderNo'";
				$result_notify = $db->query($sql_notify) or die($db->error());
			}else{
				logInfo('通知.net订单信息失败,订单号:'.$orderNo.',返回结果:'.json_encode($push_result),"net");
			}
			/*end*/
		}
		else
		{
			//验证失败
			echo "fail";
		}
	}else{
		echo "fail";
	}
?>

	
	
