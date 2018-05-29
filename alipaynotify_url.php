<?php
require_once 'include/common.php';
$data = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");
!empty($data) ?: ($data = $_POST);
parse_str($data, $args);
logInfo('alipay-1:'.json_encode($args));
logInfo('alipay-2:'.$args['out_trade_no']);
//$args = '{"gmt_create":"2018-04-12 15:52:33","charset":"UTF-8","gmt_payment":"2018-04-12 15:52:41","notify_time":"2018-04-12 16:06:09","subject":"\u5546\u54c1","sign":"PmaLFV08BDHJ9oywV1soLrPuTdVIMkVlCaFQz2TUEH\/5VgPETZQ97HV0IeJ73qiz1JUNvZ7oahFgFGq\/UqDq3wpYRHlj0X5ByH65ZLYA1w3MSm9c5YbVBoeBKc\/wwZXfhy4uDafiLsrf6IUcIrxiqV3VRf5ZN+dLU3fPFbuQ4noPwKpJBMAdhMu3hfSZniJDcZrCQRcaO0kRRfPODij\/zId94QAh7AW27fiA1EKe313SY5k36Opl5EhS0V3moV4x2gkpnjiqq+83XAllylA+G5S5lZdAsvdPi+xm5AGfast830jzPpD1qT05IPxp8AKlapkb8IiDNvHM4aCQoFf10g==","buyer_id":"2088402573828421","invoice_amount":"0.06","version":"1.0","notify_id":"96f1ff7c896a14833275bf7fcd8e997j8t","fund_bill_list":"[{\"amount\":\"0.06\",\"fundChannel\":\"ALIPAYACCOUNT\"}]","notify_type":"trade_status_sync","out_trade_no":"20180412155225669449","total_amount":"0.06","trade_status":"TRADE_SUCCESS","trade_no":"2018041221001004420549795342","auth_app_id":"2018040502507288","receipt_amount":"0.06","point_amount":"0.00","app_id":"2018040502507288","buyer_pay_amount":"0.06","sign_type":"RSA2","seller_id":"2088031758528902"}';
//$test = array('app_id'=>"2018033102481267", 'trade_status'=>'TRADE_SUCCESS');

$result = _curlPost('http://www.alipayinter.com/notify_url.php',$args);
logInfo('alipay-3:'.$result);
if($result == "success" && $args['trade_status'] == 'TRADE_SUCCESS'){
	echo  "success";		//请不要修改或删除
	$orderNo = $args['out_trade_no'];
	
	logInfo('订单号:'.$orderNo);
	$sql = "select goods_order.*, core_user.mobile from goods_order inner join core_user on goods_order.uid = core_user.id where order_status <> 1 and order_id = '$orderNo'";
	$result = $db->query($sql) or die($db->error());
	$rs = $db->fetch_array($result);
	if(!$rs){
		logInfo('订单未找到:'.$orderNo);
		echo 'error';
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
			/*logInfo('push->U+:start','U');
			require_once 'class/FaceClass.class.php';
			$user = new FaceClass();
			$user_data = $user->golden($rs['uid'],$rs['paytime'],$rs['goods']);
			logInfo('push->U+:'.json_encode($user_data),'U');
			if($user_data['success']){
				$url = 'http://139.199.75.178:8080/achieveBuyCount';
				$reresult = _curlPost($url,json_encode($user_data['data']));
				logInfo('push-return->U+:'.json_encode($reresult),'U');
			}*/

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
			/*$rs['paytime'] = $paytime;
			$rs['pwd'] = $password;
			$rs['order_status'] = 1;
			$push_result = push_order($interface_url['net'].'/InsertRechargeInfoToXS',$rs);
			if($push_result['IsSuccess']){
				$sql_notify = "update goods_order set notify_status = 2 where order_id = '$orderNo'";
				$result_notify = $db->query($sql_notify) or die($db->error());
			}else{
				logInfo('通知.net订单信息失败,订单号:'.$orderNo,'net');
			}*/
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
