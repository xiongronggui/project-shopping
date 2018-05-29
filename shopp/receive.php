<?php
	require_once 'include/common.php';
	
	$merchantId =  $_POST["merchantId"];			//商户的id

	$sql = "select goods_order.*, core_user.mobile from goods_order inner join core_user on goods_order.uid = core_user.id where order_id = '$orderNo'";
	$result = $db->query($sql) or die($db->error());
	$rs = $db->fetch_array($result);

	$kailiantong_config['orderNo'] = $rs['order_id'];
	$kailiantong_config['orderAmount'] = $rs['total'];
	$kailiantong_config['orderDatetime'] = date("YmdHis", $rs['addtime']);
	$kailiantong_config['productName'] = $rs['goods'];

	$version = $kailiantong_config['version'];							//版本的型号
	$language = $kailiantong_config['language'];					//语言
	$signType = $kailiantong_config['signType'];					//签名的种类
	$payType = $kailiantong_config['payType'];					//支付方式
	$mchtOrderId = $_POST['mchtOrderId'];							//开联的商品的订单号
	$orderNo = $kailiantong_config['orderNo'];						//商户的订单号
	$orderDatetime = $kailiantong_config['orderDatetime'];	//商户订单提交时间
	$orderAmount = $kailiantong_config['orderAmount'];		//商户订单的数量
	$payDatetime = $_POST['payDatetime'];							//支付完成时间
	$payResult = $_POST['payResult'];									//处理结果
	$signMsg = $_POST["signMsg"];										//签名字符串

	$bufSignSrc="";                        //签名字符串的拼接
	if($merchantId != "")
		$bufSignSrc=$bufSignSrc."merchantId=".$merchantId."&";		
	if($version != "")
		$bufSignSrc=$bufSignSrc."version=".$version."&";		
	if($language != "")
		$bufSignSrc=$bufSignSrc."language=".$language."&";		
	if($signType != "")
		$bufSignSrc=$bufSignSrc."signType=".$signType."&";		
	if($payType != "")
		$bufSignSrc=$bufSignSrc."payType=".$payType."&";
	if($mchtOrderId != "")
		$bufSignSrc=$bufSignSrc."mchtOrderId=".$mchtOrderId."&";
	if($orderNo != "")
		$bufSignSrc=$bufSignSrc."orderNo=".$orderNo."&";
	if($orderDatetime != "")
		$bufSignSrc=$bufSignSrc."orderDatetime=".$orderDatetime."&";
	if($orderAmount != "")
		$bufSignSrc=$bufSignSrc."orderAmount=".$orderAmount."&";
	if($payDatetime != "")
		$bufSignSrc=$bufSignSrc."payDatetime=".$payDatetime."&";
	if($payResult != "")
		$bufSignSrc=$bufSignSrc."payResult=".$payResult;

	$keys_suf = "&key=".$kailiantong_config['key'];
	$string = $bufSignSrc.$keys_suf;
	$newSignMsg = strtoupper(md5($string));

	if($signMsg == $newSignMsg)
	{
		if($payResult == 1)
		{		
			$paytime = strtotime($payDatetime);
			$password = mt_rand(10000000, 99999999);
			$pwd = authcode($password, "ENCODE");
			$sqlu = "update goods_order set paytime = $paytime, pwd = '$pwd', order_status = 1 where order_id = '$orderNo'";
			$resultu = $db->query($sqlu) or die($db->error());
			if ($resultu)
			{
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

				echo "success";		//请不要修改或删除
			}
			else
			{
				//验证失败
				echo "fail";
			}
		}
	}
	else
	{
		//验证失败
		echo "fail";
	}
?>

	
	
