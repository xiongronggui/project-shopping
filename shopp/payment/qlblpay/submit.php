<?php

class qlblpay_submit
{
    public $param, $config;

    public function __construct($param, $config)
    {
        $this->config = $config;
        $this->param = $param;
        include_once('qlblpay.php');
    }





    public function submit()
    {
        $url = $this->config['su_url'];
        $key  = $this->config['key'];
        $req["merchno"] = $this->config['merchno'];// 锐捷测试账号
        $req["amount"] = "1.00";
        $req["traceno"] = $this->param['order_id'];
        $req["channel"] = $this->param['channel'];
        $req["bankCode"] = "3001";
        $req["settleType"] = $this->config['settleType'];
        $req["notifyUrl"] = $this->config['notifyUrl'];
        $req["returnUrl"] = $this->config['returnUrl'];



        $md5Param = "amount=".$req["amount"]
            ."&bankCode=".$req["bankCode"]
            ."&channel=".$req["channel"]
            ."&merchno=".$req["merchno"]
            ."&notifyUrl=".$req["notifyUrl"]
            ."&returnUrl=".$req["returnUrl"]
            ."&settleType=".$req["settleType"]
            ."&traceno=".$req["traceno"]
            ."&".$key;



        $signature = strtoupper(md5($md5Param));
        $req['signature'] = $signature;
//方便查看输出结果,换行一下
//        echo "\n";
//拼装URL请求参数，中文以GBK编码并URL转码
        $param =
            "&signature=".$signature
            .$md5Param = "amount=".$req["amount"]
                ."&bankCode=".$req["bankCode"]
                ."&channel="."1"
                ."&merchno=".$req["merchno"]
                ."&notifyUrl=".$req["notifyUrl"]
                ."&returnUrl=".$req["returnUrl"]
                ."&settleType=".$req["settleType"]
                ."&traceno=".$req["traceno"];

        $html =  "<form id='pay_form' name='pay_form' action='".$url."' method='POST'>";
        $html .= "<input type='hidden' name='signature' value='".$req['signature']."'	/>";
        $html .="<input type='hidden' name='amount' value='".$req['amount']."'	/>";
        $html .="<input type='hidden' name='channel' value='".$req['channel']."'	/>";
        $html .="<input type='hidden' name='merchno' value='".$req['merchno']."'	/>";
        $html .="<input type='hidden' name='bankCode' value='".$req['bankCode']."'	/>";
        $html .="<input type='hidden' name='notifyUrl' value='".$req['notifyUrl']."'	/>";
        $html .="<input type='hidden' name='returnUrl' value='".$req['returnUrl']."'	/>";
        $html .="<input type='hidden' name='settleType' value='".$req['settleType']."'	/>";
        $html .="<input type='hidden' name='traceno' value='".$req['traceno']."'	/></form>";
        $html .="<script language='javascript'>window.onload=function(){document.pay_form.submit();}</script>";
        echo  $html;
    }




}

?>
