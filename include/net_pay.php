<?php
include_once (INCLUDE_DIR."common.php");
class netpay
{
	public $customerno = '800002'; 
	public $key = '88888888';
	public $payurl = 'http://www.xaqrsm.top/api/paycenter';

	/*获取支付通道*/
	function payment_list()
	{
		$sign = strtoupper(md5('customerno='.$this->mchid));
		$data = _curlPost($this->payurl,array('customerno'=> $this->customerno,'sign'=>$sign));
		$data = json_decode($data,true);
		$result = [];
		if($data['res']){
			foreach ($data['data'] as $key => $value) {
				$result[] = array('id'=>$value['payment'],'name'=>$value['name']);
			}
		}
		return $result;
	}

	/*拼接订单数据*/
	public function submit($order,$ip)
    {
        $reresult= array(
            'success' => true,
            'msg' => '',
            'redata' => [],
            'url' => ''
        );
    	$args = array(
    			'no' => 2000,
    			'account' => 8888888,
    			'accounttype' => 1,
    			'billno' => $order['order_id'],
                'subject' => $order['goods'],
                'subjectdesrc' => '商品',
    			'amount' => $order['total'],
    			'customerno' => $this->customerno,
    			'mediatype' => 1,
    			'sign' => ''
			);
    	$args['sign'] = md5("No=".$args['no']."&CustomerNo=".$this->customerno."&Account=".$args['account']."&BillNo=".$args['billno']."&Amount=".$args['amount'].$this->key);
    	
    	$data = http_post_json($this->payurl,json_encode($args));
    	
    	$tdata = json_decode($data[1],true);
    	logInfo('NET聚合返回结果:'.json_encode($data),'net');
    	if($data[0] == 200 && $tdata['ok'] == 1){
    		//$this->submit_p($tdata['data']);
            $reresult['url'] = $tdata['data'];
    	}else{
            $reresult['success'] = false;
            $reresult['msg'] = $tdata['msg'];
            $reresult['url'] = 'goods.php';
    	}
        return $reresult;
    }

    function submit_p($url)
    {
		header("Location: ".$url); 
    }

    function sign($data)
    {
        $res['IsSuccess'] = true;
        $res['Message'] = "";
        $sign =md5("CustomerNo=".$this->customerno."&BillNo=".$data['BillNo']."&Amount=".$data['Amount']."&Status=".$data['Status'].$this->key);
        if($sign != $data['Sign']){
            $res['IsSuccess'] = false;
            $res['Message'] = "验证未通过";
            logInfo('验签结果:'.json_encode($rs),'net');
        }
        return $res;
    }

    function update($data)
    {
        global $db;
        $orderNo = $data['BillNo'];
        $flatorderid = isset($data['OrderNo']) ?  $data['OrderNo'] : '';
        $source = $data['Source'];
        $channel = $data['Channel'];
        $service_charge = $data['Service_charge'];
        $charge_type = $data['Charge_type'];
        $calculation_type = $data['Calculation_type'];
        logInfo('订单号:'.$orderNo,'net');
        $sql = "select goods_order.*, core_user.mobile,core_user.people_id idcard,core_user.realname name from goods_order inner join core_user on goods_order.uid = core_user.id where order_status <> 1 and order_id = '$orderNo'";
        $result = $db->query($sql) or die($db->error());
        $rs = $db->fetch_array($result);
        if(!$rs){
            logInfo('订单号异常:'.$orderNo ,'net');
            exit;
        }
        
        $paytime = time();
        $password = mt_rand(10000000, 99999999);
        $pwd = authcode($password, "ENCODE");
        //$sqlu = "update goods_order set source = '$source',channel='$channel',service_charge=$service_charge,charge_type = $charge_type,calculation_type = $calculation_type, paytime = $paytime, pwd = '$pwd', order_status = 1 where order_id = '$orderNo'";
        $sqlu = '';
        if($data['Status']){
            $sqlu = "update goods_order set orderno = '$flatorderid', source = '$source',channel='$channel',charge_type = $charge_type,calculation_type = $calculation_type, paytime = $paytime, pwd = '$pwd', order_status = 1 where order_id = '$orderNo'";
        }else{
            $sqlu = "update goods_order set orderno = '$flatorderid',source = '$source',channel='$channel' where order_id = '$orderNo'";
        }
        
        $resultu = $db->query($sqlu) or die($db->error());
        logInfo('net更改状态结果:'.$resultu.'SQL:'.$sqlu);
        if ($resultu)
        {
            //推送数据U+ logInfo('push->U+:'.json_encode($user_data));
            /*logInfo('push->U+:start','U');
            require_once 'class/FaceClass.class.php';
            $user = new FaceClass();
            $user_data = $user->golden($rs['uid'],$paytime,$rs['goods']);
            logInfo('push->U+:'.json_encode($user_data),'U');
            if($user_data['success']){
                $url = 'http://139.199.75.178:8080/achieveBuyCount';
               $reresult = _curlPost($url,$user_data['data']);
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
            $rs['paytime'] = $paytime;
            $rs['pwd'] = $password;
            $rs['order_status'] = 1;
            $push_result = push_order($interface_url['net'].'/InsertRechargeInfoToXS',$rs,$interface_url['pwd']);
            if($push_result['IsSuccess']){
                $sql_notify = "update goods_order set notify_status = 2 where order_id = '$orderNo'";
                $result_notify = $db->query($sql_notify) or die($db->error());
            }else{
                logInfo('通知.net订单信息失败,订单号:'.$orderNo.',返回结果:'.json_encode($push_result),"net");
            }
            /*end*/
        }
    }
}
?>