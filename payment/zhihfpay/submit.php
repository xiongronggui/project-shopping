<?php

//require_once '/include/common.php';

class zhihfpay_submit
{
    public $param, $config;

    public function __construct($param, $config)
    {
        $this->param = $param;
        $this->config = $config;
        include_once('zhihfpay.php');
    }

    public function submit()
    {
        $merchant_code = $this->config['merchant_code'];
        $service_type = $this->config['service_type'];
        $interface_version = $this->config['interface_version'];
        $sign_type = $this->config['sign_type'];
        $input_charset = $this->config['input_charset'];
        $notify_url = $this->config['notify_url'];
        $order_no = $this->param['order_id'];
        $order_time = date('Y-m-d H:i:s');
        $order_amount = $this->param['total']/100;
        $product_name = "商品";
        //以下参数为可选参数，如有需要，可参考文档设定参数值
        $return_url = "";
        $pay_type = "";
        $redo_flag = "";
        $product_code = "";
        $product_desc = "";
        $product_num = "";
        $show_url = "";
        $client_ip = "";
        $bank_code = "";
        $extend_param = "";
        $extra_return_param = "";

/////////////////////////////   参数组装  /////////////////////////////////
        /**
         * 除了sign_type参数，其他非空参数都要参与组装，组装顺序是按照a~z的顺序，下划线"_"优先于字母
         */

        $signStr = "";

        if ($bank_code != "") {
            $signStr = $signStr . "bank_code=" . $bank_code . "&";
        }
        if ($client_ip != "") {
            $signStr = $signStr . "client_ip=" . $client_ip . "&";
        }
        if ($extend_param != "") {
            $signStr = $signStr . "extend_param=" . $extend_param . "&";
        }
        if ($extra_return_param != "") {
            $signStr = $signStr . "extra_return_param=" . $extra_return_param . "&";
        }

        $signStr = $signStr . "input_charset=" . $input_charset . "&";
        $signStr = $signStr . "interface_version=" . $interface_version . "&";
        $signStr = $signStr . "merchant_code=" . $merchant_code . "&";
        $signStr = $signStr . "notify_url=" . $notify_url . "&";
        $signStr = $signStr . "order_amount=" . $order_amount . "&";
        $signStr = $signStr . "order_no=" . $order_no . "&";
        $signStr = $signStr . "order_time=" . $order_time . "&";

        if ($pay_type != "") {
            $signStr = $signStr . "pay_type=" . $pay_type . "&";
        }

        if ($product_code != "") {
            $signStr = $signStr . "product_code=" . $product_code . "&";
        }
        if ($product_desc != "") {
            $signStr = $signStr . "product_desc=" . $product_desc . "&";
        }

        $signStr = $signStr . "product_name=" . $product_name . "&";

        if ($product_num != "") {
            $signStr = $signStr . "product_num=" . $product_num . "&";
        }
        if ($redo_flag != "") {
            $signStr = $signStr . "redo_flag=" . $redo_flag . "&";
        }
        if ($return_url != "") {
            $signStr = $signStr . "return_url=" . $return_url . "&";
        }

        $signStr = $signStr . "service_type=" . $service_type;

        if ($show_url != "") {

            $signStr = $signStr . "&show_url=" . $show_url;
        }

        //echo $signStr."<br>";
/////////////////////////////   获取sign值（RSA-S加密）  /////////////////////////////////

        $merchant_private_key = openssl_get_privatekey($this->config['merchant_private_key']);
        openssl_sign($signStr, $sign_info, $merchant_private_key, OPENSSL_ALGO_MD5);

        $sign = base64_encode($sign_info);
//        var_dump($sign);exit;

        echo '<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>	
	<body onLoad="document.zhihpayForm.submit();">
		<form name="zhihpayForm" method="post" action="https://pay.zhihfpay.com/gateway?input_charset=UTF-8">
			<input type="hidden" name="sign"		  value="' . $sign . '" />
			<input type="hidden" name="merchant_code" value="' . $merchant_code . '" />
			<input type="hidden" name="bank_code"     value="' . $bank_code . '"/>
			<input type="hidden" name="order_no"      value="' . $order_no . '"/>
			<input type="hidden" name="order_amount"  value="' . $order_amount . '"/>
			<input type="hidden" name="service_type"  value="' . $service_type . '"/>
			<input type="hidden" name="input_charset" value="' . $input_charset . '"/>
			<input type="hidden" name="notify_url"    value="' . $notify_url . '">
			<input type="hidden" name="interface_version" value="' . $interface_version . '"/>
			<input type="hidden" name="sign_type"     value="' . $sign_type . '"/>
			<input type="hidden" name="order_time"    value="' . $order_time . '"/>
			<input type="hidden" name="product_name"  value="' . $product_name . '"/>
			<input Type="hidden" Name="client_ip"     value="' . $client_ip . '"/>
			<input Type="hidden" Name="extend_param"  value="' . $extend_param . '"/>
			<input Type="hidden" Name="extra_return_param" value="' . $extra_return_param . '"/>
			<input Type="hidden" Name="pay_type"  value="' . $pay_type . '"/>
			<input Type="hidden" Name="product_code"  value="' . $product_code . '"/>
			<input Type="hidden" Name="product_desc"  value="' . $product_desc . '"/>
			<input Type="hidden" Name="product_num"   value="' . $product_num . '"/>
			<input Type="hidden" Name="return_url"    value="' . $return_url . '"/>
			<input Type="hidden" Name="show_url"      value="' . $show_url . '"/>
			<input Type="hidden" Name="redo_flag"     value="' . $redo_flag . '"/>
		</form>
	</body>
</html>';
    }
}

?>