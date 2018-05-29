<?php
require_once 'include/common.php';
$data = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");
!empty($data) ?: ($data = $_POST);
//$data = '{"BillNo":"803180423112842688","Amount":"600","CustomerNo":"800002","DataTime":null,"Status":"1","SignType":null,"Sign":"49a7bfadefc1eeccb0989578c3a244b3"}';
//$data = json_decode($data,true);
logInfo('net->'.json_encode($data).'订单号:'.$data['BillNo'],'net');
$netpay = new netpay();
$result = $netpay->sign($data);
if($result['IsSuccess']){
	echo 'success';
	$orderNo = $data['BillNo'];
	$netpay->update($data);
}else{
	echo "fail";
}

?>