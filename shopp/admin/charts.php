<?php
	require_once 'include/common.php';
	require_once (ADMIN_CLASS_DIR."ChartsClass.class.php");

	$charts = new ChartsClass();

	$a = _g('op');
	switch ($a)
	{
		//通道数据统计
		case 'goodsOrderChannel':
				$time_start = _g('time_start');
				$time_end = _g('time_end');
				$result = $charts->goodsOrderChannel($time_start, $time_end);
				echo json_encode($result, JSON_UNESCAPED_UNICODE);
			break;
		//来源数据统计
		case 'goodsOrderSource':
				$time_start = _g('time_start');
				$time_end = _g('time_end');
				$result = $charts->goodsOrderSource($time_start, $time_end);
				echo json_encode($result, JSON_UNESCAPED_UNICODE);
			break;
		//入金平台数据统计
		case 'goodsOrderRechargePlatform':
				$time_start = _g('time_start');
				$time_end = _g('time_end');
				$result = $charts->goodsOrderRechargePlatform($time_start, $time_end);
				echo json_encode($result, JSON_UNESCAPED_UNICODE);
			break;
		//过去七天支付通道购买量
		case 'goodsOrderChannelChannelLastWeek':
				$time_start = _g('time_start');
				$time_end = _g('time_end');
				$result = $charts->goodsOrderChannelChannelLastWeek($time_start, $time_end);
				echo json_encode($result, JSON_UNESCAPED_UNICODE);
			break;
		//过去七天订单来源统计
		case 'sourceLastWeekArea':
				$time_start = _g('time_start');
				$time_end = _g('time_end');
				$result = $charts->sourceLastWeekArea($time_start, $time_end);
				echo json_encode($result, JSON_UNESCAPED_UNICODE);
			break;
		//过去七天各平台入金统计
		case 'rechargePlatformLastWeekArea':
				$time_start = _g('time_start');
				$time_end = _g('time_end');
				$result = $charts->rechargePlatformLastWeekArea($time_start, $time_end);
				echo json_encode($result, JSON_UNESCAPED_UNICODE);
			break;
		default:
				$time_start = _g('time_start');
				$time_end = _g('time_end');
				$tpl->assign('time_start', $time_start);
				$tpl->assign('time_end', $time_end);
				$tpl->display('charts.html');
			break;
	}
?>