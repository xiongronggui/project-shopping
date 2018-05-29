<?php

class qilinbailin_notify
{
	public $param, $order, $pay_time, $config;
	public $payment;
	public function __construct($config)
	{
		$this->config = $config;
		$data = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input"); 
		//$data = json_decode($data, true);
		!empty($data) ?: ($data = $_POST);
		logInfo('内部参数获取'.json_encode($data));
		parse_str($data, $args);
		$this->param = $args;
		$this->pay_time = time();  
		$this->order = $this->param['traceno'];
        include_once('qilinbailinpay.php');
    }


	public function submit()
	{
		$pay = new qilinbailinpay_payment($this->config);

		$sign = $this->param['signature'];
		if(!$sign){
		    logInfo($this->order.' 7080 error1');
			exit('error1');
		}

        if($this->param['status'] != 2){
            logInfo($this->order.' 7080 error2');
            exit('error2');
        }

		if(!$pay->isValid($this->param, $sign)){
            logInfo($this->order.' 7080 error3');
			exit('error3');
		}
		return true;
	}
}
?>