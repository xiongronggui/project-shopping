<?php
	require_once 'BaseClass.class.php';

	class ChartsClass extends BaseClass
	{
		//通道数据统计
		function goodsOrderChannel($time_start, $time_end)
		{
			global $db;

			$time_start = $time_start ? strtotime($time_start) : "";
			$time_end = $time_end ? strtotime($time_end) + 86400 : "";

			if ($time_start && $time_end)
			{
				if ($time_start >= $time_end)
				{
					$this->goToUrl("订单成交日期范围错误！"); 
				}
			}

			//查询时间
			if ($time_start)
			{
				$conn .= " and paytime >= $time_start";
			}

			if ($time_end)
			{
				$conn .= " and paytime < $time_end";
			}

			$sql = "select channel, count(*) as count, sum(price) as price, sum(total) as total from goods_order where order_status = 1 " . $conn . " group by channel";
			//$sql ="select channel, count(*) as count, sum(price) as price, sum(total) as total from goods_order where order_status = 1 and paytime >= 1521043200 and paytime < 1521216000 group by channel";
			$result = $db->query($sql) or die($db->error());
			while ($rs = $db->fetch_array($result))
			{
				$rs['price_show'] = number_format($rs['price']/100, 2, ".", "");
				$rs['total_show'] = number_format($rs['total']/100, 2, ".", "");
				$rs_result[] = $rs;
			}
			return $rs_result;
		}


		//来源数据统计
		function goodsOrderSource($time_start, $time_end)
		{
			global $db;

			$time_start = $time_start ? strtotime($time_start) : "";
			$time_end = $time_end ? strtotime($time_end) + 86400 : "";

			if ($time_start && $time_end)
			{
				if ($time_start >= $time_end)
				{
					$this->goToUrl("订单成交日期范围错误！"); 
				}
			}

			//查询时间
			if ($time_start)
			{
				$conn .= " and paytime >= $time_start";
			}

			if ($time_end)
			{
				$conn .= " and paytime < $time_end";
			}

			$sql = "select source, count(*) as count from goods_order where order_status = 1 " . $conn . " group by source";
			$result = $db->query($sql) or die($db->error());
			while ($rs = $db->fetch_array($result))
			{
				$rs_result[] = $rs;
			}
			return $rs_result;
		}

		//入金平台数据统计
		function goodsOrderRechargePlatform($time_start, $time_end)
		{
			global $db;

			$time_start = $time_start ? strtotime($time_start) : "";
			$time_end = $time_end ? strtotime($time_end) + 86400 : "";

			if ($time_start && $time_end)
			{
				if ($time_start >= $time_end)
				{
					$this->goToUrl("订单成交日期范围错误！"); 
				}
			}

			//查询时间
			if ($time_start)
			{
				$conn .= " and usetime >= $time_start";
			}

			if ($time_end)
			{
				$conn .= " and usetime < $time_end";
			}

			$sql = "select recharge_platform, count(*) as count from goods_order where order_status = 1 and usetime <> 0 " . $conn . " group by recharge_platform";
			$result = $db->query($sql) or die($db->error());
			while ($rs = $db->fetch_array($result))
			{
				$rs_result[] = $rs;
			}
			return $rs_result;
		}

		//过去七天支付通道购买量
		function goodsOrderChannelChannelLastWeek()
		{
			global $db;
			$today = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
			$last_week = $today - 86400 * 6;
			$sql = "select channel from goods_order where paytime > $last_week and order_status = 1 group by channel order by channel";
			$result = $db->query($sql) or die($db->error());
			while ($rs = $db->fetch_array($result))
			{
				$rss_result = "";
				for ($i = 6; $i >= 0; $i--)
				{
					$begin = $today - $i * 86400;
					$end = $today + 86400 - $i * 86400;
					$sqls = "select DATE_FORMAT(FROM_UNIXTIME(paytime),'%Y-%m-%d') as date, channel, count(*) as count, sum(price) as price, sum(total) as total from goods_order  where paytime between ".$begin." and ".$end." and channel = '".$rs['channel']."' and order_status = 1 group by channel order by channel";
					$results = $db->query($sqls) or die($db->error());
					$rss = $db->fetch_array($results);
					if (!$rss['count'])
					{
						$rss['count'] = 0;
					}
					$rss['price_show'] = number_format($rss['price']/100, 2, ".", "");
					$rss['total_show'] = number_format($rss['total']/100, 2, ".", "");
					$rss_result[] = array("date" => date("Y-m-d", $begin), "count" => $rss['count'], "price_show" => $rss['price_show'], "total_show" => $rss['total_show']); 
				}
				$rs_result[] = array("channel" => $rs['channel'], "val" => $rss_result);
			}
			return $rs_result;
		}

		//过去七天订单来源统计
		function sourceLastWeekArea()
		{
			global $db;
			$today = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
			$last_week = $today - 86400 * 6;
			$sql = "select source from goods_order where paytime > $last_week and order_status = 1 group by source order by source";
			$result = $db->query($sql) or die($db->error());
			while ($rs = $db->fetch_array($result))
			{
				$rss_result = "";
				for ($i = 6; $i >= 0; $i--)
				{
					$begin = $today - $i * 86400;
					$end = $today + 86400 - $i * 86400;
					$sqls = "select DATE_FORMAT(FROM_UNIXTIME(paytime),'%Y-%m-%d') as date, source, count(*) as count from goods_order  where paytime between ".$begin." and ".$end." and source = '".$rs['source']."' group by source order by source";
					$results = $db->query($sqls) or die($db->error());
					$rss = $db->fetch_array($results);
					if (!$rss['count'])
					{
						$rss['count'] = 0;
					}

					$rss_result[] = array("date" => date("Y-m-d", $begin), "count" => $rss['count']); 
				}
				$rs_result[] = array("source" => $rs['source'], "val" => $rss_result);
			}
			return $rs_result;
		}

		//过去七天各平台入金统计
		function rechargePlatformLastWeekArea()
		{
			global $db;
			$today = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
			$last_week = $today - 86400 * 6;
			$sql = "select recharge_platform from goods_order where order_status = 1 and usetime <> 0 group by recharge_platform order by recharge_platform";
			$result = $db->query($sql) or die($db->error());
			while ($rs = $db->fetch_array($result))
			{
				$rss_result = "";
				for ($i = 6; $i >= 0; $i--)
				{
					$begin = $today - $i * 86400;
					$end = $today + 86400 - $i * 86400;
					$sqls = "select DATE_FORMAT(FROM_UNIXTIME(paytime),'%Y-%m-%d') as date, recharge_platform, sum(price) as price from goods_order  where paytime between ".$begin." and ".$end." and recharge_platform = '".$rs['recharge_platform']."' group by recharge_platform order by recharge_platform";
					$results = $db->query($sqls) or die($db->error());
					$rss = $db->fetch_array($results);
					if (!$rss['count'])
					{
						$rss['count'] = 0;
					}

					$rss['price_show'] = number_format($rss['price']/100, 2, ".", "");
					$rss_result[] = array("date" => date("Y-m-d", $begin), "count" => $rss['count'], "price_show" => $rss['price_show']); 
				}
				$rs_result[] = array("recharge_platform" => $rs['recharge_platform'], "val" => $rss_result);
			}
			return $rs_result;
		}
	}
?>