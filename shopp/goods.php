<?php
	require_once 'include/common.php';
	require_once (CLASS_DIR."GoodsClass.class.php");

	$goods = new GoodsClass;

	$a = _g('op');
	switch ($a)
	{
		default:
				$id = _g('id') ? _g('id') : 1;
				$goodsInfo = $goods->goodsGetInfo($id);
				$tpl->assign("goods_info", $goodsInfo);
				$sellList = $goods->sellList($goodsInfo['sell_type']);
				$tpl -> assign('server_name',$server_name[$_SERVER['SERVER_NAME']]);
				$tpl->assign("sell_list", $sellList);
				$tpl->display('goods.html');
			break;
	}
?>