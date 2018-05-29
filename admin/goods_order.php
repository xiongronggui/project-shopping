<?php
	require_once 'include/common.php';
	require_once 'phpexcel/Classes/PHPExcel.php';
	require_once 'phpexcel/Classes/PHPExcel/IOFactory.php';
	require_once 'phpexcel/Classes/PHPExcel/Reader/Excel5.php';

	require_once (ADMIN_CLASS_DIR."GoodsClass.class.php");
	require_once (ADMIN_CLASS_DIR."OrderTotalClass.class.php");
	$goods = new GoodsClass;
	$total = new OrderTotalClass;
	$a = _g('op');
	switch ($a)
	{
		case 'order_id';
            $order_id = _g('order_id');
            $rmbmoney = _g('rmbmoney');
            $money = _g('money');
            $re = $goods->order_edit($order_id,trim($rmbmoney)*100,trim($money)*100);
            echo json_encode($re);
            break;
		case "output":
				//创建对象
				$excel = new PHPExcel();
				//Excel表格式,这里简略写了8列
				$letter = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
				//表头数组
				$tableheader = array('订单编号', '商品名称', '充入值', '汇率','手续费', '总价', '付款账号', '支付来源', '支付通道', '下单时间', '支付状态', '支付时间', '兑换状态', '兑换时间');
				//填充表头信息
				for($i = 0; $i < count($tableheader); $i++) 
				{
					$excel->getActiveSheet()->setCellValue("$letter[$i]1", "$tableheader[$i]");
				}

				$keys = _g('keys');													//关键字
				
				$order_status = _g('order_status');						//订单状态
				if ($order_status == "")
				{
					$order_status = 1;
				}

				$use_status = _g('use_status');								//兑换状态
				if ($use_status == "")
				{
					$use_status = -1;
				}

				$price_start = _g('price_start');								//充入值低
				$price_end = _g('price_end');								//充入值高
			
				$paytime_start = _g('paytime_start');						//订单成交日期开始
				$paytime_end = _g('paytime_end');						//订单成交日期结束

				$usetime_start = _g('usetime_start');						//订单兑换日期开始
				$usetime_end = _g('usetime_end');						//订单兑换日期结束

				$data = $goods->goodsOrderListExcel($keys, $order_status, $use_status, $price_start, $price_end, $paytime_start, $paytime_end, $usetime_start, $usetime_end);
				
				//填充表格信息
				for ($i = 2;$i <= count($data) + 1;$i++) 
				{
					$j = 0;
					foreach ($data[$i - 2] as $key=>$value) 
					{
						$excel->getActiveSheet()->setCellValue("$letter[$j]$i", "$value");
						$j++;
					}
				}

				//创建Excel输入对象
				$write = new PHPExcel_Writer_Excel5($excel);
				$filename = "Order List " . date("Y-m-d H:i:s");
				header("Pragma: public");
				header("Expires: 0");
				header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
				header("Content-Type:application/force-download");
				header("Content-Type:application/vnd.ms-execl");
				header("Content-Type:application/octet-stream");
				header("Content-Type:application/download");
				header('Content-Disposition:attachment;filename="'.$filename.'.xls"');
				header("Content-Transfer-Encoding:binary");
				$write->save('php://output');
			break;
		default:
				$page = _g('page');

				$keys = _g('keys');													//关键字
				
				$order_status = _g('order_status');						//订单状态
				if ($order_status == "")
				{
					$order_status = -1;
				}

				$use_status = _g('use_status');								//兑换状态
				if ($use_status == "")
				{
					$use_status = -1;
				}

				$price_start = _g('price_start');								//充入值低
				$price_end = _g('price_end');								//充入值高
			
				$paytime_start = _g('paytime_start');						//订单成交日期开始
				$paytime_end = _g('paytime_end');	//订单成交日期结束

				$total_paytime_start = empty($paytime_start)? date('Y-m-d',time()) : $paytime_start;
				$total_paytime_end = empty($paytime_end)? date('Y-m-d',time()) : $paytime_end;

				$usetime_start = _g('usetime_start');						//订单兑换日期开始
				$usetime_end = _g('usetime_end');						//订单兑换日期结束
				/*汇总参数*/
				$args['page'] = $page;
				$args['keys'] = $keys;
				$args['order_status'] = $order_status;
				$args['use_status'] = $use_status;
				$args['price_start'] = $price_start;
				$args['price_end'] = $price_end;
				$args['paytime_start'] = $total_paytime_start;
				$args['paytime_end'] = $total_paytime_end;
				$args['usetime_start'] = $usetime_start;
				$args['usetime_end'] = $usetime_end;
				/*汇总参数结束*/


				$goodsOrderList = $goods->goodsOrderList($page, $keys, $order_status, $use_status, $price_start, $price_end, $paytime_start, $paytime_end, $usetime_start, $usetime_end);
				$tpl->assign("result", $goodsOrderList);

				$totalList = $total->getTotalList($args);
				if($totalList['IsSuccess']){
					$tpl->assign("total",$totalList['data']);
					$tpl->assign('sum',$totalList['total']);
				}else{
					$tpl->assign("total",[]);
					$tpl->assign('sum',[]);
				}
				$tpl->assign("keys", _g('keys'));
				$tpl->assign("order_status", $order_status);
				$tpl->assign("use_status",  $use_status);
				$tpl->assign("price_start", _g('price_start'));
				$tpl->assign("price_end", _g('price_end'));
				$tpl->assign("paytime_start", _g('paytime_start'));
				$tpl->assign("paytime_end", _g('paytime_end'));
				$tpl->assign("total_paytime_start", $total_paytime_start);
				$tpl->assign("total_paytime_end", $total_paytime_end);
				$tpl->assign("usetime_start", _g('usetime_start'));
				$tpl->assign("usetime_end", _g('usetime_end'));
				$tpl -> assign('server_name',$server_name[$_SERVER['HTTP_HOST']]);
				$tpl->display("goods_order_list.html");
			break;
	}
?>