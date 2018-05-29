<?php
require_once 'include/common.php';

$code = '';
if(!empty($_GET['pay'])){
    $code = $_GET['pay'];
    unset($_GET['pay']);
}

$get = $_GET;
$post = $_POST;
if(empty($code)){
	$code = isset($post['pay']) ? $post['pay'] : '';
}
if(empty($code)){
	$code = 'xpay';
}
logInfo('pay:'.$code);
if(isset($post['pay'])){
	unset($post['pay']);
}

$input = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents('php://input');
$data = array(
    'code' => $code,
    'data' => array(
        'get' => $get,
        'post' => $post,
        'input' => $input
    )
);
//$data = '{"code":"alipay","data":{"get":[],"post":{"gmt_create":"2018-04-19 14:39:00","charset":"GBK","gmt_payment":"2018-04-19 14:39:11","notify_time":"2018-04-19 14:39:11","subject":"901180419143848575","sign":"FGudqzIpKCGqtX6dFw81wPnChm19CxIXLYPY+zVt9G86w2yAhIQ9cCf4cdkfLgDWMxzm4n6Hb+uX0DRpZzkkS1R4Fse1VLgzicsdxCAK2dzWW030syet+fXE3vIL3fnTBbSWSFPx9nM3GiBv\/OCTHTL9PqZS1Tf\/JEWuK4N93CbZZ7SjeN07ZnJ37C5j0sZR8pWBwg9CDKJSy447WxzC7FVv1BmC6V7qWTx6KAOH1hR\/U+sjlwcIQg48Y8eH9Ymft0A8RSlNeHrmkyuRf4xsIiVw+FO2kl6B+XuJAjtuHFbbcEpz1YhQBuEd76JIWM+AZgpPQtQPFpvTnXxLuCYnaw==","buyer_id":"2088822309208514","invoice_amount":"6.00","version":"1.0","notify_id":"98861c3b62b5a8b78c85ce564d28cc7jxt","fund_bill_list":"[{\"amount\":\"6.00\",\"fundChannel\":\"ALIPAYACCOUNT\"}]","notify_type":"trade_status_sync","out_trade_no":"901180419143848575","total_amount":"6.00","trade_status":"TRADE_SUCCESS","trade_no":"2018041921001004510573181331","auth_app_id":"2018041602569019","receipt_amount":"6.00","point_amount":"0.00","app_id":"2018041602569019","buyer_pay_amount":"6.00","sign_type":"RSA2","seller_id":"2088031925056278"},"input":"pay=alipay&gmt_create=2018-04-19+14%3A39%3A00&charset=GBK&gmt_payment=2018-04-19+14%3A39%3A11&notify_time=2018-04-19+14%3A39%3A11&subject=901180419143848575&sign=FGudqzIpKCGqtX6dFw81wPnChm19CxIXLYPY%2BzVt9G86w2yAhIQ9cCf4cdkfLgDWMxzm4n6Hb%2BuX0DRpZzkkS1R4Fse1VLgzicsdxCAK2dzWW030syet%2BfXE3vIL3fnTBbSWSFPx9nM3GiBv%2FOCTHTL9PqZS1Tf%2FJEWuK4N93CbZZ7SjeN07ZnJ37C5j0sZR8pWBwg9CDKJSy447WxzC7FVv1BmC6V7qWTx6KAOH1hR%2FU%2BsjlwcIQg48Y8eH9Ymft0A8RSlNeHrmkyuRf4xsIiVw%2BFO2kl6B%2BXuJAjtuHFbbcEpz1YhQBuEd76JIWM%2BAZgpPQtQPFpvTnXxLuCYnaw%3D%3D&buyer_id=2088822309208514&invoice_amount=6.00&version=1.0&notify_id=98861c3b62b5a8b78c85ce564d28cc7jxt&fund_bill_list=%5B%7B%22amount%22%3A%226.00%22%2C%22fundChannel%22%3A%22ALIPAYACCOUNT%22%7D%5D&notify_type=trade_status_sync&out_trade_no=901180419143848575&total_amount=6.00&trade_status=TRADE_SUCCESS&trade_no=2018041921001004510573181331&auth_app_id=2018041602569019&receipt_amount=6.00&point_amount=0.00&app_id=2018041602569019&buyer_pay_amount=6.00&sign_type=RSA2&seller_id=2088031925056278"}}';
//$data = json_decode($data,true);
logInfo('magento:'.json_encode($data));
$magento = new magento();
$syncresult = $magento->pushSyncData($data);
$syncresult = json_decode($syncresult,true);
logInfo('magento-sync,订单号:'.$syncresult['data']['out_trade_no'].',返回值:'.json_encode($syncresult));
if($syncresult['res'] == 'success'){
	echo 'success';
	updateorder_status($syncresult['data']['out_trade_no']);
}else{
	echo 'fail';
}

function updateorder_status($orderNo)
{
	global $db;
	$sql = "select goods_order.*, core_user.mobile from goods_order inner join core_user on goods_order.uid = core_user.id where order_status <> 1 and order_id = '$orderNo'";
	$result = $db->query($sql) or die($db->error());
	$rs = $db->fetch_array($result);
	if(!$rs){
		logInfo('订单未找到:'.$orderNo);
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
}

?>