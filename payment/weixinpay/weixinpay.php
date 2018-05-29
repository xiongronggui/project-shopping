<?php
/***********************************************************
 * Note    : 中付宝付款操作
 * Version : 1.0
 * Author  : fangyi
 * Update  : 2018-03-02
 ***********************************************************/

require_once PAYMENT_URL.'weixinpay/example/native.php';

class weixinpay_payment
{

    public $config;

    function __construct($config)
    {
        $this->config = $config;
    }

    public function submit($val)
    {
        $notify = new NativePay();
        //模式二
        /**
         * 流程：
         * 1、调用统一下单，取得code_url，生成二维码
         * 2、用户扫描二维码，进行支付
         * 3、支付完成之后，微信服务器会通知支付成功
         * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
         */
        $input = new WxPayUnifiedOrder();
        $input->SetBody($val['goods']);//商品描述
        $input->SetAttach($val['goods']);//附加数据
//        $input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis").'1');//商户订单号
        $input->SetOut_trade_no($val['order_id']);//商户订单号
        $input->SetTotal_fee(round($val['total']));//标价金额
        $input->SetTime_start(date("YmdHis"));//交易起始时间
        $input->SetTime_expire(date("YmdHis", time() + 600));//交易结束时间
        $input->SetGoods_tag("test");//订单优惠标记
        $input->SetNotify_url($this->config['notify_url']);//通知地址
//        $input->SetNotify_url("http://www.sxgcsy.top/weixin/example/native_notify.php");//通知地址
        $input->SetTrade_type($this->config['trade_type']);//交易类型JSAPI 公众号支付  NATIVE 扫码支付  APP APP支付
        $input->SetProduct_id("123456789");//商品ID
        $result = $notify->GetPayUrl($input);
        var_dump($result);exit;
        $url2 = $result["code_url"];
//        $result = '<img alt="模式二扫码支付" src="http://paysdk.weixin.qq.com/example/qrcode.php?data='.urlencode($url2).'" style="width:150px;height:150px;"/>';
        $result = "http://paysdk.weixin.qq.com/example/qrcode.php?data=".urlencode($url2);
//        return $result;
        return $result;
    }


}

?>