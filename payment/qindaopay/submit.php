<?php

class qindaopay_submit
{
	public $param, $config;
	public function __construct($param,$config)
	{
		$this->param = $param;
		$this->config = $config;
		include_once('qingdao.php');
	}

    public function submit()
    {
        $payment = new qindao_payment($this->config);
        $paytype = 'kuaijie';
        $params = [
            'amount'     => '2.11',//number_format($this->param['amount']/100,2),
            'merchno'    => '333370289990001',//$this->config['merchno'],
            'cardno' => '6212264000011246184',//$this->param['bank'],
            'certno' => '350824198807144971',//$this->param['idcard'],
            //'goodsName'     => $this->param['goodsName'],
            'interType'       => 2,
            'notifyUrl'     =>'http://www.baidu.com', //$this->config['notifyurl'],
            //'returnurl'     => //$this->config['returnurl'],
            'traceno' => '435435435435455', //$this->param['order_id'],
            'trueName'        => '熊荣贵',//$this->param['name'],
            'mobile'        => '13632520512', //$this->param['mobile'],
            'settleType'        => '1' //$this->config['settleType'],
        ];
        $params['signature'] = $payment->sign($params);
        //建立请求
        echo '<!DOCTYPE html>'."\n";
        echo '<html>'."\n";
        echo '<head>'."\n\t";
        echo '<meta charset="utf-8" />'."\n\t";
        echo '<title>正在转到付款页</title>'."\n";
        echo '</head>'."\n<body>\n";
        echo '<form action="http://api.zhruijie.net/fastPay" method="post" id="webform">';
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
