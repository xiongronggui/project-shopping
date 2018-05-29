<?php
	require_once 'BaseClass.class.php';

	class UCenterClass extends BaseClass
	{
		//订单查看
		function goodsOrderList($page)
		{
			include_once (INCLUDE_DIR."page_class.php");

			global $db;

			$uid = $_SESSION['members']['info']['id'];

			(!isset($page) || $page == '' || !is_numeric($page)) && $page = 1;
			$sql = "select * from goods_order where uid = $uid and del_status = 0";
			$result= $db->query($sql) or die($db->error());
			$nums = (mysql_num_rows($result));
			$each_disNums = 5;
			$current_page = $page;
			$current_num = 1;
			$sub_pages = 5;
			$offest = ($page - 1) * $each_disNums;
			$subPage_link = "ucenter.php?page=";
			$subPage_type = 2;
			$sub_page = new SubPages($each_disNums,$nums,$current_page,$sub_pages,$subPage_link,$subPage_type);
			$page_info = $sub_page->show_SubPages(2);
			$sqlc = "select * from goods_order where uid = $uid and del_status = 0 order by id desc limit ". $offest .",".$each_disNums;
			$resultc= $db->query($sqlc) or die($db->error());
			while($rs = $db->fetch_array($resultc))
			{
				$rs['images_show'] = "picfile/goods/".substr($rs["images"], 0, -14)."/images/".$rs["images"];
				$rs['count'] = $rs['total']/100;
				$rs['price_show'] = "$ " . number_format($rs['price']/100, 2, ".", "");
				$rs['total_show'] = "￥ " . number_format($rs['total']/100, 2, ".", "");
			
				$rs['addtime_show'] = date("Y-m-d", $rs['addtime']);

				if ($rs['paytime'])
				{
					$rs['paytime_show'] = date("Y-m-d H:i", $rs['paytime']);
				}
				else
				{
					$rs['paytime_show'] = "";
				}

				switch($rs['order_status'])
				{
					case 0:
							$rs['order_code'] = '--';
							$rs['order_status_show'] = "未支付";
							$rs['button'] = "<a class=\"nowPay\" href=\"goods_order.php?op=order_pay&id=".$rs['id']."\">立即付款</a><a href=\"ucenter.php?op=goods_order_close&order_id=".$rs['order_id']."\" onclick=\"return confirm('您确定要关闭该订单吗？');\" class=\"closeOrder\" >关闭订单</a>";
							//$rs['button'] = "<a class=\"nowPay\" href=\"javascript:;\">待付款</a><a href=\"ucenter.php?op=goods_order_close&order_id=".$rs['order_id']."\" onclick=\"return confirm('您确定要关闭该订单吗？');\" class=\"closeOrder\" >关闭订单</a>";
						break;
					case 1:
							$rs['order_code'] = '*******';
							$rs['order_status_show'] = "已支付";
							if (!$rs['usetime'])
							{
								$rs['button'] = "<a href=\"javascript:void(0);\" onclick=\"send_sms_code('".$rs['order_id']."')\" class=\"sendPwd\">补发兑换码</a>";
							}
							else
							{
								$rs['button'] = "已充值";
							}
						break;
					case 2:
							$rs['order_code'] = '--';
							$rs['order_status_show'] = "已关闭";
							$rs['button'] = "<a  class=\"deleteOrder\" href=\"ucenter.php?op=goods_order_del&order_id=".$rs['order_id']."\" onclick=\"return confirm('您确定要删除该订单吗？');\" class=\"deleteOrder\">删除订单</a>";
						break;
				}

				if ($rs['usetime'])
				{
					$rs['usetime_show'] = date("Y-m-d H:i:s", $rs['usetime']);
				}
				else
				{
					$rs['usetime_show'] = "";
				}

				$rs_result[] = $rs; 
			}
			$db->free_result($result);
			
			$arr['nums'] = $nums;
			$arr['result'] = $rs_result;
			$arr['page_info'] = $page_info;
			return $arr;
		}

		//根据订单发送密码
		function sendSMSCodeByOrderId($order_id)
		{
			global $db;
			
			if ($order_id)
			{
				$sql = "select goods_order.*, core_user.mobile from goods_order inner join core_user on goods_order.uid = core_user.id where order_id = '$order_id' and order_status = 1 and usetime = 0"; 
				$result = $db->query($sql) or die($db->error());
				$rs = $db->fetch_array($result);
				if ($rs['order_id'])
				{
					$order_id = $rs['order_id'];
					$password = authcode($rs['pwd'], "DECODE");
					$mobile = $rs['mobile'];
					$time = date("Y-m-d H:i", $rs['paytime']);
					$res = $this->sendSMSCode($order_id, $password, $mobile, $time);
				}
				else
				{
					$res['IsSuccess'] = false;
					$res['Message'] = "订单错误";
				}
			}
			else
			{
				$res['IsSuccess'] = false;
				$res['Message'] = "订单编号错误";
			}

			return $res;
		}

		/*
		* 查看兑换码
		*/
		function goodsSeePwd($order_id)
		{
			global $db;
			
			if ($order_id)
			{
				$sql = "select order_id,pwd from goods_order inner join core_user on goods_order.uid = core_user.id where order_id = '$order_id' and order_status = 1 and usetime = 0"; 
				$result = $db->query($sql) or die($db->error());
				$rs = $db->fetch_array($result);
				if ($rs['order_id'])
				{
					$order_id = $rs['order_id'];
					$password = authcode($rs['pwd'], "DECODE");
					$res['IsSuccess'] = true;
					$res['Message'] = $password;
				}
				else
				{
					$res['IsSuccess'] = false;
					$res['Message'] = "订单错误";
				}
			}
			else
			{
				$res['IsSuccess'] = false;
				$res['Message'] = "订单编号错误";
			}

			return $res;
		}
		
		//指定订单关闭
		function goodsOrderClose($order_id)
		{
			global $db;

			if ($order_id)
			{
				$sql="update goods_order set order_status = 2 where order_id = '$order_id'";
				$result = $db->query($sql) or die($db->error());
				if ($result)
				{
					$this->goToUrl("订单关闭成功！", "ucenter.php");
				}
				else
				{
					$this->gotoUrl("订单关闭失败！", "ucenter.php");
				}
			}
			else
			{
				$this->gotoUrl("订单编号错误！", "ucenter.php");
			}
		}

		//过期订单关闭
		function goodsOrderTimeoutClose()
		{
			global $db;

			$time = time() - 900;
			$sql="update goods_order set order_status = 2 where addtime < $time and paytime = 0";
			$result = $db->query($sql) or die($db->error());
		}

		//订单删除
		function goodsOrderDel($order_id)
		{
			global $db;

			if ($order_id)
			{
				$sql="update goods_order set del_status = 1 where order_id = '$order_id'";
				$result = $db->query($sql) or die($db->error());
				if ($result)
				{
					$this->goToUrl("订单删除成功！", "ucenter.php");
				}
				else
				{
					$this->gotoUrl("订单删除失败！", "ucenter.php");
				}
			}
			else
			{
				$this->gotoUrl("订单编号错误！", "ucenter.php");
			}
		}

		//修改密码
		function pwdModify($mobile, $type_id, $code, $password)
		{
			global $db;
			if (!preg_match("/^[a-zA-Z0-9]{6,12}$/", $password))
			{
				$this->goToUrl("密码格式不正确，请输入6-12位数字+字母组合！");
				die();
			}

			if ($mobile && $code && $password)
			{
				$realtime = time() - 600;
				$sqls = "select * from core_user_sms where type_id = $type_id and mobile = '$mobile' and code = '$code' and sendtime >= $realtime"; 
				$results = $db->query($sqls) or die($db->error());
				$nums = $db->num_rows($results);
				if (!$nums)
				{
					$this->goToUrl("验证码错误！");
					die();
				}
				
				//修改密码开始
				$pwd = md5($password);
				$sql = "update core_user set password = '$pwd' where mobile = '$mobile'";
				$result = $db->query($sql) or die($db->error());
				if ($result)
				{
					$this->goToUrl("密码修改成功！", "ucenter.php");
				}
				else
				{
					$this->goToUrl("密码修改失败！");
				}
			}
			else
			{
				$this->goToUrl("请输入完整的密码找回信息！");
			}
		}

		//退出登录
		function logout()
		{
			unset($_SESSION['members']);
			$this->goToUrl("你已成功注销本次登陆！", "goods.php");
		}
	}
?>