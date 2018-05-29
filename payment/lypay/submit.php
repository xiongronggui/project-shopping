<?php

class lypay_submit
{
    public $param, $config;

    public function __construct($param, $config)
    {
        $this->param = $param;
        $this->config = $config;
        include_once('lypay.php');
    }

    public function submit()
    {
        $payment = new lypay_payment($this->config);
        $data['version'] = '1.0';
        $data['customerid'] = $this->config['customerid'];
        $data['sdorderno'] = $this->param['order_id'];
        $data['total_fee'] = number_format($this->param['total']/100,2);
        $data['paytype'] = $this->config['paytype'] == 'quick' ? 'quickbank' : 'bank';
        $data['bankcode'] = $this ->config['bankcode'];
        $data['notifyurl'] = $this->config['notifyurl'];
        $data['returnurl'] = $this->config['returnurl'];
        $data['get_code'] = 0;
        $data['sign'] = $payment->isValid($data);
        

        //建立请求
        echo '<!DOCTYPE html>'."\n";
        echo '<html>'."\n";
        echo '<head>'."\n\t";
        echo '<meta charset="utf-8" />'."\n\t";
        echo '<title>正在转到付款页</title>'."\n";
        echo '</head>'."\n<body>\n";
        echo '<form action="'.$this->config['payurl'].'" method="post" id="webform">';
        foreach ($data as $name => $value){
            echo '<input type="hidden" name="'.$name.'" value="'.$value.'"/>';
        }
        echo '</form>';
        echo '<script type="text/javascript">document.getElementById(\'webform\').submit();</script>';
        echo "\n".'</body>'."\n</html>";
        exit;
    }
}

?>
