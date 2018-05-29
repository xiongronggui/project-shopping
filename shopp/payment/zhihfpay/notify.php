<?php

//require_once '/include/common.php';

class zhihf_notify
{
    public $param, $order, $pay_time, $config;
    public $payment;

    public function __construct($config)
    {
        $this->config = $config;
        $data = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");
        $data = rtrim($data,'"');
        $data = ltrim($data,'"');
        parse_str($data, $args);
        $data = $args;
        !empty($data) ?: ($data = $_POST);
        $this->param = $data;
        logInfo(json_encode($data));
        $this->order = $data['order_no'];
        include_once('zhihfpay.php');
    }


    public function submit()
    {
        $pay = new zhihfpay_payment($this->config, $this->param);

        $sign = $this->param['sign'];
        if (!$sign) {
            logInfo('签名不存在::error1');
            exit('error1');
        }

        if ($this->param['trade_status'] != 'SUCCESS') {
            logInfo('支付失败::error2');
            exit('error2');
        }

        if (!$pay->notify()) {
            logInfo('验签失败::error3');
            exit('error3');
        }

        return true;

    }
}

?>