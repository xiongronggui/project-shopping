<?php

class ghtpay_submit
{
	public $param, $config;
	public function __construct($param,$config)
	{
		$this->param = $param;
		$this->config = $config;
		include_once('ghtpay.php');
	}

    public function submit()
    {
        $payment = new ghtpay_payment($this->config);

        $params = [
            'service'           => $this->config['service'],
            'merchantNo'        => $this->config['merchantNo'],
            'pageUrl'           => $this->config['pageUrl'],
            'bgUrl'             => $this->config['bgUrl'],
            'version'           => $this->config['version'],
            'payChannelCode'    => $this->config['payChannelCode'],
            'payChannelType'    => $this->config['payChannelType'],
            'curCode'           => $this->config['curCode'],

            'orderNo'           => $this->param['order_id'],
            'orderAmount'       => $this->param['total'],
            'orderTime'         => date('YmdHis'),
            'orderSource'       => '1',
        ];
        //tbug($params);
        $params['sign'] = $payment->sign($params);
        $url = 'http://service.gaohuitong.com/PayApi/bankPay';
        //建立请求
        echo '<!DOCTYPE html>'."\n";
        echo '<html>'."\n";
        echo '<head>'."\n\t";
        echo '<meta charset="utf-8" />'."\n\t";
        echo '<title>付款中</title>'."\n";
        echo '</head>'."\n<body>\n";
        echo '<form action="'.$url.'" method="post" id="webform">';
        foreach ($params as $name => $value){
            echo '<input type="hidden" name="'.$name.'" value="'.$value.'"/>';
        }
        echo '</form>';
        echo '<script type="text/javascript">document.getElementById(\'webform\').submit();</script>';
        echo "\n".'</body>'."\n</html>";
        exit;
    }
}
?>