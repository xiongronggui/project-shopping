<?php

class llpcpay_submit
{
    public $param, $config;

    public function __construct($param,$config)
    {
        $this->config = $config;
        $this->param = $param;
        include_once ('llpcpay.php');
    }

    public function submit()
    {
        date_default_timezone_set('PRC');
        //构造要请求的参数数组，无需改动
        $tt = date('Y').date('m').date('d').date('H').date('i').date('s');
        $risk_item = array(
            "frms_ware_category"=>"4003",
            "user_info_mercht_userno" => $this->config['user_id'],
            "user_info_dt_register" => $tt,
            "user_info_bind_phone" => $_SESSION['members']['info']['mobile'],
            "delivery_addr_province" => '340000',
            "delivery_addr_city" => '341600',
            "delivery_phone" => $_SESSION['members']['info']['mobile'],
            "logistics_mode" => '3',
            "delivery_cycle" => '24h',
            "goods_count" => "1"
        );

        $parameter = array (
            "version" => trim($this->config['version']),
            "oid_partner" => trim($this->config['oid_partner']),
            "sign_type" => trim($this->config['sign_type']),
            "userreq_ip" => trim($this->config['userreq_ip']),
            "id_type" => trim($this->config['id_type']),
            "valid_order" => trim($this->config['valid_order']),
            'user_id' => $_SESSION['members']['info']['id'],
            "timestamp" => $tt,
            'busi_partner' => $this->config['busi_partner'],
            'no_order' => $this->param['order_id'],
            "dt_order" => $tt,
            'name_goods' => '商品',
            'info_order' => '',
            'money_order' => '0.1',
            'notify_url' => $this->config['notify_url'],
            'url_return' => $this->config['url_return'],
            'url_order' => '',
            'bank_code' => '',
            'pay_type' => '1',
            'no_agree' => NULL,
            'shareing_data' => '',
            'risk_item' => json_encode($risk_item),
            'id_no' => NULL,
            'acct_name' => '',//银行账号姓名
            'flag_modify' => NULL,
            'card_no' => NULL,
            'back_url' => NULL,
        );


//建立请求
        $llpaySubmit = new llpcpay_payment($this->config);
//        tbug($parameter);
        $html_text = $llpaySubmit->buildRequestForm($parameter, "post", "确认");
        echo $html_text;


    }


}

?>
