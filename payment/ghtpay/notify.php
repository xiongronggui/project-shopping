<?php

class ght_notify
{
	public $param, $order, $pay_time, $config;
	public $payment;
	public $success = 'SUCCESS';

	public function __construct($config)
	{
		$this->config = $config;
		$data = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input"); 
		$data = json_decode($data, true);
		!empty($data) ?: ($data = $_POST); 
		logInfo('ght:'.json_encode($data));
		$this->param = $data;
		$this->pay_time = strtotime($data['dealTime']);
		$this->order = $data['orderNo']; 
        include_once('ghtpay.php');
    }


	public function submit()
	{
		$pay = new ghtpay_payment($this->config);

		$sign = $this->param['sign'];
		if(!$sign){
			logInfo('ght:error1');
			exit('error1');
		}

        if($this->param['dealCode'] != '10000'){
			logInfo('ght:error2');
            exit('error2');
        }

        $valid_param = $this->param;
        unset($valid_param['sign']);

		if(!$pay->isValid($valid_param, $sign)){
			logInfo('ght:error3');
			exit('error3');
		}

		return true;

	}
}
?>