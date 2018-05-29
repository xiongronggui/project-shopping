<?php

class qilinbailinpay_submit
{
	public $param, $config;
	public function __construct($param,$config)
	{
		$this->param = $param;
		$this->config = $config;
		include_once('qilinbailinpay.php');
	}

    public function submit()
    {
        $payment = new qilinbailinpay_payment($this->config);
        $params = [
            'merchno'       => $this->config['merchno'],
            'amount'    => number_format($this->param['total']/100,2, ".", ""),
            'traceno'     => $this->param['order_id'],
            'channel' => '2',
			'bankCode' => '3001',
            'settleType'       => '1',
            'notifyUrl'     => $this->config['notifyurl'],
            'returnUrl'     => $this->config['returnurl']
        ];
        $params['signature'] = $payment->sign($params);
		
        //建立请求
        echo '<!DOCTYPE html>'."\n";
        echo '<html>'."\n";
        echo '<head>'."\n\t";
        echo '<meta charset="utf-8" />'."\n\t";
        echo '<title>正在转到付款页</title>'."\n";
        echo '</head>'."\n<body>\n";
        echo '<form action="'.$this->config['payurl'].'" method="post" id="webform">';
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
