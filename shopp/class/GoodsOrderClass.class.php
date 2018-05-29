<?php
	require_once 'BaseClass.class.php';

	class GoodsOrderClass extends BaseClass
	{
		//订单提交
		function orderConfirm($order_id, $goods, $images, $price, $usd_rate, $total, $channel, $channel_type = 'bank')
		{
			//echo authcode('+nUDZyKswkY2OBDFngu/GMXdGAuzN8O464vPuJ47/yG54Q');exit;
			global $db;
			$uid = $_SESSION['members']['info']['id'];

			if ($order_id && $goods && $images && $price && $usd_rate && $total && $uid && $channel)
			{
				$addtime = time();

				$source = SOURCE;
				$order_id = SHOPCODE.$order_id;
				
				$sql = "insert into goods_order (order_id, goods, images, price, use_rate, total, uid, addtime, source, channel) values ('$order_id', '$goods', '$images', '$price', '$usd_rate', '$total', $uid, $addtime, '$source', '$channel')";
				$result = $db->query($sql) or die($db->error());
				if ($result)
				{
					$insert_id = $db-> insert_id();
                    if($channel_type == 'quick'){
                        $this->goToUrl("", "goods_order.php?op=quick&id=$insert_id");
                    }
					if($channel_type == 'sel_bank'){
                    	
                        $this->goToUrl("", "goods_order.php?op=bank&id=$insert_id");
                    }
					if($channel == '微信' || $channel == '支付宝'){
                        $data = ['id'=>$insert_id,'order_id'=>$order_id];
                        returnData(1,'',$data);exit;
                    }
					$this->goToUrl("", "goods_order.php?op=order_pay&id=$insert_id");
				}
				else
				{
					$this->goToUrl("订单添加失败！", "goods.php");
				}
			}
			else
			{
				$this->goToUrl("订单信息不完整！", "goods.php");
			}
		}

		//订单支付
		function orderPay($id)
		{
			global $db;

			if ($id)
			{
				$uid = $_SESSION['members']['info']['id'];

				$sql = "select * from goods_order where uid = $uid and id = $id";
				$result = $db->query($sql) or die($db->error());
				$rs = $db->fetch_array($result);
				if ($rs['order_id'])
				{
					$rs['count'] = $rs['price'] / 100;
					$rs['price_show'] = "$ " . number_format($rs['price']/100, 2, ".", "");
					$rs['total_show'] = "￥ " . number_format($rs['total']/100, 2, ".", "");
					$rs['addtime_show'] = date("Y-m-d H:i:s", $rs['addtime']);
					$rs['addtime_show_pay'] = date("YmdHis", $rs['addtime']);
					return $rs;
				}
				else
				{
					$this->goToUrl("订单错误", "goods.php");
				}
			}
			else
			{
				$this->goToUrl("订单错误", "goods.php");
			}
		}

		//商品详细信息
		function goodsGetInfo($id)
		{
			global $db;

			if ($id)
			{
				$sql = "select * from goods where id = $id";
				$result = $db->query($sql) or die($db->error());
				$rs = $db->fetch_array($result);
				$rs['images_show'] = "picfile/goods/".substr($rs["images"], 0, -14)."/images/".$rs["images"];

				return $rs;
			}
			else
			{
				$this->goToUrl("订单错误", "goods.php");
			}
		}

		function Getbankname($banknum)
		{
			global $db;

			$strnum = substr($banknum,0,6);
        	$sql = "select `BankName`,`Code` from core_bankcode where CreditCardValue = $strnum";
        	$result = $db->query($sql) or die($db->error());
        	$rs = $db->fetch_array($result);
        	if(count($rs)){
        		$bankname['name'] = $rs['BankName'];
        		$bankname['code'] = $rs['Code'];
				returnData(true, 'success', $bankname);
        	}
	        returnData(false, 'empty', '');
		}

		function GetOrderInfo($order_id)
		{
			global $db;

			$sql = "select goods_order.*, core_user.mobile from goods_order inner join core_user on goods_order.uid = core_user.id where order_status = 0 and order_id = '$order_id'";
			$result = $db->query($sql) or die($db->error());
			$rs = $db->fetch_array($result);
			if(!$rs){
				echo 'error';
				exit;
			}

			$paytime = time();
			$password = mt_rand(10000000, 99999999);
			$pwd = authcode($password, "ENCODE");
			$sqlu = "update goods_order set paytime = $paytime, pwd = '$pwd', order_status = 1 where order_id = '$order_id'";
			$resultu = $db->query($sqlu) or die($db->error());
			if ($resultu)
			{
				include SMS_LIB."TopSdk.php";

				$appkey = "24802154";
				$secret = "48af266ccac4d014ff36f29a6e23b504";

				$sign_name = "鑫圣";
				$temp_code = "SMS_125865060";

				$time = date("Y-m-d H:i", $rs['addtime']);
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
			}
		}
		
		function orderConfirmAjax($order_id, $goods, $images, $price, $usd_rate, $total, $channel='人工支付', $channel_type = 'bank')
		{
			global $db;
			$uid = $_SESSION['members']['info']['id'];

			if ($order_id && $goods && $images && $price && $usd_rate && $total && $uid && $channel)
			{
				$addtime = time();

				$source = SOURCE;
				
				$order_id = SHOPCODE.$order_id;
				
				$sql = "insert into goods_order (order_id, goods, images, price, use_rate, total, uid, addtime, source, channel) values ('$order_id', '$goods', '$images', '$price', '$usd_rate', '$total', $uid, $addtime, '$source', '$channel')";
				//$result = $db->query($sql) or die($db->error());
				$result = $db->query($sql);
				if ($result)
				{
					$insert_id = $db-> insert_id();
					$data['id'] = $insert_id;
					$data['uid'] = $uid;
                    if($channel_type == 'quick'){
                        //$this->goToUrl("", "goods_order.php?op=quick&id=$insert_id");
						returnData(true, 'success', $data);
                    }
                    if($channel_type == 'sel_bank'){
                    	
                        //$this->goToUrl("", "goods_order.php?op=bank&id=$insert_id");
						returnData(true, 'success', $data);
                    }
					//$this->goToUrl("", "goods_order.php?op=order_pay&id=$insert_id");
					returnData(true, 'success', $data);
				}
				else
				{
					//$this->goToUrl("订单添加失败！", "goods.php");
					returnData(false, '订单添加失败', '');
				}
			}
			else
			{
				//$this->goToUrl("订单信息不完整！", "goods.php");
				returnData(false, '订单信息不完整！', '');
			}
		}
		
		//查询订单是否已经支付
        public function is_pay_order($orderNo)
        {
            // TODO: Implement __sleep() method.
            global $db;
			//$sql = "select order_status from goods_order  where   order_id = '$orderNo'";
            $sql = "select order_status from goods_order  where order_status=1 and  order_id = '$orderNo'";
            //$result = $db->query($sql) or die($db->error());
            $result = $db->query($sql);
            $rs = $db->fetch_array($result);
            if($rs){
                returnData(1,'',$rs['order_status']);
            }
            returnData(0,'',$rs);
        }
	}
?>