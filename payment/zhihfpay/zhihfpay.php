<?php

/**
 *
 */
class zhihfpay_payment
{
    private $_config, $param;

    function __construct($_zhihfconfig, $param)
    {
        $this->_config = $_zhihfconfig;
        $this->param = $param;
    }

    public function notify()
    {
        $merchant_code = $this->param["merchant_code"];
        $interface_version = $this->param["interface_version"];
        $sign_type = $this->param["sign_type"];
        $zhihpaySign = base64_decode($this->param["sign"]);
        $notify_type = $this->param["notify_type"];
        $notify_id = $this->param["notify_id"];
        $order_no = $this->param["order_no"];
        $order_time = $this->param["order_time"];
        $order_amount = $this->param["order_amount"];
        $orginal_money = !empty($this->param["orginal_money"]) ? $this->param["orginal_money"] : '';
        $trade_status = $this->param["trade_status"];
        $trade_time = $this->param["trade_time"];
        $trade_no = !empty($this->param["trade_no"])? $this->param["trade_no"] :'';
        $bank_seq_no = $this->param["bank_seq_no"];
        $extra_return_param = !empty($this->param["extra_return_param"])?$this->param["extra_return_param"]:'';


/////////////////////////////   参数组装  /////////////////////////////////
        /**
         * 除了sign_type zhihpaySign参数，其他非空参数都要参与组装，组装顺序是按照a~z的顺序，下划线"_"优先于字母
         */


        $signStr = "";

        if ($bank_seq_no != "") {
            $signStr = $signStr . "bank_seq_no=" . $bank_seq_no . "&";
        }

        if ($extra_return_param != "") {
            $signStr = $signStr . "extra_return_param=" . $extra_return_param . "&";
        }

        $signStr = $signStr . "interface_version=" . $interface_version . "&";
        $signStr = $signStr . "merchant_code=" . $merchant_code . "&";
        $signStr = $signStr . "notify_id=" . $notify_id . "&";
        $signStr = $signStr . "notify_type=" . $notify_type . "&";
        $signStr = $signStr . "order_amount=" . $order_amount . "&";
        $signStr = $signStr . "order_no=" . $order_no . "&";
        $signStr = $signStr . "order_time=" . $order_time . "&";

        if ($orginal_money != "") {
            $signStr = $signStr . "orginal_money=" . $orginal_money . "&";
        }

        $signStr = $signStr . "trade_no=" . $trade_no . "&";
        $signStr = $signStr . "trade_status=" . $trade_status . "&";
        $signStr = $signStr . "trade_time=" . $trade_time;
        //echo $signStr;

/////////////////////////////   RSA-S验证  /////////////////////////////////


        $zhihpay_public_key = openssl_get_publickey($this->_config['zhihpay_public_key']);
        logInfo('notify::'.json_encode($signStr));
        $flag = openssl_verify($signStr, $zhihpaySign, $zhihpay_public_key, OPENSSL_ALGO_MD5);


///////////////////////////   响应“SUCCESS” /////////////////////////////


        if ($flag) {
            return true;
        } else {
            return false;
        }
    }


}

?>