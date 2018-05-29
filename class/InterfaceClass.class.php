<?php
    require_once 'include/common.php';
	require_once 'BaseClass.class.php';

	class InterfaceClass extends BaseClass
	{
		//构造函数
		function __construct() { }

		//订单有效性验证
		function checkOrderId($order_id, $password)
		{
			global $db;
			if ($order_id && $password)
			{
				$pwd = authcode($password, "ENCODE");

				$sql = "select goods_order.*, core_user.mobile from goods_order inner join core_user on goods_order.uid = core_user.id where goods_order.order_id = '$order_id' and goods_order.pwd = '$pwd'";
				$result = $db->query($sql) or die($db->error());
				$rs = $db->fetch_array($result);
				if ($rs['order_id'])
				{
					if ($rs['usetime']>0)
					{
						$arr['IsSuccess'] = false;
						$arr['Message'] = "该订单已经兑换";
					}
					else
					{
						$arr['IsSuccess'] = true;
						$rs['price_show'] = "$ " . number_format($rs['price']/100, 2);
						$arr['Message']['price'] = $rs['price_show'];
						$arr['Message']['mobile'] = $rs['mobile'];
					}
				}
				else
				{
					$arr['IsSuccess'] = false;
					$arr['Message'] = "订单或密码错误";
				}
			}
			else
			{
				$arr['IsSuccess'] = false;
				$arr['Message'] = "请输入完整的信息";
			}
			logInfo("checkOrderId:".json_encode($arr));
			return $arr;
		}

		//充值验证短信发送
		function sendSMSByOrderId($order_id, $password)
		{
			global $db;
			
			if ($order_id && $password)
			{
				$res = $this->checkOrderId($order_id, $password);
				if ($res['IsSuccess'] == 1)
				{
					$type_id = 3;
					$mobile = $res['Message']['mobile'];
					$arr = $this->createCode($type_id, $mobile);
				}
				else
				{
					$arr['IsSuccess'] = false;
					$arr['Message'] = "订单或密码错误";
				}
			}
			else
			{
				$arr['IsSuccess'] = false;
				$arr['Message'] = "请输入完整的信息";
			}
			logInfo("sendSMSByOrderId:".json_encode($arr));
			return $arr;
		}

		//充值验证
		function rechargeOrderId($order_id, $password, $code)
		{
			global $db;
			
			if ($order_id && $password && $code)
			{
				$pwd = authcode($password, "ENCODE");

				$sql = "select goods_order.*, core_user.mobile, core_user.people_id from goods_order inner join core_user on goods_order.uid = core_user.id where goods_order.order_id = '$order_id' and goods_order.pwd = '$pwd' and goods_order.usetime = 0";
				$result = $db->query($sql) or die($db->error());
				$rs = $db->fetch_array($result);
				if ($rs['order_id'])
				{
					$type_id = 3;
					$realtime = time() - 600;
					$mobile = $rs['mobile'];
					$sqls = "select * from core_user_sms where type_id = $type_id and mobile = '$mobile' and code = '$code' and sendtime >= $realtime"; 
					$results = $db->query($sqls) or die($db->error());
					$nums = $db->num_rows($results);
					if ($nums)
					{
						$arr['IsSuccess'] = true;
						unset($rs['pwd']);
						$rs['price'] = number_format($rs['price']/100,2);
						$rs['total'] = number_format($rs['total']/100,2);
						$arr['Message'] = $rs;
					}
					else
					{
						$arr['IsSuccess'] = false;
						$arr['Message'] = "验证码错误";
					}
				}
				else
				{
					$arr['IsSuccess'] = false;
					$arr['Message'] = "订单或密码错误";
				}
			}
			else
			{
				$arr['IsSuccess'] = false;
				$arr['Message'] = "请输入完整的信息";
			}
			logInfo("rechargeOrderId:".json_encode($arr));
			return $arr;
		}

		//充值完成状态修改
		function changeCodeStatus($order_id, $password, $recharge_platform,$usetime = '',$recharge_account = '', $recharge_total ='')
		{
			global $db;
			logInfo("changeCodeStatus->订单号:".$order_id.',密码:'.$password.',平台:'.$recharge_platform);
			if ($order_id)
			{
				$pwd = authcode($password, "ENCODE");

				$sql = "select goods_order.*, core_user.mobile from goods_order inner join core_user on goods_order.uid = core_user.id where goods_order.order_id = '$order_id' and goods_order.pwd = '$pwd' and goods_order.usetime = 0";
				$result = $db->query($sql) or die($db->error());
				$rs = $db->fetch_array($result);
				logInfo("changeCodeStatus:".json_encode($rs));
				if ($rs['order_id'])
				{
					$type_id = 3;
					$realtime = time() - 600;
					$mobile = $rs['mobile'];
					$total = $rs['total'];
					/*$sqls = "select * from core_user_sms where type_id = $type_id and mobile = '$mobile' and code = '$code' and sendtime >= $realtime"; 
					$results = $db->query($sqls) or die($db->error());
					$nums = $db->num_rows($results);
					logInfo("changeCodeStatus:".$nums);*/
					//if ($nums)
					//{
						//$usetime = time();
						$sqlu = "update goods_order set recharge_platform = '$recharge_platform',recharge_account='$recharge_account',recharge_total='$total', usetime = $usetime where order_id = '$order_id'"; 
						$resultu = $db->query($sqlu) or die($db->error());
						logInfo("changeCodeStatus:".$sqlu);
						if ($resultu)
						{
							$arr['IsSuccess'] = true;
							$arr['Message'] = '';
						}
						else
						{
							$arr['IsSuccess'] = false;
							$arr['Message'] = '更改兑换状态失败';
						}
					/*}
					else
					{
						$arr['IsSuccess'] = false;
						$arr['Message'] = '验证手机与验证码不匹配';
					}*/
				}
				else
				{
					$arr['IsSuccess'] = false;
					$arr['Message'] = '订单号不存在';
				}
			}
			else
			{
				$arr['IsSuccess'] = false;
				$arr['Message'] = "请输入完整的信息";
			}
			logInfo("changeCodeStatus:".json_encode($arr));
			return $arr;
		}
	}
?>