<?php

class jialianpay_submit
{
	public $param, $config;
	public function __construct($param,$config)
	{
		$this->param = $param;
		$this->config = $config;
		include_once('jialianpay.php');
	}

    public function submit()
    {
        $payment = new jialianpay_payment($this->config);
        $paytype = ($this->param['channel'] == '嘉联') ? $this->config['paytype'] : 'kuaijie';
        $params = [
            'version'       => $this->config['version'],
            'customerid'    => $this->config['customerid'],
            'total_fee'     => number_format($this->param['total']/100,2,'.',''),
            'sdorderno'     => $this->param['order_id'],
            'paytype'       => $paytype,
            'bankcode'      => $this->config['bankcode'],
            'notifyurl'     => $this->config['notifyurl'],
            'returnurl'     => $this->config['returnurl'],
            'remark'        => $this->config['remark'],
        ];
        $params['sign'] = $payment->sign($params);
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
