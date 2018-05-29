<?php

class metispay_submit
{
	public $param, $config;
	public function __construct($param,$config)
	{
		$this->param = $param;
		$this->config = $config;
		include_once('metispay.php');
	}

    public function submit()
    {
        $payment = new metispay_payment($this->config);

        $params = [
            'orgId'         => $this->config['orgId'],
            'source'        => $this->config['source'],
            'currency'      => $this->config['currency'],
            'account'       => $this->config['account'],
            'bankCode'      => $this->config['bankCode'],
            'notifyUrl'     => $this->config['notifyUrl'],
            'callbackUrl'   => $this->config['callbackUrl'],

            'subject'       => $this->param['goods'],
            'orgOrderNo'    => $this->param['order_id'],
            'amount'        => $this->param['total'],

            'clientIp'      => $_SERVER['REMOTE_ADDR'],
            'orderDate'     => date("Ymd", strtotime($this->param['addtime_show'])),
        ];

        $params['signature'] = $payment->sign($params);
        $url = 'http://39.108.82.202:8088/quick-pay-api/v1.0/order/unionPayGateway';

        $res = http_post_json($url, json_encode($params));
        $res = json_decode($res, true);
        if(isset($res['html'])){
            echo $res['html'];
        }else{
            print_r($res);
        }
        exit;

        //建立请求
        /*echo '<!DOCTYPE html>'."\n";
        echo '<html>'."\n";
        echo '<head>'."\n\t";
        echo '<meta charset="utf-8" />'."\n\t";
        echo '<title>付款中</title>'."\n";
        echo '</head>'."\n<body>\n";
        echo '<form action="'.$uri.'" method="post" id="webform">';
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