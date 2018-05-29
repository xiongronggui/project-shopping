<?php
	require_once 'include/common.php';
	require_once (CLASS_DIR."GoodsOrderClass.class.php");
	
	$goods_order = new GoodsOrderClass;
	$magento = new magento();
	$netpay = new netpay();
	$host = $_SERVER['HTTP_HOST'];
	$payment_config = $server_name[$host]['img'].'_payment_config';
	$payment_config = $$payment_config;

	$a = _g('op');
	switch ($a)
	{
		case "is_pay":
            $id = _g('order_id');
            $goods_order->is_pay_order($id);
            break;
		case "card":
			if(empty($_POST['bankcard'])){
					returnData(false, 'empty', '');
        	}
        	$goods_order ->Getbankname($_POST['bankcard']);
        	break;
		// 添加银行卡
		case "quick":
            $id = _g('id');
            $orderPay = $goods_order->orderPay($id);
            if(isset($payment_config[$orderPay['channel']])){
                if($payment_config[$orderPay['channel']]['type'] == 'quick'){
                    $tpl->assign('orderPay', $orderPay);//订单信息
                    $tpl->assign('mobile', $_SESSION['members']['info']['mobile']);//手机号
                    $tpl->assign('name', $_SESSION['members']['info']['realname']);//姓名
                    $tpl->assign('idcard', $_SESSION['members']['info']['people_id']);//身份证
                	$tpl -> assign('server_name',$server_name[$host]);
                    $tpl->display('goods_quick.html');
                    exit;
                }
            }else{
                exit('不存在的支付通道'. $orderPay['channel']);
            }
			break;
		case "bank":
			$id = _g('id');
            $orderPay = $goods_order->orderPay($id);
            if(isset($payment_config[$orderPay['channel']])){
                if($payment_config[$orderPay['channel']]['type'] == 'sel_bank'){
                	$tpl->assign('bank_list',$bank_list);
                	$tpl -> assign('server_name',$server_name[$host]);
                    $tpl->display('goods_bank.html');
                    exit;
                }
            }else{
                exit('不存在的支付通道'. $orderPay['channel']);
            }
            break;
		//订单生成
		case "order_confirm":
				$order_id = date("ymdHis").mt_rand(100, 999);
				$goods = _g('goods');
				$images = _g('images');
				$price = _g('price');
				$usd_rate = _g('usd_rate');
				$total = _g('total');
				$channel = _g('channel');
				$price = $price;
				logInfo('美元:'.$price.'人民币:'.$total);
				if(empty($channel)){
					$channel = 'NET聚合支付';
				}
				$channel_type = 'bank';
                if(isset($payment_config[$channel])){
                    $channel_type = $payment_config[$channel]['type'];
                }
                $tpl -> assign('server_name',$server_name[$host]);
				$result = $goods_order->orderConfirm($order_id, $goods, $images, $price, $usd_rate, $total, $channel, $channel_type);
				if($result['success']){

					$result = $goods_order->orderPay($result['id']);
					if($result['success']){
						$result = $netpay->submit($result['redata'],getIp());
					}
				}

				returnData($result['success'],$result['msg'],$result['redata'],$result['url']);
			break;
		//订单支付
		case "order_pay":
				$id = _g('id');
				$orderPay = $goods_order->orderPay($id);
				$tpl -> assign('server_name',$server_name[$host]);

				if($orderPay['channel'] == "开联通"){
					$kailiantong_config['orderNo'] = $orderPay['order_id'];
					$kailiantong_config['orderAmount'] = $orderPay['total'];
					$kailiantong_config['orderDatetime'] = $orderPay['addtime_show_pay'];
					$kailiantong_config['productName'] = $orderPay['goods'];

					foreach ($kailiantong_config as $key => $val)
					{
						$strInfo .= "$key=".$val."&";
					}

					$string = substr($strInfo, 0, -1);
					$signMsg = strtoupper(md5($string));	

					$kailiantong_config['signMsg'] = $signMsg;

					$tpl->assign("order_pay_info", $orderPay);
					$tpl->assign("kailiantong_config", $kailiantong_config);
					$tpl->display('goods_order_pay.html');
				}elseif ($orderPay['channel'] == "米提斯") {
					require_once 'payment/metispay/metispay.php';
					$mits_config['orgOrderNo'] = $orderPay['order_id'];
					$mits_config['amount'] = $orderPay['total'];
					$mits_config['subject'] = $orderPay['goods'];
					$mits_config['orderDate'] = date("Ymd", strtotime($orderPay['addtime_show']));
					$mets = new metispay_payment($mits_config);
					$sign = $mets->sign($mits_config);
					$mits_config['signature'] = $sign;

					$url = 'http://39.108.82.202:8088/quick-pay-api/v1.0/order/unionPayGateway';

					$orderPay['price'] = $orderPay['price']/100;
					$orderPay['total'] = number_format($orderPay['total']/100,2);
					$tpl->assign("order_info", $orderPay);
					$tpl->assign("mits_config", $mits_config);
					$tpl->assign('time',date("Y-m-d H:i:s", $orderPay['addtime']));
                    $res = http_post_json($url, json_encode($mits_config));
                    $res = json_decode($res, true);
                    if(isset($res['html'])){
                        echo $res['html'];
                    }else{
                    	print_r($res);
                        return $res;
                    }

				}else{
                    /*if(isset($payment_config[$orderPay['channel']])){
                        $class = $payment_config[$orderPay['channel']]['class_name'];
                        $class_path = PAYMENT_URL . $class . 'pay/submit.php';
                        $class_name = $class . 'pay_submit';
                        $config = $$payment_config[$orderPay['channel']]['config_name'];
                        if($payment_config[$orderPay['channel']]['type'] == 'quick'){
                            $orderPay['name'] = !empty($_POST['name']) ? $_POST['name'] : '';
                            $orderPay['phone'] = !empty($_POST['mobile']) ? $_POST['mobile'] : '';
                            $orderPay['idcard'] = !empty($_POST['idcard']) ? $_POST['idcard'] : '';
                            $orderPay['bank'] = !empty($_POST['bank']) ? $_POST['bank'] : '';
                        }
						if($payment_config[$orderPay['channel']]['type'] == 'sel_bank'){
                        	$config['bankcode'] = strtoupper(_g('bankcode'));
                        	$config['paytype'] = checkmobile() ? 'kuaijie' : 'bank';
                        }

                        require_once($class_path);
                        $payment_class = new $class_name($orderPay, $config);

                        $payment_class->submit();
                    }else{
                        exit('不存在的支付通道'. $orderPay['channel']);
                    }*/
                    //$magento->submit($orderPay,getIp());

                    $netpay->submit($orderPay,getIp());
                }
			break;

        //支付验证码提交确定支付
        case "sms_commit":
            $id = _g('id');
            $orderPay = $goods_order->orderPay($id);

            if(isset($payment_config[$orderPay['channel']])){
                $class = $payment_config[$orderPay['channel']]['class_name'];
                $class_path = PAYMENT_URL . $class . 'pay/submit.php';
                $class_name = $class . 'pay_submit';
                $config = $$payment_config[$orderPay['channel']]['config_name'];
                $orderPay['name'] = !empty($_POST['name']) ? $_POST['name'] : '';
                $orderPay['phone'] = !empty($_POST['mobile']) ? $_POST['mobile'] : '';
                $orderPay['idcard'] = !empty($_POST['idcard']) ? $_POST['idcard'] : '';
                $orderPay['bank'] = !empty($_POST['bank']) ? $_POST['bank'] : '';
                $orderPay['sms_code']  = !empty($_POST['sms_code']) ? $_POST['sms_code'] : '';
                require_once($class_path);
                $payment_class = new $class_name($orderPay, $config);
                $payment_class->smsCommit();
            }else{
                exit('不存在的支付通道'. $orderPay['channel']);
            }
            break;
		case "order_confirm_ajax":
				$order_id = date("ymdHis").mt_rand(100, 999);
				$goods = _g('goods');
				$images = _g('images');
				$price = _g('price');
				$usd_rate = _g('usd_rate');
				$total = _g('total');
				$channel = _g('channel');

				$channel_type = 'bank';
                if(isset($payment_config[$channel])){
                    $channel_type = $payment_config[$channel]['type'];
                }

				$goods_order->orderConfirmAjax($order_id, $goods, $images, $price, $usd_rate, $total);

			break;
		default:
				$id = _g('id');

				$usd_rate = _g('usd_rate');
				$count = _g('price');

				if ($_SESSION['members']['info']['istest'] == 1)
				{
					$price = "1";
				}
				else
				{
					$price = _g('price');
				}
				
				$price_show = $price; 
				$total_show = round($price * $usd_rate);
				$total = $total_show * 100;
				$goodsInfo = $goods_order->goodsGetInfo($id);
				$goodsInfo['title'] = $_SESSION['goods'];
				$pay_arr = $$server_name[$host]['pay'];
				$pay = [];
				//$pay = checkmobile() ? $pay_arr['mobile_payment'] : $pay_arr['pc_payment'];
				
				//$pay = $magento->payment_list();
				$tpl->assign("paytype", $pay);
				$tpl->assign("usd_rate", $usd_rate);
				$tpl->assign("count", $count);
				$tpl->assign("price", $price*100);
				$tpl->assign("price_show", $price_show);
				$tpl->assign("total_show", $total_show);
				$tpl->assign("total", $total);
				$tpl->assign("goods_info", $goodsInfo);
				$tpl->assign('panda',$_SESSION['members']['info']['realname']);
				$tpl -> assign('server_name',$server_name[$host]);
				$tpl->display('goods_order_confirm.html');
			break;
	}


?>