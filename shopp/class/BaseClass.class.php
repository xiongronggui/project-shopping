<?php
	class BaseClass
	{
		//构造函数
		function __construct()
		{
			//验证是否登录
			$this->isLogin();
		}

		//验证是否登录
		function isLogin()
		{
			$members_id = $_SESSION['members']['info']['id'];
			if(!isset($members_id))
			{
				$this->goToUrl("请先登录！", "index.php");
			}
			else
			{
				return $members_id;
			}
		}

		//网站首页地址补全
		function webinfoUrlStrAdd($url)
		{
			if (substr($url, 0, 7) != "http://" && substr($url, 0, 8) != "https://")
			{
				$url = "http://".$url;
			}
			return $url;
		}
	
		
		//页面跳转
		public function gotoUrl($message='', $url='')
		{
			if ($message)
			{
				echo "<script language=javascript>alert('".$message."');</script>";
			}

			if ($url)
			{
				echo "<script language=javascript>window.location='".$url."';</script>";
			}
			else
			{
				echo "<script language=javascript>history.go(-1);</script>";
			}
			exit();
		}


		//验证码生成及发送
		function createCode($type_id, $mobile)
		{
			global $db;

			$time = time();
			
			if ($mobile)
			{
				$code = rand(100000, 999999);

				//判断是否有该类型验证码
				$sql = "select * from core_user_sms where type_id = $type_id and mobile = '$mobile'"; 
				$result = $db->query($sql) or die($db->error());
				$num = $db->num_rows($result);
				if ($num == 0)
				{
					$sqlcode = "insert into core_user_sms (type_id, mobile, code, sendtime) values ($type_id, '$mobile', '$code', '$time')"; 
				}
				else
				{
					$sqlcode = "update core_user_sms set code = '$code', sendtime = '$time' where type_id = $type_id and mobile = '$mobile'"; 
				}
				
				$resultcode = $db->query($sqlcode) or die($db->error());
				if ($resultcode)
				{
					$send_res = $this->sendSMS($type_id, $mobile, $code);
					if ($send_res == 1)
					{
						$res['IsSuccess'] = true;
						$res['Message'] = "发送成功";
					}
					else
					{
						$res['IsSuccess'] = false;
						$res['Message'] = "发送失败";
					}
				}
			}
			else
			{
				$res['IsSuccess'] = false;
				$res['Message'] = "请输入手机号码";
			}

			return $res;
		}

		//短信发送验证码
		function sendSMS($type_id, $mobile, $code)
		{
			 include SMS_LIB."TopSdk.php";

			$appkey = "24802154";
			$secret = "48af266ccac4d014ff36f29a6e23b504";

			switch($type_id)
			{
				case 0:
						//登录验证
						$sign_name = "鑫圣";
						$temp_code = "SMS_125760046";
					break;
				case 1:
						//注册验证
						$sign_name = "鑫圣";
						$temp_code = "SMS_125805060";
					break;
				case 2:
						//变更验证
						$sign_name = "鑫圣";
						$temp_code = "SMS_126030047";
					break;
				case 3:
						//身份验证
						$sign_name = "鑫圣";
						$temp_code = "SMS_125850070";
					break;
			}

			$c = new TopClient;
			$c->appkey = $appkey;
			$c->secretKey = $secret;
			$req = new AlibabaAliqinFcSmsNumSendRequest;
			$req->setSmsType("normal");
			$req->setSmsFreeSignName($sign_name);
			$req->setSmsParam("{\"code\":\"".$code."\"}");
			$req->setRecNum($mobile);
			$req->setSmsTemplateCode($temp_code);
			$resp = $c->execute($req);
			
			if (!$resp->msg)
			{
				$result = 1;		//发送成功
			}
			else
			{
				$result = 0;		//发送失败
			}

			return $result;
		}

		//短信发送充值密码
		function sendSMSCode($order_id, $password, $mobile, $time)
		{
			include SMS_LIB."TopSdk.php";

			$appkey = "24802154";
			$secret = "48af266ccac4d014ff36f29a6e23b504";

			$sign_name = "鑫圣";
			$temp_code = "SMS_125865060";

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
			
			if (!$resp->msg)
			{
				$result['IsSuccess'] = true;
				$result['Message'] = "发送成功";
			}
			else
			{
				$result['IsSuccess'] = false;
				$result['Message'] = "发送失败";
			}

			return $result;
		}
	}
?>