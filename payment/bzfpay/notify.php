<?php

class bzf_notify
{
	public $param, $order, $pay_time, $config;
	public $payment;
	public function __construct($config)
	{
		$this->config = $config;
		$data = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input"); 
		$data = json_decode($data, true);
		!empty($data) ?: ($data = $_POST);
		logInfo('内部参数获取'.json_encode($data));
		$this->param = $data;
		$this->pay_time = time();
		$this->order = $data['sdorderno'];
        include_once('bzfpay.php');
    }


	public function submit()
	{
		$pay = new bzfpay_payment($this->config);

		$sign = $this->param['sign'];
		if(!$sign){
		    logInfo($this->order.' 宝泽付 error1');
			exit('error1');
		}

        if($this->param['status'] != 1){
            logInfo($this->order.' 宝泽付 error2');
            exit('error2');
        }

		if(!$pay->isValid($this->param, $sign)){
            logInfo($this->order.' 宝泽付 error3');
			exit('error3');
		}
		return true;
	}
}
?>