<?php

class weixinpay_submit
{
    public $param, $config;

    public function __construct($param,$config)
    {
        $this->config = $config;
        $this->param = $param;
        include_once ('weixinpay.php');
    }

    public function submit()
    {
        $pay = new weixinpay_payment($this->config);
        $re = $pay->submit($this->param);
        returnData(1,'',$re);
//        echo $re;
//        echo json_encode($re);
    }


}

?>
