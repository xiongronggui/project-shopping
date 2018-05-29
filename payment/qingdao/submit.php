<?php

class jialianpay_submit
{
	public $param, $config;
	public function __construct($param,$config)
	{
		$this->param = $param;
		$this->config = $config;
		include_once('qindao.php');
	}

    public function submit()
    {
        $payment = new qindao_payment($this->config);
        $paytype = 'kuaijie';
        $params = [
            'amount'     => number_format($this->param['amount']/100,2,'.',''),
            'merchno'    => $this->config['merchno'],
            'cardno' => $this->param['cardno'],
            'certno' => $this->param['certno'],
            'goodsName'     => $this->param['goodsName'],
            'intertype'       => 2,
            'notifyurl'     => $this->config['notifyurl'],
            'returnurl'     => $this->config['returnurl'],
            'traceno' => $this->param['traceno'],
            'trueName'        => $this->param['trueName'],
            'mobile'        => $this->param['mobile'],
            'settleType'        => $this->config['settleType'],
        ];
        $params['signature'] = $payment->sign($params);
        //建立请求
        echo '<!DOCTYPE html>'."\n";
        echo '<html>'."\n";
        echo '<head>'."\n\t";
        echo '<meta charset="utf-8" />'."\n\t";
        echo '<title>正在转到付款页</title>'."\n";
        echo '</head>'."\n<body>\n";
        echo '<form action="http://www.hzmhkj.com/apisubmit" method="post" id="webform">';
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
