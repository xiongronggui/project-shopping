<?php
	require_once 'BaseClass.class.php';

	class GoodsClass extends BaseClass
	{
		//构造函数
		function __construct() { }

		//商品列表
		function goodsList()
		{

			global $db;
			$i = 0;
			$sql = "select * from goods where status = 0 order by id desc";
			$result = $db->query($sql) or die($db->error());
			while ($rs = $db->fetch_array($result))
			{
				$rs['images_show'] = "picfile/goods/".substr($rs["images"], 0, -14)."/images/".$rs["images"];
				$rs_result[] = $rs; 
			}
			$db->free_result($result);
			return $rs_result;
		}

		//商品详细信息
		function goodsGetInfo($id)
		{
			global $db;

			if ($id)
			{
				$sql = "select * from goods where id = $id";
				$result = $db->query($sql) or die($db->error());
				$rs = $db->fetch_array($result);
				$rs['images_show'] = "picfile/goods/".substr($rs["images"], 0, -14)."/images/".$rs["images"];

				return $rs;
			}
			else
			{
				$this->goToUrl("订单错误", "goods.php");
			}
		}

		function sellList($sell_type)
		{
			global $db;
			
			if ($sell_type)
			{
				$sell_arr = explode("|", $sell_type);

				$sql = "select * from sell_type order by id";
				$result = $db->query($sql) or die($db->error());
				while ($rs = $db->fetch_array($result))
				{
					if (in_array($rs['price'], $sell_arr))
					{
						$rs_result[] = $rs; 
					}
				}
				$db->free_result($result);
				return $rs_result;
			}
			else
			{
				$this->goToUrl("内部错误");
			}
		}

		/*获取总数*/
        function getTotalNum($where = 'and order_status = 1')
        {
        	global $db;
        	$sql = "select id from goods_order where 1=1 ".$where;
        	$result = $db->query($sql) or die($db->error());
        	$result = $db->num_rows($result);
			$db->free_result($result);
			return $result;
        }
	}
?>