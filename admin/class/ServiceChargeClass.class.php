<?php
require_once 'BaseClass.class.php';

class ServiceChargeClass extends BaseClass
{
	function saveCharge($name,$code,$rate,$chargetype,$chargeid)
	{
		global $db;
		if($name && $rate)
		{
			$sql = "select id from core_service_charge where name = '$name'";
			$results = $db->query($sql) or die($db->error());
			$nums = $db->num_rows($results);
			$bo = false;
			if ($nums > 0)
			{
				$bo = true;
			}
			$time = time();
			$adminid = $_SESSION['admin']['info']['id'];
			if($chargeid || $bo){
			$sql = "update core_service_charge set name= '$name',code='$code',scharge=$rate,type=$chargetype,updatetime = $time,adminid = $adminid where id=$chargeid";
			}else{
				$sql = "insert into core_service_charge (name,code,scharge,type,addtime,adminid) values ('$name','$code',$rate,$chargetype,$time,$adminid)";
			}
			$result = $db->query($sql) or die($db->error());
			if ($result)
			{
				$this->gotoUrl("操作成功！", "service_charge_list.php"); 
			}
			else
			{
				$this->gotoUrl("操作失败！");
			}
		}
		else
		{
			$this->gotoUrl('提交的信息不能为空');
		}
	}

	function getChargebyID($chargeID)
	{
		global $db;
		$sql = "select id,name,code,scharge from core_service_charge where id = $chargeID";
		$result = $db->query($sql) or die($db->error());
		$rs = $db->fetch_array($result);
		$rs_result = array("id" => $rs['id'], "name" => $rs['name'],"code"=>$rs['code'], "scharge" => $rs['scharge']); 
		$db->free_result($result);
		return $rs_result;
	}

	function chargeList()
	{
		global $db;
		$sql = 'select id,name,code,scharge,type from core_service_charge';
		$result = $db->query($sql) or die($db->error());
		while ($rs = $db->fetch_array($result))
		{
			$type = '四舍五入';
			switch ($rs['type']) {
				case '1':
						$type = '四舍五入';
					break;
				case '2':
						$type = '向下取整';
					break;
				case '3':
						$type = '向上取整';
					break;
				default:
						$type = '四舍五入';
					break;
			}
			$rs_result[] = array("id" => $rs['id'], "name" => $rs['name'], "scharge" => ($rs['scharge']*100),'type'=>$type); 
		}
		$db->free_result($result);
		return $rs_result;
	}
}
?>