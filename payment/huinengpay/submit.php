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
            'spbill_create_ip' => '116.24.98.236',
            'time_start' => date('Ymdhmi')
        );
        //'key' => '3ec05ef3979fb5c9a87e8166ec2d0d2b'
        
        $old_sign = $payment->dataCombine($params);
        $str = trim($old_sign."&key=".$this->config['key']);
        //$str = trim('body=商品描述&fee_type=1&notify_url=http://www.klt.com:8091/fic.xs9999/common_receive.php?p_c=huineng&order_money=61960&out_trade_no=801180326194238417&partner=392318431@qq.com&return_url=http://www.klt.com:8091/fic.xs9999/goods_order.php&spbill_create_ip=116.24.98.236&time_start=20180326070342&key=3ec05ef3979fb5c9a87e8166ec2d0d2b');
        $sign = strtoupper(md5($str));
        
        logInfo("str->".$old_sign."&key=".$this->config['key'].",md5->".$sign);
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