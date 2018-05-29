<?php

/*
*autor: panda
*time:  2018-04-11
*desc: 推送订单到.net后台
*args: array
*return: 返回推荐结果
*/
function push_order($url,$orderPay,$key)
{
	$orderPay['price'] = number_format($orderPay['price']/100,2,".","");
	$orderPay['service_charge'] = number_format($orderPay['service_charge']/100,2,".","");
	$orderPay['total'] = number_format($orderPay['total']/100,2,".","");
	$orderPay['Ident'] = md5($orderPay['order_id']."&".$orderPay['price']."&".$key);
	$orderPay['addtime'] = date('Y-m-d H:i:s',$orderPay['addtime']);
	$orderPay['paytime'] = date('Y-m-d H:i:s',$orderPay['paytime']);
	$orderPay['idcard'] = strtolower($orderPay['idcard']);
	$orderPay['datatype'] = 1;
	$result = curlPostJson($url,$orderPay);
	return $result;
}

/*
*autor: panda
*time:  2018-04-11
*desc: 商城兑换推送订单到.net后台
*args: array
*return: 返回推荐结果
*/
function shop_push_order($url,$orderPay,$account,$name,$key)
{
	$data['order_id'] = $orderPay['order_id'];
	$data['price'] = number_format($orderPay['price']/100,2,".","");
	$data['mobile'] = $orderPay['mobile'];
	$data['Ident'] = md5($orderPay['order_id']."&".$data['price']."&",$key);
	$data['account'] = $account;
	$data['name'] = $name;
	$result = curlPostJson($url,$data);

	return $result;
}

?>