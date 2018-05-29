<?php

require_once (CLASS_DIR."GoodsOrderClass.class.php");

class doudoupay_submit
{
	public $param, $config;
	public function __construct($param,$config)
	{
		$this->param = $param;
		$this->config = $config;
		include_once('doudoupay.php');
        require_once (CLASS_DIR."GoodsOrderClass.class.php");
	}

    

    public function submit()
    {
        $dataArray = [
            'merchant_no'           => $this->config['merchant_no'],
            'order_sn'              => $this->param['order_id'],
            'ord_name'              => $this->param['goods'],
            'pay_amount'            => $this->param['total'],
            'ord_currency'          => $this->config['ord_currency'],
            'account_name'          => $this->param['name'],//银行卡姓名！
            'account_no'            => $this->param['bank'],//银行卡号！
            'id_card_no'            => $this->param['idcard'],//身份证号！
            'phone'                 => $this->param['phone'],//手机号！
            'merchant_notify_url'   => $this->config['merchant_notify_url'],
        ];

		
        $payment = new doudoupay_payment($this->config);
        $getParams = $payment->getParams('doudoupay.post.merchant.quick.Order.OrderPayInit');
        $res = $payment->dataCombineAndSend($dataArray, $getParams);
		
        if($res['errcode']){
            returnData(false, $res['msg'],'');
        }else{
            
            returnData(true, $res['msg'],'');
        }
        //返回信息
        /*Array
        (
            [errcode] => 0
            [msg] => ok
            [data] => Array
            (
                [bank_card_type] => 0
                    [bank_code] =>
                    [merchant_no] => 1180316041250713
                    [ord_currency] => CNY
                    [order_sn] => 20180319213216871663
                    [out_order_sn] => 1800005112018031921332421048
                    [pay_amount] => 101
                    [pay_status] => 0
                )

            [sign] => c0c2e8501debf1363c49b763abd1c3e7
         )*/
    }

    public function smsCommit()
    {
        $dataArray = [
            'merchant_no'           => $this->config['merchant_no'],
            'order_sn'              => $this->param['order_id'],
            //'order_sn'              => '20180320101653470581',//订单号！
            'check_code'            => $this->param['sms_code']//'996574'//验证码！
        ];
        $payment = new doudoupay_payment($this->config);
        $getParams = $payment->getParams('doudoupay.post.merchant.quick.Order.OrderPayCommit');
        $res = $payment->dataCombineAndSend($dataArray, $getParams);
        $goodorder = new GoodsOrderClass;
        if($res['errcode']){
            returnData(false, $res['msg'], $res['data']);
        }else{
            $goodorder -> GetOrderInfo($res['data']['order_sn']);
            returnData(true, $res['msg'], '');
        }
    //返回信息
        /*Array
        (
            [errcode] => 0
    [msg] => ok
    [data] => Array
    (
        [bank_card_type] => 0
            [bank_code] =>
            [merchant_no] => 1180316041250713
            [ord_currency] => CNY
    [order_sn] => 20180319212847388812
            [out_order_sn] => 1800005112018031921295525112
            [pay_amount] => 101
            [pay_status] => 1
            [pay_time] => 1521466228
            [trade_state] => SUCCESS
        )

    [sign] => b64d0be664fd3e1c87851cb0a3eb0690
)*/
    }

}
?>