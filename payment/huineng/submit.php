<?php

//require_once '/include/common.php';

class huinengpay_submit
{
    public $param, $config;

    public function __construct($param, $config)
    {
        $this->param = $param;
        $this->config = $config;
        include_once('huinengpay.php');
    }

    public function submit()
    {
        $payment = new huinengpay_payment($this->config,$this->param);

        $params = array(
            'bank_type' => 'icbc',
            'body' => $this->config['body'],
            'return_url' => $this->config['return_url'],
            'notify_url' => $this->config['notify_url'],
            'partner' => $this->config['partner'],
            'out_trade_no' => $this->param['order_id'],
            'order_money' => $this->param['total'],
            'fee_type' => $this->config['fee_type'],
            'spbill_create_ip' => '127.0.0.1',
            'time_start' => date('Ymdhmi')
        );
        //'key' => '3ec05ef3979fb5c9a87e8166ec2d0d2b'
        
        $old_sign = $payment->dataCombine($params);
        $sign = md5($old_sign."&key=".$this->config['key']);
        $params['sign'] = $sign;
        $url = 'http://tob.xsmcfx.cc/payment/pay.php';
        
        //建立请求
        echo '<!DOCTYPE html>'."\n";
        echo '<html>'."\n";
        echo '<head>'."\n\t";
        echo '<meta charset="utf-8" />'."\n\t";
        echo '<title>正在转到付款页</title>'."\n";
        echo '</head>'."\n<body>\n";
        echo '<form action='.$url.' post" id="webform">';
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