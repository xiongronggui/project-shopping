<?php
include_once ("config.php");
include_once (INCLUDE_DIR."db_mysql.class.php");
include_once (INCLUDE_DIR."global.func.php");
include_once (INCLUDE_DIR."push_func.php");
include_once (SMARTY_DIR."Smarty.class.php");
require_once 'include/push_func.php';
//链接数据库
$db = new dbstuff;
$db->connect(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PCONNECT) ;
$result = goodsOrderListByWhere(' notify_status = 1');

if($result['IsSuccess']){
	
	foreach($result['data'] as $row){
		$row['pwd'] = authcode($row['pwd']);
		$push_return = push_order($interface_url['net'].'/InsertRechargeInfoToXS',$row,$interface_url['pwd']);
		if($push_return['IsSuccess']){
			$orderNo = $row['order_id'];
			$sql_notify = "update goods_order set notify_status = 2 where order_id = '$orderNo'";
			$result_notify = $db->query($sql_notify) or die($db->error());
		}else{
			logInfo('通知.net订单信息失败,订单号:'.$row['order_id'].',返回结果:'.json_encode($push_return),"net");
		}
	}
	
}

/*根据条件搜索订单*/
function goodsOrderListByWhere($where)
{
	global $db;
	
	if ($where)
	{
		$sql = "select goods_order.*,core_user.mobile,core_user.people_id idcard,core_user.realname name from goods_order inner join core_user on goods_order.uid = core_user.id where   order_status = 1 and $where"; 
		$result = $db->query($sql) or die($db->error());
		$re_result = [];
		if ($result)
		{
			while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
				$re_result[] = $row;
			}
			$res['IsSuccess'] = true;
			$res['Message'] = "";
			$res['data'] = $re_result;
		}
		else
		{
			$res['IsSuccess'] = false;
			$res['Message'] = "列表为空";
		}
	}
	else
	{
		$res['IsSuccess'] = false;
		$res['Message'] = "搜索条件不能为空";
	}

	return $res;
}


?>