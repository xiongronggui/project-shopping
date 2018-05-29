<?php
	require_once 'include/common.php';
	require_once (ADMIN_CLASS_DIR."GoodsClass.class.php");

	$goods = new GoodsClass;

	$a = _g('op');
	switch ($a)
	{
		case 'add':
				$sellTypeList = $goods->sellTypeList();
				$tpl->assign("result", $sellTypeList);
				$tpl->display("goods_add.html");
			break;
		case 'del':
				$id = _g('id');
				$goods->goodsDel($id);
			break;
		case 'update':
				$id = _g('id');
				$goodsInfo = $goods->goodsGetInfo($id);
				if ($goodsInfo['images'])
				{
					$url = "../picfile/goods/".substr($goodsInfo["images"], 0, -14)."/images/".$goodsInfo["images"];
					$goodsInfo['images_show'] = "<img src='$url' class='pic1' />";
				}
				else
				{
					$goodsInfo['images_show'] = "";
				}
				
				$tpl->assign("info", $goodsInfo);

				$sellTypeList = $goods->sellTypeList($goodsInfo['sell_type']);
				$tpl->assign("result", $sellTypeList);
				$tpl->display("goods_update.html");
			break;
		case 'save':
				include_once (INCLUDE_DIR."upload_image_class.php");
				include_once (INCLUDE_DIR."image.class.php");

				$t = _g('t');
				$title = _g('title');
				$tid = $_POST['tid'];
				$content = _g('content');
				$operator_id = $_SESSION['admin']['info']['id'];
				$status = _g('status');
				$upload_dir = "../picfile/goods/";

				if ($_FILES['images']['tmp_name'] != "")
				{
					$goods->imagesUploadSizeCheck($_FILES['images']['tmp_name'], 420, 420);
					$image = new upload_image();
					$time = time();
					$str = $image->up_image($_FILES['images'], $time, $upload_dir);
					if ($str != '')
					{
						$goods->gotoUrl("图片格式错误，上传失败！");
					}
					else 
					{
						$images = $image->set_new_name();
						if (!$images)
						{
							$goods->gotoUrl("图片上传失败！");
						}
					}
				}
				else
				{
					$images = "";
				}


				if ($t == 'add')
				{
					$goods->goodsAdd($title, $tid, $images, $content, $operator_id, $status);
				}
				else if ($t == 'update')
				{
					$id = _g('id');
					$goods->goodsUpdate($id, $title, $tid, $images, $content, $operator_id, $status);
				}
			break;
		default:
				$goodsList = $goods->goodsList();
				$tpl->assign("result", $goodsList);
				$tpl->display("goods_list.html");
			break;
	}
?>