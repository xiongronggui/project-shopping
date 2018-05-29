<?php
	class BaseClass
	{
		//构造函数
		function __construct()
		{
			//验证是否登录
			$this->isLogin();
			//验证是否有权限
			$this->isAction();
			//获取权限
			$this->actionTreeList($_SESSION['admin']['info']['aid']);
		}

		//验证是否登录
		function isLogin()
		{
			$admin_id = $_SESSION['admin']['info']['id'];
			if(!isset($admin_id))
			{
				$this->goToUrl("请先登录！", "index.php");
			}
			else
			{
				return $admin_id;
			}
		}

		//验证是否有权限
		function isAction()
		{
			global $db;
			$page = explode("/", $_SERVER['PHP_SELF']);
			$url = $page[count($page) - 1];

			$white = array(
				"admin_password.php"
			);

			if (!in_array($url, $white))
			{
				$sql = "select id from core_admin_action where url = '$url'";
				$result = $db->query($sql) or die($db->error());
				$rs = $db->fetch_array($result);
				$action = explode("|", $_SESSION['admin']['info']['aid']);
				if (!in_array($rs['id'], $action))
				{
					$this->goToUrl("您无权访问该页面！"); 
				}
				else
				{
					$_SESSION['admin']['now_page'] = $url;
				}
			}
			else
			{
				$_SESSION['admin']['now_page'] = $url;
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

		//菜单树
		function actionTreeList($aid='')
		{
			global $db;
			$action = explode("|", $aid);
			$sql = "select * from core_admin_action where fid = 0 and status = 0 order by `index` desc, id";
			$result = $db->query($sql) or die($db->error());
			while ($rs = $db->fetch_array($result))
			{
				$rss_result = "";
				$father = 0;
				$sqls = "select * from core_admin_action where fid = ".$rs['id']." and status = 0 order by `index` desc, id";
				$results = $db->query($sqls) or die($db->error());
				while ($rss = $db->fetch_array($results))
				{
					if (in_array($rss['id'], $action))
					{
						$checked = "checked";
					}
					else
					{
						$checked = "";
					}
					$rss['checked'] = $checked;
					$rss_result[] = $rss;
				}

				if ($rss_result)
				{
					foreach ($rss_result as $key=>$val)
					{
						if ($val['checked'] == "checked")
						{
							$father = 1;
						}
					}
				}

				if ($father == 1)
				{
					$rs['son'] = $rss_result;
					$rs_result[] = $rs; 
				}
				else
				{
					unset($rs);
				}
			}
			$db->free_result($result);
			$_SESSION['admin']['action'] = $rs_result;
			return $rs_result;
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
		
		//图片尺寸验证
		function imagesUploadSizeCheck($img, $width, $height = 70)
		{
			$imagesize = getimagesize($img);
			$check = 'width="' . $width . '" height="' . $height . '"';
			if ($check != $imagesize[3])
			{
				$this->gotoUrl("图片尺寸必须为" . $width . "px * " . $height . "px！");
			}
		}

		//通过用户编号获得用户组编号
		function adminGetGroupId($admin_id)
		{
			global $db;
			$sql = "select * from core_admin where id = $admin_id";
			$result = $db->query($sql) or die($db->error());
			$rs = $db->fetch_array($result);
			return $rs['group_id'];
		}

		//二维码生成
		function qrcodeCreate($sub_mch_id, $internal_No)
		{
			require_once  (INCLUDE_DIR."phpqrcode.php");
			
			$dir = "qrcode_images/";

			if (!is_dir($dir)) 
			{
				$oldmask = umask(0);
				mkdir($dir, 0777);
				umask($oldmask);
			}

			$errorCorrectionLevel = 'H';//容错级别 
			$matrixPointSize = 7;//生成图片大小 
			//生成二维码图片 
			QRcode::png(QRCODE_WEB."pay.php?sub_mch_id=".$sub_mch_id, 'qrcode.png', $errorCorrectionLevel, $matrixPointSize, 3); 

			$width = "150";
			$height = "25";

			$QR = 'qrcode.png';//已经生成的原始二维码图 
			$logo = 'qrcode_logo.png';//准备好的logo图片 
			
			if ($logo !== FALSE && $code !== FALSE) 
			{ 
				$QR = imagecreatefromstring(file_get_contents($QR)); 
				$logo = imagecreatefromstring(file_get_contents($logo)); 
				$QR_width = imagesx($QR);//二维码图片宽度 
				$QR_height = imagesy($QR);//二维码图片高度
				$logo_width = imagesx($logo);//logo图片宽度 
				$logo_height = imagesy($logo);//logo图片高度

				$logo_qr_width = $QR_width / 5;   
				$scale = $logo_width/$logo_qr_width;   
				$logo_qr_height = $logo_height/$scale;   
				$from_width = ($QR_width - $logo_qr_width) / 2;  
	
				imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);   
			} 

			//输出图片 
			$result = imagepng($QR, $dir.$internal_No.'.png');
			return $result;
		}
	}
?>