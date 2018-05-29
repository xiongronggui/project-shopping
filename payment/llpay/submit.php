<?php

class llpay_submit
{
    public $param, $config;

    public function __construct($param,$config)
    {
        $this->config = $config;
        $this->param = $param;
        include_once ('llpay.php');
    }

    public function submit()
    {
        /************************************************************/
        date_default_timezone_set('PRC');
        //构造要请求的参数数组，无需改动
        
		$tt = $this->config['dt_order'];
		$risk_item = array(
			"frms_ware_category"=>4003,
			"user_info_mercht_userno" => $this->config['user_id'],
			"user_info_dt_register" => $tt,
			"user_info_bind_phone" => '13632520511',
			"delivery_addr_province" => '340000',
			"delivery_addr_city" => '341600',
			"delivery_phone" => '13632520511',
			"logistics_mode" => '3',
			"delivery_cycle" => '24h',
			"goods_count" => 1
		);
        $parameter = array(
            "version" => trim($this->config['version']),
            "oid_partner" => trim($this->config['oid_partner']),
            "user_id" => $this->config['user_id'],
			'app_request' =>3,
            "sign_type" => trim($this->config['sign_type']),
            'busi_partner'=>$this->config['busi_partner'],
            "no_order" => $this->param['order_id'],//商户唯一订单号
			
            'dt_order'=>$tt,
            'name_goods'=>$this->config['name_goods'],
            "money_order" => '0.1',//交易金额
			
            "notify_url" => $this->config['notify_url'],
			"risk_item" => json_encode($risk_item)
        );
        //建立请求
        $llpaySubmit = new llpay_payment($this->config);
        $html_text = $llpaySubmit->buildRequestForm($parameter, "post", "确认");
        echo $html_text;


    }


}

?>
