<?php


/* *
 * 类名：LLpayNotify
 * 功能：连连支付通知处理类
 * 详细：处理连连支付各接口通知返回
 * 版本：1.1
 * 日期：2014-04-16
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。

 *************************注意*************************
 * 调试通知返回时，可查看或改写log日志的写入TXT里的数据，来检查通知返回是否正常
 */

class weixin_notify
{
    public $param, $order, $pay_time, $llpay_config;
    public $payment;

    function __construct($llpay_config)
    {
        $this->llpay_config = $llpay_config;
        $data = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");
        $data = xmlToArray($data);
        logInfo('ll->内部参数获取' . json_encode($data));
        $this->param = $data;
        $this->order = $data['out_trade_no'];
        include_once('weixinpay.php');
    }


    public function submit()
    {

        $sign = $this->param['sign'];
        if (!$sign) {
			logInfo('ll->验签失败');
            exit('error1');
        }

        if ($this->param['return_code'] != "SUCCESS") {
			logInfo('ll->支付失败');
            exit('error2');
        }


        return true;
    }



}

?>
