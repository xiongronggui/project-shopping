<?php

class metis_notify
{
	public $param, $order, $pay_time, $config;
	public $payment;
	public function __construct($config)
	{
		$this->config = $config;
		$data = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input"); 
		$data = json_decode($data, true);
		!empty($data) ?: ($data = $_POST); 
		logInfo('metis:'.json_encode($data));
		$this->param = $data;
		$this->pay_time = $data['orderDate'];
		$this->order = $data['orgOrderNo'];
        include_once('metispay.php');
    }


	public function submit()
	{
		$pay = new metispay_payment($this->config);
		logInfo(json_encode($this->config));

		$sign = $this->param['signature'];
		if(!$sign){
			logInfo('meits:error1');
			exit('error1');
		}

        if($this->param['respCode'] != '0000'){
			logInfo('meits:error2');
            exit('error2');
        }

        $valid_param = $this->param;
        unset($valid_param['signature']);

		if(!$pay->isValid($valid_param, $sign)){
			logInfo('meits:error3');
			exit('error3');
		}
		$payment_status = $this->param['paySt'];
		if($payment_status != 2){
			logInfo('meits:error4');
			exit('error4');
		}
		return true;

	}
}
?>