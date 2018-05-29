<?php
	$url = "<script language=javascript>window.location='/shopp/404.html';</script>";

	require_once 'include/common.php';
	require_once (CLASS_DIR."GoodsClass.class.php");
	require_once (CLASS_DIR."UserClass.class.php");
	$goods = new GoodsClass;
	$netresult = ['name'=> '','idcard'=> ''];
	if(isset($_GET['u'])){
		$uid = $_GET['u'];
		$netresult = updateUser($uid);
	}
	
	
	$a = _g('op');
	switch ($a)
	{
		default:
			$id = _g('id') ? _g('id') : 1;
			$goodsInfo = $goods->goodsList();
			$randnum = rand(0,count($goodsInfo));
			if($randnum == count($goodsInfo)){
				$randnum = $randnum - 1;
			}
			$goodsInfo = $goodsInfo[$randnum];
			$_SESSION['goods'] = $goodsInfo['title'];
			$number = $goods->getTotalNum();
			$tpl->assign("goods_info", $goodsInfo);
			$tpl->assign("number", $number);
			$sellList = $goods->sellList($goodsInfo['sell_type']);
			$tpl -> assign('server_name',$server_name[$_SERVER['HTTP_HOST']]);
			$tpl->assign("sell_list", $sellList);
			$tpl->assign('netinfo',$netresult);
			$tpl->display('goods.html');
		break;
	}

/*获取用户的姓名和身份证号码*/
function updateUser($uid = '')
{
	$uid = '0fd7c5ce-4fca-44f7-9bfe-1d24361566ab';
	$param = array('uid'=>$uid);
	$result = curlRequest($interface_url['usernet'].'/QueryUserInfoByUID',$param);
	$result = json_decode($result,true);
	
	logInfo('获取用户的姓名和身份证号码:'.json_encode($result),'net');
	$data['name'] = '';
	$data['idcard'] = '';
	if($result['IsSuccess']){
		$result = $result['Message'];
		$data['name'] = $result['Name'];
		$data['idcard'] = $result['CredentialsNum'];
	}else{
		echo $url;
	}
	$_SESSION['net'] = $data;
	return $data;
}
?>