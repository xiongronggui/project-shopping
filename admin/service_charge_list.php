<?php
require_once 'include/common.php';
	require_once (ADMIN_CLASS_DIR."ServiceChargeClass.class.php");

	$service_charge = new ServiceChargeClass;
	$host = $_SERVER['HTTP_HOST'];
	$a = _g('op');
	switch ($a) {
		case 'add':
				$tpl->assign('id','');
				$tpl->assign('name','');
				$tpl->assign('code');
				$tpl->assign('rate','');
				$tpl->display('service_charge_add.html');
			break;
		case 'save':
				$charge_id = _g('charge_id');
				$charge_name = _g('charge_name');
				$code = _g('code_val');
				$charge_val = _g('charge_val');
				$charge_type = _g('charge_type');
				$service_charge->saveCharge($charge_name,$code,$charge_val,$charge_type,$charge_id);
			break;
		case 'update':
				$charge_id = _g('id');
				$result = $service_charge->getChargebyID($charge_id);
				$tpl->assign('id',$charge_id);
				$tpl->assign('name',$result['name']);
				$tpl->assign('rate',$result['scharge']);
				$tpl->assign('code',$result['code']);
				$tpl->display('service_charge_add.html');
			break;
		default:
				$result = $service_charge->chargeList();
				$tpl->assign('result',$result);
				$tpl -> assign('server_name',$server_name[$host]);
				$tpl->display("service_charge.html");
			break;
	}
?>