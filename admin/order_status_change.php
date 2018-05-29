<?php
	require_once 'include/common.php';
	require_once (ADMIN_CLASS_DIR."GoodsClass.class.php");

	$goods = new GoodsClass;
	$host = $_SERVER['HTTP_HOST'];
	$a = _g('op');
	switch ($a) {
		case 'change':
				$order_id = _g('order_id');
				$result = $goods -> order_status_edit($order_id);
				echo json_encode($result, JSON_UNESCAPED_UNICODE);exit;
			break;
		default:
				$tpl -> assign('server_name',$server_name[$host]);
				$tpl->display("order_change.html");
			break;
	}
?>