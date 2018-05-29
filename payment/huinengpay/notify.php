<?php

class huineng_notify
{
	public $param, $order, $pay_time, $config;
	public $payment;
	public function __construct($config)
	{
		$this->config = $config;
		$data = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input"); 
		$data = json_decode($data, true);
		!empty($data) ?: ($data = $_POST); 
		logInfo('huineng:'.json_encode($data));
		$this->param = $data;
		$this->pay_time = $data['orderDate'];
		$this->order = $data['orgOrderNo'];
        include_once('huinengpay.php');
    }


	public function submit()
	{
		$pay = new huinengpay_payment($this->config);
		logInfo(json_encode($this->config));

		$sign = $this->param['sign'];
		if(!$sign){
			logInfo('huineng:error1');
			exit('error1');
		}

        if($this->param['trade_state'] != 0){
			logInfo('huineng:error2');
            exit('error2');
        }

        //$valid_param = $this->param;
        //unset($valid_param['signature']);

		/*if(!$pay->isValid($valid_param, $sign)){
			logInfo('huineng:error3');
			exit('error3');
		}
		$payment_status = $this->param['paySt'];
		if($payment_status != 2){
			logInfo('huineng:error4');
			exit('error4');
		}*/
		return true;

	}
}
?>