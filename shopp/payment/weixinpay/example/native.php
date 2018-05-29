<?php
ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);

require_once PAYMENT_URL."weixinpay/lib/WxPay.Api.php";
require_once PAYMENT_URL."weixinpay/example/WxPay.NativePay.php";
require_once PAYMENT_URL."weixinpay/example/log.php";

//模式一
/**
 * 流程：
 * 1、组装包含支付信息的url，生成二维码
 * 2、用户扫描二维码，进行支付
 * 3、确定支付之后，微信服务器会回调预先配置的回调地址，在【微信开放平台-微信支付-支付配置】中进行配置
 * 4、在接到回调通知之后，用户进行统一下单支付，并返回支付信息以完成支付（见：native_notify.php）
 * 5、支付完成之后，微信服务器会通知支付成功
 * 6、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
 */
//$notify = new NativePay();
//$url1 = $notify->GetPrePayUrl("123456789");
//echo $url1;exit;
//var_dump($url1);exit;

//模式二
/**
 * 流程：
 * 1、调用统一下单，取得code_url，生成二维码
 * 2、用户扫描二维码，进行支付
 * 3、支付完成之后，微信服务器会通知支付成功
 * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
 */
//$input = new WxPayUnifiedOrder();
//$input->SetBody("test");//商品描述
//$input->SetAttach("test");//附加数据
//$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));//商户订单号
//$input->SetTotal_fee("1");//标价金额
//$input->SetTime_start(date("YmdHis"));//交易起始时间
//$input->SetTime_expire(date("YmdHis", time() + 600));//交易结束时间
//$input->SetGoods_tag("test");//订单优惠标记
////$input->SetNotify_url("http://www.sxgcsy.top/test/common_receive.php");//通知地址
//$input->SetNotify_url("http://www.sxgcsy.top/weixin/example/native_notify.php");//通知地址
//$input->SetTrade_type("NATIVE");//交易类型JSAPI 公众号支付  NATIVE 扫码支付  APP APP支付
//$input->SetProduct_id("123456789");//商品ID
////echo '<pre>';
//
//$result = $notify->GetPayUrl($input);
//tbug($result,false);
//$url2 = $result["code_url"];
//var_export($url2);exit;
?>
