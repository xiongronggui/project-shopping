<?php

class doudou_notify
{
	public $param, $order, $pay_time, $config;
	public $payment;
	public $success = 'SUCCESS';
	public function __construct($config)
	{
		$this->config = $config;
		$data = $_POST;
		//回调数据示例
        //{"merchant_no":"1180316041250713","out_order_sn":"1800005112018031921295525112","order_sn":"20180319212847388812","bank_code":"","bank_card_type":"0","ord_currency":"CNY","pay_amount":"101","pay_status":"1","pay_time":"1521466228","trade_state":"SUCCESS","sign":"99fba2b05b413241c78fed6488f1e4f3"}
		$this->param = $data;
		$this->pay_time = $data['pay_time'];
		$this->order = $data['order_sn'];
        include_once('doudoupay.php');
    }


	public function submit()
	{
		$pay = new doudoupay_payment($this->config);

        //tbug($this->param);
		$sign = $this->param['sign'];
		if(!$sign){
			exit('error1');
		}

        if($this->param['trade_state'] != 'SUCCESS'){
            exit('error2');
        }

        $data = $this->param;
		unset($data['sign']);

		if(!$pay->isValid($data, $sign)){
			exit('error3');
		}
		$payment_status = $this->param['pay_status'];
		if($payment_status != 1){
			exit('error4');
		}
		return true;

	}
}
?>