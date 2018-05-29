<?php
	require_once 'include/common.php';
	require_once (CLASS_DIR."UCenterClass.class.php");
	require_once (CLASS_DIR."InterfaceClass.class.php");

	$ucenter = new UCenterClass;
	$interface = new InterfaceClass;

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
		case "send_sms_code"://发送订单密码
				$order_id = _g('order_id');
				$result = $ucenter->sendSMSCodeByOrderId($order_id);
				echo json_encode($result, JSON_UNESCAPED_UNICODE);
			break;
		case "see_code":
				$order_id = _g('order_id');

				$result = $ucenter->goodsSeePwd($order_id);
				echo json_encode($result, JSON_UNESCAPED_UNICODE);
			break;
		case "check_acc":
				$order_id = _g('order_id');
				$password = _g('pwd');
				$account = _g('account');
				$name = _g('name');
				$result = curlPostJson($interface_url['net'].'/ValidateAccountInfo',array('account'=>$account,'name'=>$name));
				//$result = json_decode($result,true);
				if($result['IsSuccess']){
					$sms_result = $interface->sendSMSByOrderId($order_id,$password);
					
					if($sms_result['IsSuccess']){
						echo json_encode(array('IsSuccess'=>true,'Message'=>''), JSON_UNESCAPED_UNICODE);
					}else{
						echo json_encode(array('IsSuccess'=>false,'Message'=>'发送失败'), JSON_UNESCAPED_UNICODE);
					}
					
				}else{
					echo json_encode($result, JSON_UNESCAPED_UNICODE);
				}
			break;
		case "change_status":
				$order_id = _g('order_id');
				$recharge_platform = '鑫圣金业';
				$recharge_account = _g('account');
				$name = _g('name');
				$code = _g('code');
				$usetime = time();
				//返回订单信息
				$result = $ucenter->goodsOrderChange($order_id,$code,$recharge_platform,$recharge_account,$usetime);

				if($result['IsSuccess']){
					$orderinfo = $result['data'];
					$result = shop_push_order($interface_url['net'].'/MallChangeRechargeInfo',$result['data'],$recharge_account,$name,$interface_url['pwd']);
					if($result['IsSuccess']){
						$result = $ucenter->goodsOrderChangeStatus($orderinfo);
					}
				}
				logInfo('商城兑换结果,订单号:'.$order_id.'返回结果:'.json_encode($result),'net');
				echo json_encode($result, JSON_UNESCAPED_UNICODE);
			break;
		case "logout":	//登出
				$ucenter->logout();
			break;
		default:

				$page = _g('page');
				$goodsOrderTimeoutClose = $ucenter->goodsOrderTimeoutClose();
				$goodsOrderList = $ucenter->goodsOrderList($page);
				$tpl->assign("result", $goodsOrderList);
				$tpl -> assign('server_name',$server_name[$_SERVER['HTTP_HOST']]);
				$tpl->display("ucenter_goods_order_list.html");
			break;
	}
?>