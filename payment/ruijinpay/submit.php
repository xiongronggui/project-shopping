<?php

class ruijinpay_submit
{
	public $param, $config;
	public function __construct($param,$config)
	{
		$this->param = $param;
		$this->config = $config;
		include_once('ruijinpay.php');
	}

    public function submit()
    {
        $payment = new ruijinpay_payment($this->config);

        $params = [
            'service_type'         => 'sign_pay_sms_code',
            'merchant_code'        => $this->config['merchant_code'],
            'interface_version'    => $this->config['interface_version'],
            'input_charset'        => $this->config['input_charset'],
            'sign_type'            => $this->config['sign_type'],
            //'notify_url'           => $this->config['notify_url'],
            'mobile'               => $this->config['mobile'],

            'sms_type'          => '1',
            'send_type'         => '0',
            //'product_name'      => $this->param['goods'],
            'order_no'          => $this->param['order_id'],
            'order_amount'      => number_format($this->param['total']/100,2,'.',''),
            //'order_time'        => date('Y-m-d H:i:s'),
            'bank_code'         => 'CCB',
            'card_type'         => '0',
            'encrypt_info'      => $payment->encrypt_info_sign('6227001689690730132', '方祎', '340803199411182358')
        ];
        tbug($params, false);
        $sign_params = $params;
        unset($sign_params['notify_url'], $sign_params['sign_type']);
        //tbug($sign_params);
        $params['sign'] = $payment->sign($sign_params);
        $url = 'https://api.fykgsz.cn/gateway/api/express';

        $res = $payment->postCurl($url, $params);
        $res = $payment->xmlToArray($res);
        tbug($res);

        /*//建立请求
        echo '<!DOCTYPE html>'."\n";
        echo '<html>'."\n";
        echo '<head>'."\n\t";
        echo '<meta charset="utf-8" />'."\n\t";
        echo '<title>付款中</title>'."\n";
        echo '</head>'."\n<body>\n";
        echo '<form action="https://api.fykgsz.cn/gateway/api/express" method="post" id="webform">';
        foreach ($params as $name => $value){
            echo '<input type="hidden" name="'.$name.'" value="'.$value.'"/>';
        }
        echo '</form>';
        echo '<script type="text/javascript">document.getElementById(\'webform\').submit();</script>';
        echo "\n".'</body>'."\n</html>";
        exit;*/
    }
}
?>