<?php
/***********************************************************
 * Note    : 中付宝付款操作
 * Version : 1.0
 * Author  : fangyi
 * Update  : 2018-03-02
 ***********************************************************/

//require_once '/include/common.php';

class lypay_payment
{

    public $config;

    function __construct($config)
    {
        $this->config = $config;
    }

    public function isValid($data)
    {
        $mysign =md5('version=' . $data['version']  . '&customerid=' . $data['customerid'] . '&total_fee=' . $data['total_fee'] . '&sdorderno=' . $data['order_id'] . '&notifyurl=' . $data['notifyurl'] . '&returnurl=' . $data['returnurl'] . '&' . $this->config['userkey']);

        return $mysign;
    }




}

?>