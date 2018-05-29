<?php
	require_once 'BaseClass.class.php';

	class GoodsClass extends BaseClass
	{
		//商品增加
		function goodsAdd($title, $tid, $images, $content, $operator_id, $status)
		{
			global $db;
			if ($title && $tid && $images && $content && $operator_id)
			{
				$sell_type = implode("|", $tid);
				$mtime = time();
				$sql = "insert into goods (title, sell_type, images, content, operator_id, mtime, status) values ('$title', '$sell_type', '$images', '$content', $operator_id, $mtime, $status)";
				$result = $db->query($sql) or die($db->error());
				if ($result)
				{
					$this->goToUrl("添加成功！", "goods.php"); 
				}
				else
				{
					$this->gotoUrl("添加失败！");
				}
			}
			else
			{
				$this->gotoUrl("请确认信息是否完整！");
			}
		}

		//商品删除
		function goodsDel($id)
		{
			global $db;
			$sql = "delete from goods where id = $id";
			$result = $db->query($sql) or die($db->error());
			if($result)
			{
				$this->gotoUrl("删除成功！");
			}
			else
			{
				$this->gotoUrl("删除失败！");
			}
		}

		//商品修改
		function goodsUpdate($id, $title, $tid, $images, $content, $operator_id, $status)
		{
			global $db;

			if ($id && $title && $tid && $content && $operator_id)
			{
				$sell_type = implode("|", $tid);
				$mtime = time();
				if ($images)
				{
					$img_con = " images = '$images',";
				}

				$sql = "update goods set title = '$title', sell_type = '$sell_type',".$img_con." content = '$content', operator_id = $operator_id, mtime = $mtime, status = $status where id = $id";
				$result = $db->query($sql) or die($db->error());
				if ($result)
				{
					$this->goToUrl("修改成功！", "goods.php"); 
				}
				else
				{
					$this->gotoUrl("修改失败！");
				}
			}
			else
			{
				$this->gotoUrl("请确认信息是否完整！");
			}
		}

		//商品查看
		function goodsList()
		{
			global $db;

			$sql = "select goods.*, core_admin.realname from goods inner join core_admin on goods.operator_id = core_admin.id order by goods.id";
			$result = $db->query($sql) or die($db->error());
			while ($rs = $db->fetch_array($result))
			{
				if ($rs['images'])
				{
					$url = "../picfile/goods/".substr($rs["images"], 0, -14)."/images/".$rs["images"];
					$rs['images_show'] = "<a href='$url' target='_blank'>点击查看</a>";
				}
				else
				{
					$rs['images_show'] = "暂无图片";
				}

				$rs['mtime_show'] = date("Y-m-d H:i:s", $rs['mtime']);

				if ($rs['status'] == 0)
				{
					$rs['status_show'] = "正常";
				}
				else
				{
					$rs['status_show'] = "停用";
				}

				$rs_result[] = $rs; 
			}
			$db->free_result($result);
			return $rs_result;
		}

		//商品详细信息
		function goodsGetInfo($id)
		{
			global $db;
			$sql = "select * from goods where id = $id";
			$result = $db->query($sql) or die($db->error());
			$rs = $db->fetch_array($result);
			$rs_result = $rs; 
			return $rs_result;
		}

		//售价查看
		function sellTypeList($tid='')
		{
			global $db;

			if ($tid)
			{
				$sell_type = explode("|", $tid);
			}

			$sql = "select * from sell_type order by id";
			$result = $db->query($sql) or die($db->error());
			while ($rs = $db->fetch_array($result))
			{
				if ($tid)
				{
					if (in_array($rs['price'], $sell_type))
					{
						$rs['checked'] = "checked";
					}
				}
				
				$rs_result[] = $rs; 
			}
			$db->free_result($result);
			return $rs_result;
		}

		//订单列表
		function goodsOrderList($page, $keys='', $order_status, $use_status, $price_start='', $price_end='', $paytime_start='', $paytime_end='', $usetime_start='', $usetime_end='')
		{
			include_once (INCLUDE_DIR."page_class.php");

			global $db;

			$page = $page ? $page : 1;

			$url_price_start = $price_start ? "&price_start=" . $price_start : "";
			$url_price_end = $price_end ? "&price_end=" . $price_end : "";
			$url_paytime_start = $paytime_start ? "&paytime_start=" . $paytime_start : "";
			$url_paytime_end = $paytime_end ? "&paytime_end=" . $paytime_end : "";
			$url_usetime_start = $usetime_start ? "&usetime_start=" . $usetime_start : "";
			$url_usetime_end = $usetime_end ? "&usetime_end=" . $usetime_end : "";
			$url_order_status = $order_status ? "&order_status=" . $order_status : "";
			$url_use_status = $use_status ? "&use_status=" . $use_status : "";
			$url_keys = $keys ? "&keys=" . $keys : "";
			$para = $url_price_start . $url_price_end . $url_paytime_start . $url_paytime_end . $url_usetime_start . $url_usetime_end . $url_order_status . $url_use_status . $url_keys;

			if ($para)
			{
				$param = "?" . substr($para, 1);
			}

			$price_start = $price_start ? $price_start * 100 : "";															//充入值低
			$price_end = $price_end ? $price_end * 100 : "";															//充入值高

			$paytime_start = $paytime_start ? strtotime($paytime_start) : "";										//订单成交日期开始
			$paytime_end = $paytime_end ? strtotime($paytime_end) + 86400 : "";						//订单成交日期结束

			$usetime_start = $usetime_start ? strtotime($usetime_start) : "";										//订单兑换日期开始
			$usetime_end = $usetime_end ? strtotime($usetime_end) + 86400 : "";						//订单兑换日期结束
			
			if ($price_start && $price_start)
			{
				if ($price_start > $price_end || $price_start < 0 || $price_end < 0)
				{
					$this->goToUrl("价格范围错误！"); 
				}
			}
			
			if ($paytime_start && $paytime_end)
			{
				if ($paytime_start >= $paytime_end)
				{
					$this->goToUrl("订单成交日期范围错误！"); 
				}
			}
			
			if ($usetime_start && $usetime_end )
			{
				if ($usetime_start >= $usetime_end )
				{
					$this->goToUrl("订单兑换日期范围错误！"); 
				}
			}

			if ($keys)
			{
				$conn .= " and (order_id like '%$keys%' or mobile like '%$keys%' or realname like '%$keys%')";
			}

			if ($order_status != -1)
			{
				$conn .= " and order_status = $order_status";
			}

			if ($use_status == 0)
			{
				$conn .= " and usetime = 0";
			}
			elseif ($use_status == 1)
			{
				$conn .= " and usetime <> 0";
			}

			if ($price_start)
			{
				$conn .= " and price >= $price_start";
			}

			if ($price_end)
			{
				$conn .= " and price <= $price_end";
			}
			
			//订单成交时间
			if ($paytime_start)
			{
				$conn .= " and paytime >= $paytime_start";
			}

			if ($paytime_end)
			{
				$conn .= " and paytime < $paytime_end";
			}
			
			//订单兑换时间
			if ($usetime_start)
			{
				$conn .= " and usetime <> 0 and usetime >= $usetime_start";
			}

			if ($usetime_end)
			{
				$conn .= " and usetime <> 0 and usetime < $usetime_end";
			}

			$sql = "select goods_order.*, core_user.mobile, core_user.realname from goods_order inner join core_user on goods_order.uid = core_user.id where 1 = 1". $conn;
			$result = $db->query($sql) or die($db->error());
			$nums = (mysql_num_rows($result));
			$each_disNums = 30;
			$current_page = $page;
			$current_num = 1;
			$sub_pages = 10;
			$offest = ($page - 1) * $each_disNums;
			$subPage_link = "goods_order.php". $param . "&page=";
			$subPage_type = 2;
			$sub_page = new SubPages($each_disNums,$nums,$current_page,$sub_pages,$subPage_link,$subPage_type);
			$page_info = $sub_page->show_SubPages(2);
			$sqlc = "select goods_order.*, core_user.mobile, core_user.realname from goods_order inner join core_user on goods_order.uid = core_user.id where 1 = 1" . $conn . " order by goods_order.order_id desc limit ". $offest .",".$each_disNums;
			$resultc = $db->query($sqlc) or die($db->error());
			while($rs = $db->fetch_array($resultc))
			{
				$rs['price_show'] = "$" . number_format($rs['price']/100, 2, ".", "");
				$rs['total_show'] = "￥" . number_format($rs['total']/100, 2, ".", "");

				$rs['addtime_show'] = date("Y-m-d H:i:s", $rs['addtime']);

				if ($rs['paytime'])
				{
					$rs['paytime_show'] = date("Y-m-d H:i:s", $rs['paytime']);
				}
				else
				{
					$rs['paytime_show'] = "";
				}

				switch($rs['order_status'])
				{
					case 0:
							$rs['order_status_show'] = "<span style='color:#FF0000; font-weight:bold;'>未支付</span>";
						break;
					case 1:
							$rs['order_status_show'] = "<span style='color:#009933; font-weight:bold;'>已支付</span>";
						break;
					case 2:
							$rs['order_status_show'] = "<span style='color:#999999; font-weight:bold;'>已关闭</span>";
						break;
				}

				if ($rs['usetime'])
				{
					$rs['usetime_show'] = date("Y-m-d H:i:s", $rs['usetime']);
					$rs['use_status_show'] = "<span style='color:#009933; font-weight:bold;'>已兑换</span>";
				}
				else
				{
					$rs['usetime_show'] = "";
					$rs['use_status_show'] = "<span style='color:#FF0000; font-weight:bold;'>未兑换</span>";
				}

				$rs_result[] = $rs; 
			}
			$db->free_result($result);

			$yestoday = strtotime(date("Y-m-d",strtotime("-1 day")));
			$today = strtotime(date("Y-m-d"));
			$tomorrow = strtotime(date("Y-m-d",strtotime("+1 day")));
			
			//昨天订单总笔数
			$sql_order_yestoday = "select count(*) as count, sum(price) as price, sum(total) as total from goods_order where order_status = 1 and paytime >= $yestoday and paytime < $today";
			$result_order_yestoday = $db->query($sql_order_yestoday) or die($db->error());
			$rs_order_yestoday = $db->fetch_array($result_order_yestoday);
			
			//今天订单总笔数
			$sql_order_today = "select count(*) as count, sum(price) as price, sum(total) as total from goods_order where order_status = 1 and paytime >= $today and paytime < $tomorrow";
			$result_order_today = $db->query($sql_order_today) or die($db->error());
			$rs_order_today = $db->fetch_array($result_order_today);

			//订单总笔数
			$sql_order_statistics = "select count(*) as count, sum(price) as price, sum(total) as total from goods_order inner join core_user on goods_order.uid = core_user.id where 1 = 1". $conn;
			$result_order_statistics = $db->query($sql_order_statistics) or die($db->error());
			$rs_order_statistics = $db->fetch_array($result_order_statistics);

			$arr['order_yestoday_statistics'] = $rs_order_yestoday['count'];
			$arr['price_yestoday_statistics'] = "$ " . number_format($rs_order_yestoday['price']/100, 2, ".", "");
			$arr['total_yestoday_statistics'] = "￥ " . number_format($rs_order_yestoday['total']/100, 2, ".", "");

			$arr['order_today_statistics'] = $rs_order_today['count'];
			$arr['price_today_statistics'] = "$ " . number_format($rs_order_today['price']/100, 2, ".", "");
			$arr['total_today_statistics'] = "￥ " . number_format($rs_order_today['total']/100, 2, ".", "");
		
			$arr['order_statistics'] = $rs_order_statistics['count'];
			$arr['price_statistics'] = "$ " . number_format($rs_order_statistics['price']/100, 2, ".", "");
			$arr['total_statistics'] = "￥ " . number_format($rs_order_statistics['total']/100, 2, ".", "");
			$arr['nums'] = $nums;
			$arr['result'] = $rs_result;
			$arr['page_info'] = $page_info;
			return $arr;
		}


		//订单列表-生成Excel
		function goodsOrderListExcel($keys='', $order_status, $use_status, $price_start='', $price_end='', $paytime_start='', $paytime_end='', $usetime_start='', $usetime_end='')
		{
			global $db;

			$price_start = $price_start ? $price_start * 100 : "";															//充入值低
			$price_end = $price_end ? $price_end * 100 : "";															//充入值高

			$paytime_start = $paytime_start ? strtotime($paytime_start) : "";										//订单成交日期开始
			$paytime_end = $paytime_end ? strtotime($paytime_end) + 86400 : "";						//订单成交日期结束

			$usetime_start = $usetime_start ? strtotime($usetime_start) : "";										//订单兑换日期开始
			$usetime_end = $usetime_end ? strtotime($usetime_end) + 86400 : "";						//订单兑换日期结束
			
			if ($price_start && $price_start)
			{
				if ($price_start > $price_end || $price_start < 0 || $price_end < 0)
				{
					$this->goToUrl("价格范围错误！"); 
				}
			}
			
			if ($paytime_start && $paytime_end)
			{
				if ($paytime_start >= $paytime_end)
				{
					$this->goToUrl("订单成交日期范围错误！"); 
				}
			}
			
			if ($usetime_start && $usetime_end )
			{
				if ($usetime_start >= $usetime_end )
				{
					$this->goToUrl("订单兑换日期范围错误！"); 
				}
			}

			if ($keys)
			{
				$conn .= " and (order_id like '%$keys%' or mobile like '%$keys%' or realname like '%$keys%')";
			}

			if ($order_status != -1)
			{
				$conn .= " and order_status = $order_status";
			}

			if ($use_status == 0)
			{
				$conn .= " and usetime = 0";
			}
			elseif ($use_status == 1)
			{
				$conn .= " and usetime <> 0";
			}

			if ($price_start)
			{
				$conn .= " and price >= $price_start";
			}

			if ($price_end)
			{
				$conn .= " and price <= $price_end";
			}
			
			//订单成交时间
			if ($paytime_start)
			{
				$conn .= " and paytime >= $paytime_start";
			}

			if ($paytime_end)
			{
				$conn .= " and paytime < $paytime_end";
			}
			
			//订单兑换时间
			if ($usetime_start)
			{
				$conn .= " and usetime <> 0 and usetime >= $usetime_start";
			}

			if ($usetime_end)
			{
				$conn .= " and usetime <> 0 and usetime < $usetime_end";
			}

			$sql = "select goods_order.*, core_user.mobile, core_user.realname from goods_order inner join core_user on goods_order.uid = core_user.id where 1 = 1" . $conn . " order by goods_order.order_id desc";
			$result = $db->query($sql) or die($db->error());
			while($rs = $db->fetch_array($result))
			{
				$rs['price_show'] = "$" . number_format($rs['price']/100, 2, ".", "");
				$rs['total_show'] = "￥" . number_format($rs['total']/100, 2, ".", "");

				$rs['addtime_show'] = date("Y-m-d H:i:s", $rs['addtime']);

				if ($rs['paytime'])
				{
					$rs['paytime_show'] = date("Y-m-d H:i:s", $rs['paytime']);
				}
				else
				{
					$rs['paytime_show'] = "";
				}

				switch($rs['order_status'])
				{
					case 0:
							$rs['order_status_show'] = "未支付";
						break;
					case 1:
							$rs['order_status_show'] = "已支付";
						break;
					case 2:
							$rs['order_status_show'] = "已关闭";
						break;
				}

				if ($rs['usetime'])
				{
					$rs['usetime_show'] = date("Y-m-d H:i:s", $rs['usetime']);
					$rs['use_status_show'] = "已兑换";
				}
				else
				{
					$rs['usetime_show'] = "";
					$rs['use_status_show'] = "未兑换";
				}

				$rss['order_id'] = $rs['order_id']." ";
				$rss['goods'] = $rs['goods'];
				$rss['price_show'] = $rs['price_show'];
				$rss['use_rate'] = $rs['use_rate'];
				$rss['total_show'] = $rs['total_show'];
				$rss['mobile'] = $rs['mobile'] . "（" . $rs['realname'] . "）";
				$rss['source'] = $rs['source'];
				$rss['channel'] = $rs['channel'];
				$rss['addtime_show'] = $rs['addtime_show'];
				$rss['order_status_show'] = $rs['order_status_show'];
				$rss['paytime_show'] = $rs['paytime_show'];
				$rss['use_status_show'] = $rs['use_status_show'];
				$rss['usetime_show'] = $rs['usetime_show'];

				$rs_result[] = $rss; 
			}
			$db->free_result($result);

			return $rs_result;
		}

		//兑换列表
		function goodsOrderRechargeList($page, $keys, $recharge_platform_id, $price_start, $price_end, $paytime_start, $paytime_end, $usetime_start, $usetime_end)
		{
			global $db;

			$page = $page ? $page : 1;

			$url_price_start = $price_start ? "&price_start=" . $price_start : "";
			$url_price_end = $price_end ? "&price_end=" . $price_end : "";
			$url_paytime_start = $paytime_start ? "&paytime_start=" . $paytime_start : "";
			$url_paytime_end = $paytime_end ? "&paytime_end=" . $paytime_end : "";
			$url_usetime_start = $usetime_start ? "&usetime_start=" . $usetime_start : "";
			$url_usetime_end = $usetime_end ? "&usetime_end=" . $usetime_end : "";
			$url_recharge_platform_id = $recharge_platform_id ? "&recharge_platform_id=" . $recharge_platform_id : "";
			$url_keys = $keys ? "&keys=" . $keys : "";
			$para = $url_price_start . $url_price_end . $url_paytime_start . $url_paytime_end . $url_usetime_start . $url_usetime_end . $url_recharge_platform_id . $url_keys;

			if ($para)
			{
				$param = "?" . substr($para, 1);
			}

			$price_start = $price_start ? $price_start * 100 : "";															//充入值低
			$price_end = $price_end ? $price_end * 100 : "";															//充入值高

			$paytime_start = $paytime_start ? strtotime($paytime_start) : "";										//订单成交日期开始
			$paytime_end = $paytime_end ? strtotime($paytime_end) + 86400 : "";						//订单成交日期结束

			$usetime_start = $usetime_start ? strtotime($usetime_start) : "";										//订单兑换日期开始
			$usetime_end = $usetime_end ? strtotime($usetime_end) + 86400 : "";						//订单兑换日期结束

			if ($price_start && $price_start)
			{
				if ($price_start > $price_end || $price_start < 0 || $price_end < 0)
				{
					$this->goToUrl("价格范围错误！"); 
				}
			}
			
			if ($paytime_start && $paytime_end)
			{
				if ($paytime_start >= $paytime_end)
				{
					$this->goToUrl("订单成交日期范围错误！"); 
				}
			}
			
			if ($usetime_start && $usetime_end )
			{
				if ($usetime_start >= $usetime_end )
				{
					$this->goToUrl("订单兑换日期范围错误！"); 
				}
			}

			if ($keys)
			{
				$conn .= " and (order_id like '%$keys%' or mobile like '%$keys%' or realname like '%$keys%' or recharge_account like '%$keys%')";
			}

			if ($recharge_platform_id != -1)
			{
				switch ($recharge_platform_id)
				{
					case 1:
							$recharge_platform = "鑫圣金业";
						break;
					case 2:
							$recharge_platform = "鑫圣钜丰";
						break;
					case 3:
							$recharge_platform = "鑫圣投资";
						break;
				}
				
				$conn .= " and recharge_platform = '$recharge_platform'";
			}

			if ($price_start)
			{
				$conn .= " and price >= $price_start";
			}

			if ($price_end)
			{
				$conn .= " and price <= $price_end";
			}
			
			//订单成交时间
			if ($paytime_start)
			{
				$conn .= " and paytime >= $paytime_start";
			}

			if ($paytime_end)
			{
				$conn .= " and paytime < $paytime_end";
			}
			
			//订单兑换时间
			if ($usetime_start)
			{
				$conn .= " and usetime >= $usetime_start";
			}

			if ($usetime_end)
			{
				$conn .= " and usetime < $usetime_end";
			}

			$sql = "select goods_order.*, core_user.mobile, core_user.realname from goods_order inner join core_user on goods_order.uid = core_user.id where usetime <> 0". $conn;
			$result = $db->query($sql) or die($db->error());
			$nums = (mysql_num_rows($result));
			$each_disNums = 30;
			$current_page = $page;
			$current_num = 1;
			$sub_pages = 10;
			$offest = ($page - 1) * $each_disNums;
			$subPage_link = "goods_order_recharge_list.php". $param . "&page=";
			$subPage_type = 2;
			$sub_page = new SubPages($each_disNums,$nums,$current_page,$sub_pages,$subPage_link,$subPage_type);
			$page_info = $sub_page->show_SubPages(2);
			$sqlc = "select goods_order.*, core_user.mobile, core_user.realname from goods_order inner join core_user on goods_order.uid = core_user.id where usetime <> 0" . $conn . " order by goods_order.usetime desc limit ". $offest .",".$each_disNums;
			$resultc = $db->query($sqlc) or die($db->error());
			while($rs = $db->fetch_array($resultc))
			{
				$rs['price_show'] = "$ " . number_format($rs['price']/100, 2, ".", "");
				$rs['total_show'] = "￥ " . number_format($rs['total']/100, 2, ".", "");
				$rs['recharge_total_show'] = "￥ " . number_format($rs['recharge_total']/100, 2, ".", "");

				$rs['paytime_show'] = date("Y-m-d H:i:s", $rs['paytime']);
				$rs['usetime_show'] = date("Y-m-d H:i:s", $rs['usetime']);

				$rs_result[] = $rs; 
			}
			$db->free_result($result);

			$yestoday = strtotime(date("Y-m-d",strtotime("-1 day")));
			$today = strtotime(date("Y-m-d"));
			$tomorrow = strtotime(date("Y-m-d",strtotime("+1 day")));
			
			//昨天兑换订单总笔数
			$sql_order_yestoday = "select count(*) as count, sum(price) as price, sum(total) as total from goods_order where usetime >= $yestoday and usetime < $today";
			$result_order_yestoday = $db->query($sql_order_yestoday) or die($db->error());
			$rs_order_yestoday = $db->fetch_array($result_order_yestoday);
			
			//今天兑换订单总笔数
			$sql_order_today = "select count(*) as count, sum(price) as price, sum(total) as total from goods_order where usetime >= $today and usetime < $tomorrow";
			$result_order_today = $db->query($sql_order_today) or die($db->error());
			$rs_order_today = $db->fetch_array($result_order_today);

			//兑换订单总笔数
			$sql_order_statistics = "select count(*) as count, sum(price) as price, sum(total) as total from goods_order inner join core_user on goods_order.uid = core_user.id where order_status = 1 and usetime <> 0". $conn;
			$result_order_statistics = $db->query($sql_order_statistics) or die($db->error());
			$rs_order_statistics = $db->fetch_array($result_order_statistics);

			$arr['order_yestoday_statistics'] = $rs_order_yestoday['count'];
			$arr['price_yestoday_statistics'] = "$ " . number_format($rs_order_yestoday['price']/100, 2, ".", "");
			$arr['total_yestoday_statistics'] = "￥ " . number_format($rs_order_yestoday['total']/100, 2, ".", "");

			$arr['order_today_statistics'] = $rs_order_today['count'];
			$arr['price_today_statistics'] = "$ " . number_format($rs_order_today['price']/100, 2, ".", "");
			$arr['total_today_statistics'] = "￥ " . number_format($rs_order_today['total']/100, 2, ".", "");
		
			$arr['order_statistics'] = $rs_order_statistics['count'];
			$arr['price_statistics'] = "$ " . number_format($rs_order_statistics['price']/100, 2, ".", "");
			$arr['total_statistics'] = "￥ " . number_format($rs_order_statistics['total']/100, 2, ".", "");

			$arr['nums'] = $nums;
			$arr['result'] = $rs_result;
			$arr['page_info'] = $page_info;
			return $arr;
		}

		//兑换列表-生成Excel
		function goodsOrderRechargeListExcel($keys, $recharge_platform_id, $price_start, $price_end, $paytime_start, $paytime_end, $usetime_start, $usetime_end)
		{
			global $db;

			$price_start = $price_start ? $price_start * 100 : "";															//充入值低
			$price_end = $price_end ? $price_end * 100 : "";															//充入值高

			$paytime_start = $paytime_start ? strtotime($paytime_start) : "";										//订单成交日期开始
			$paytime_end = $paytime_end ? strtotime($paytime_end) + 86400 : "";						//订单成交日期结束

			$usetime_start = $usetime_start ? strtotime($usetime_start) : "";										//订单兑换日期开始
			$usetime_end = $usetime_end ? strtotime($usetime_end) + 86400 : "";						//订单兑换日期结束

			if ($price_start && $price_start)
			{
				if ($price_start > $price_end || $price_start < 0 || $price_end < 0)
				{
					$this->goToUrl("价格范围错误！"); 
				}
			}
			
			if ($paytime_start && $paytime_end)
			{
				if ($paytime_start >= $paytime_end)
				{
					$this->goToUrl("订单成交日期范围错误！"); 
				}
			}
			
			if ($usetime_start && $usetime_end )
			{
				if ($usetime_start >= $usetime_end )
				{
					$this->goToUrl("订单兑换日期范围错误！"); 
				}
			}

			if ($keys)
			{
				$conn .= " and (order_id like '%$keys%' or mobile like '%$keys%' or realname like '%$keys%' or recharge_account like '%$keys%')";
			}

			if ($recharge_platform_id != -1)
			{
				switch ($recharge_platform_id)
				{
					case 1:
							$recharge_platform = "鑫圣金业";
						break;
					case 2:
							$recharge_platform = "鑫圣钜丰";
						break;
					case 3:
							$recharge_platform = "鑫圣投资";
						break;
				}
				
				$conn .= " and recharge_platform = '$recharge_platform'";
			}

			if ($price_start)
			{
				$conn .= " and price >= $price_start";
			}

			if ($price_end)
			{
				$conn .= " and price <= $price_end";
			}
			
			//订单成交时间
			if ($paytime_start)
			{
				$conn .= " and paytime >= $paytime_start";
			}

			if ($paytime_end)
			{
				$conn .= " and paytime < $paytime_end";
			}
			
			//订单兑换时间
			if ($usetime_start)
			{
				$conn .= " and usetime >= $usetime_start";
			}

			if ($usetime_end)
			{
				$conn .= " and usetime < $usetime_end";
			}

			$sql = "select goods_order.*, core_user.mobile, core_user.realname from goods_order inner join core_user on goods_order.uid = core_user.id where usetime <> 0" . $conn . " order by goods_order.usetime desc";
			$result = $db->query($sql) or die($db->error());
			while($rs = $db->fetch_array($result))
			{
				$rs['price_show'] = "$ " . number_format($rs['price']/100, 2, ".", "");
				$rs['total_show'] = "￥ " . number_format($rs['total']/100, 2, ".", "");
				$rs['recharge_total_show'] = "$ " . number_format($rs['recharge_total'], 2, ".", "");

				$rs['paytime_show'] = date("Y-m-d H:i:s", $rs['paytime']);
				$rs['usetime_show'] = date("Y-m-d H:i:s", $rs['usetime']);

				$rss['order_id'] = $rs['order_id']." ";
				$rss['mobile'] = $rs['mobile'] . "（" . $rs['realname'] . "）";
				$rss['price_show'] = $rs['price_show'];
				$rss['total_show'] = $rs['total_show'];
				$rss['channel'] = $rs['channel'];
				$rss['paytime_show'] = $rs['paytime_show'];
				$rss['recharge_platform'] = $rs['recharge_platform'];
				$rss['recharge_account'] = $rs['recharge_account'];
				$rss['recharge_total_show'] = $rs['recharge_total_show'];
				$rss['usetime_show'] = $rs['usetime_show'];

				$rs_result[] = $rss; 
			}
			$db->free_result($result);
			return $rs_result;
		}
		
		 public function order_edit($order_id,$rmbmoney,$money)
        {
            global $db;
            $paytime = time();
            $password = mt_rand(10000000, 99999999);
            $pwd = authcode($password, "ENCODE");
             $sqlu = "update goods_order set paytime = $paytime, pwd = '$pwd', order_status = 1, price = $money,total = $rmbmoney ,recharge_total = $rmbmoney where order_id = '$order_id'";
            $resultu = $db->query($sqlu) or die($db->error());
            if($resultu){
                return array('success'=>1,'message'=>'');
            }else{
                return array('success'=>0,'message'=>'修改失败');
            }
        }
	}
?>