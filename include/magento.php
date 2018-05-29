<?php
class magento
{
	public $mchid = 'ftdsy@xsmcfx.com'; //'ladao@jf24k.com'; 
	public $payurl = 'http://tob.xsmcfx.cc/gateway/pay/';

	/*获取支付通道*/
	function payment_list()
	{
		$sign = strtoupper(md5('mchid='.$this->mchid));
		$data = _curlPost($this->payurl.'paylist',array('mchid'=> $this->mchid,'sign'=>$sign));
		$data = json_decode($data,true);
		$result = [];
		if($data['res']){
			foreach ($data['data'] as $key => $value) {
				$result[] = array('id'=>$value['payment'],'name'=>$value['name']);
			}
		}
		return $result;
	}

	/*拼接订单数据*/
	public function submit($order,$ip)
    {
    	$args = array(
    			'userid' => $order['uid'],
    			'email' => $this->mchid,
    			'body' => $order['goods'],
    			'website' => SHOPCODE,
    			'amount' => $order['total']/100,
    			'spbill_create_ip' => $ip,
    			'orderid' => $order['order_id'],
    			'payment' => $order['channel'],
    			'notifyurl' => 'http://'.$_SERVER['HTTP_HOST'].'/test/NotifyReceive.php'. ($order['channel'] == 'xpay' ? '': '?pay='. $order['channel']),
    			'returnurl' => 'http://'.$_SERVER['HTTP_HOST'],
    			'time_expire' => $order['addtime'],
    			'fee_type' => 1,
    			'sign' => ''
			);
    	$sign = $this->sign($args);
    	$args['sign'] = $sign;
        
    	$data = _curlPost($this->payurl.'orderinfo',$args);
    	
    	$data = json_decode($data,true);

    	if($data['res']){
			$this->submit_p($data['data']);
    	}else{
            echo json_encode(returnData(0,'',$data['msg']));
        }
    }

    /*异步回调数据推送*/
    function pushSyncData($data)
    {
    	$data = curlRequest($this->payurl.'notifyinfo',$data);
    	//var_dump($data);exit;
        return $data;
    }

    function submit_p($data)
    {
    	$data = $data['method'];
    	if($data['pay_type'] == 1){
    		/*echo '<!DOCTYPE html>'."\n";
	        echo '<html>'."\n";
	        echo '<head>'."\n\t";
	        echo '<meta charset="utf-8" />'."\n\t";
	        echo '<title>付款中</title>'."\n";
	        echo '</head>'."\n<body>\n";*/
	        $html = '<form action="'.$data['url'].'" method="post" id="webform">';
	        foreach ($data['params'] as $name => $value){
	            $html .= "<input type='hidden' name='$name' value='$value'>";
	        }
	        $html .= '</form>';
	        $html .= '<script type="text/javascript">document.getElementById(\'webform\').submit();</script>';
	        echo $html; 
    	}elseif($data['pay_type'] == 2){
    		//$data['params'];
            //$result = "http://paysdk.weixin.qq.com/example/qrcode.php?data=".urlencode($data['params']);
    		returnData(1,'',$data['params']);
    	}
    }


    /*验签数据*/
    public function sign($data)
    {
    	if(isset($data['sign'])){
            unset($data['sign']);
        }
        ksort($data);
        $string = '';
        foreach ($data as $name => $value) {
            if($value !== ''){
                $string .= $name . '=' . $value . '&';
            }
        }
        $string = substr($string, 0, strlen($string) - 1);
        $string = strtoupper(md5($string));
        return $string;
    }
}
?>