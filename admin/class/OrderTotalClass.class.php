<?php
require_once 'BaseClass.class.php';
/**
* 
*/
class OrderTotalClass extends BaseClass
{

	function getTotalList($args='',$usetimebool = false)
	{
		global $db;
		$sql = "SELECT source,channel, SUM(price)/100 dollar,SUM(total)/100 cha,SUM(service_charge)/100 rate,SUM(recharge_total)/100 usecha,(SUM(total)-SUM(recharge_total))/100 unusecha FROM goods_order a inner join core_user on a.uid=core_user.id  LEFT JOIN core_service_charge b ON a.channel = b.`name`";
		$starttime = strtotime("today");
		$time = time();
		$usestarttime = strtotime("today");
		$usetime = time();
		$where = " where order_id <> 0 ";
		if(!empty($args['keys'])){
			$where .= " and (order_id like '%".$args['keys']."%' or mobile like '%".$args['keys']."%' or realname like '%".$args['keys']."%' or recharge_account like '%".$args['keys']."%')";
		}
		
		if(!empty($args['order_status']) && $args['order_status'] != -1){
			
			$where .= " AND order_status = ".$args['order_status'];
		}
		if(!empty($args['use_status']) && $args['use_status'] == 1){
			$where .= " AND usetime > 0";
		}elseif(!empty($args['use_status']) && $args['use_status'] == 0){
			$where .= " AND usetime = 0";
		}
		if(!empty($args['price_start'])){
			$where .= "total >= ".$args['price_start']*100;
		}
		if(!empty($args['price_end'])){
			$where .= "total <= ".$args['price_end']*100;
		}
		if(!empty($args['paytime_start'])){
			$starttime = strtotime($args['paytime_start']);
		}
		$where .= " and paytime >= ".$starttime;
		if(!empty($args['paytime_end'])){
			if(strtotime($args['paytime_start']) == strtotime($args['paytime_end'])){
				$args['paytime_end'] = date('Y-m-d 00:00:00',strtotime($args['paytime_start'])+60*60*24);
			}
			$time = strtotime($args['paytime_end']);
		}
		$where .= " and paytime <= ".$time;
		if(!empty($args['usetime_start'])){
			$usestarttime = strtotime($args['usetime_start']);
		}
		if($usetimebool || !empty($args['usetime_start'])){
			$where .=' and usetime >='.$usestarttime;
		}
	    //!$usetimebool ?: ($where .=' and usetime >='.$usestarttime);
		if(!empty($args['usetime_end'])){
			if(strtotime($args['usetime_start']) == strtotime($args['usetime_end'])){
				$args['usetime_end'] = date('Y-m-d 00:00:00',strtotime($args['paytime_start'])+60*60*24);
			}
			$usetime = strtotime($args['usetime_end']);
		}
		if($usetimebool || !empty($args['usetime_end'])){
			$where .= " and usetime <= ".$usetime;
		}
		//!$usetimebool ?:($where .= " and usetime <= ".$usetime);
		if(!empty($args['recharge_platform_id']) && $args['recharge_platform_id'] != -1)
		{
			switch ($recharge_platform_id)
			{
				case 1:
						$args['recharge_platform_id'] = "鑫圣金业";
					break;
				case 2:
						$args['recharge_platform_id'] = "鑫圣钜丰";
					break;
				case 3:
						$args['recharge_platform_id'] = "鑫圣投资";
					break;
			}
			
			$where .= " and recharge_platform = '".$args['recharge_platform_id']."'";
		}

		$sort = " GROUP BY source,channel ORDER BY channel DESC ";
		$sql .=$where.$sort;
		
		$result = $db->query($sql) or die($db->error());
		$re_result = [];
		$rs_total_result = [];
		if($result){
			$rs_total_result['dollar'] = 0;
			$rs_total_result['cha'] = 0;
			$rs_total_result['rate'] = 0;
			$rs_total_result['actcha'] = 0;
			$rs_total_result['usecha'] = 0;
			$rs_total_result['unusecha'] = 0;
			while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
				$rs['source'] = $row['source'];
				$rs['channel'] = $row['channel'];
				$rs['dollar'] = number_format($row['dollar'],2);
				$rs['cha'] = number_format($row['cha'],2);
				$rs['rate'] = number_format($row['rate'],2);
				$rs['actcha'] = number_format($row['cha'] - $row['rate'],2);
				$rs['usecha'] = number_format($row['usecha'],2);
				$rs['unusecha'] = number_format($row['unusecha'],2);
				$re_result[] = $rs;
				$rs_total_result['dollar'] = $rs_total_result['dollar'] + $row['dollar'];
				$rs_total_result['cha'] = $rs_total_result['cha'] + $row['cha'];
				$rs_total_result['rate'] = $rs_total_result['rate'] + $row['rate'];
				$rs_total_result['actcha'] = $rs_total_result['actcha'] + $row['cha'] - $row['rate'];
				$rs_total_result['usecha'] = $rs_total_result['usecha'] + $row['usecha'];
				$rs_total_result['unusecha'] = $rs_total_result['unusecha'] + $row['unusecha'];
			}
			$rs_total_result['dollar'] = number_format($rs_total_result['dollar'],2);
			$rs_total_result['cha'] = number_format($rs_total_result['cha'],2);
			$rs_total_result['rate'] = number_format($rs_total_result['rate'],2);
			$rs_total_result['actcha'] = number_format($rs_total_result['actcha'],2);
			$rs_total_result['usecha'] = number_format($rs_total_result['usecha'],2);
			$rs_total_result['unusecha'] = number_format($rs_total_result['unusecha'],2);
			$res['IsSuccess'] = true;
			$res['Message'] = "";
			$res['data'] = $re_result;
			$res['total'] = $rs_total_result;
		}else
		{
			$res['IsSuccess'] = false;
			$res['Message'] = "列表为空";
		}
		return $res;
	}
}
?>