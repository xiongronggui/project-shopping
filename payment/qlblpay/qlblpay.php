<?php


class qlblpay_payment
{

    public $config;

    function __construct($config)
    {
        $this->config = $config;
    }

    public function verify($val)
    {
        $url = $this->config['no_url'];

        $merchno = $this->config['merchno'];
        $key = $this->config['key'];

        $traceno = $val['traceno'];
//        $traceno = intval(time());;
//        $amount = "1.00";
        $amount = $val['amount'];
        $notifyUrl = $val['notifyUrl'];//可不传
        $returnUrl = $val['returnUrl'];//可不传
        $goodsName = $val['goodsName'];
        $settleType = $val['settleType'];//默认为 T+1  1-T+0 结算     2-T+1 结算
//        $cardno = "5268550411071231";//卡号
        $cardno = $val['cardno'];//卡号
        $interType = $val['interType'];//接口类型

        $gbk_goodsName = iconv('utf-8', 'GB2312', $goodsName);
        //拼装MD5的参数值,不能改变顺序

        $md5Param = "amount=" . $amount
            . "&cardno=" . $cardno
            . "&goodsName=" . $gbk_goodsName
            . "&interType=" . $interType
            . "&merchno=" . $merchno
            . "&notifyUrl=" . $notifyUrl
            . "&returnUrl=" . $returnUrl
            . "&settleType=" . $settleType
            . "&traceno=" . $traceno
            . "&" . $key;

        //方便查看输出结果,换行一下
//        echo "\n";
        //签名值
        $signature = strtoupper(md5($md5Param));
        //方便查看输出结果,换行一下
//        echo "\n";
        //拼装URL请求参数，中文以GBK编码并URL转码
        $param =
            "&signature=" . $signature
            . "&amount=" . $amount
            . "&cardno=" . $cardno
            . "&goodsName=" . urlencode($gbk_goodsName)
            . "&interType=" . $interType
            . "&merchno=" . $merchno
            . "&notifyUrl=" . $notifyUrl
            . "&returnUrl=" . $returnUrl
            . "&settleType=" . $settleType
            . "&traceno=" . $traceno
            . "&" . $key;

        $data = $param;
        $res = $this->http_request($url, $data);
        //将返回结果GBK转UTF-8输出显示
        $utf = iconv('GB2312', 'utf-8', $res);
        $re = json_decode($utf,true);
        return $re;
    }

    function http_request($url, $data)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }


}

?>