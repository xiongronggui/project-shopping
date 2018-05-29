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

class yy_notify
{
    public $param, $order, $pay_xml, $llpay_config;
    public $payment;

    function __construct($llpay_config)
    {
        $this->llpay_config = $llpay_config;
//        $data = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");
        //$data = '{"bank_code":"01020000","dt_order":"20180321204108","money_order":"0.1","no_order":"20180321204108842917","oid_partner":"201710250001059760","oid_paybill":"2018032163459808","pay_type":"2","result_pay":"SUCCESS","settle_date":"20180321","sign":"UUg8P840QoNfu3RIYqQnoULlfWTlv8DGujwe7gtWmefmRKxeR2+pyF2CfcMM7cW+9HKOQxTxCfL8oRgLarsemVXNhRlYQxNwmWGwXmoPCiPr8Ssj+xJVA4AvmioiiVevpqPXa13JUmGMb2SBxumijcptoYtoEzyL9XmvZcdsaAI=","sign_type":"RSA"}';
//        $data = json_decode($data, true);
        //!empty($data) ?: ($data = $_POST);
        $data = $_POST;
        logInfo('ll->内部参数获取' . json_encode($data));
//        $data = '{"tranData":"PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iR0JLIiA\/PjxCMkNSZXM+PG1lcmNoYW50SWQ+TTEwMDAwMTY4MDwvbWVyY2hhbnRJZD48b3JkZXJObz44MDExODAzMjgxNjEzMTc2NzY8L29yZGVyTm8+PHRyYW5TZXJpYWxObz5aRjIwMTgwMzI4MTAwMzAwOTQzNjwvdHJhblNlcmlhbE5vPjxvcmRlckFtdD4xLjAwPC9vcmRlckFtdD48Y3VyVHlwZT5DTlk8L2N1clR5cGU+PHRyYW5UaW1lPjIwMTgwMzI4MTYxODQyPC90cmFuVGltZT48dHJhblN0YXQ+MTwvdHJhblN0YXQ+PHJlbWFyaz42MDAwMTQzOTMwMDAyMDwvcmVtYXJrPjxzdWJtZXJubz48L3N1Ym1lcm5vPjwvQjJDUmVzPg==","signData":"a2Jyb9TMFMgNcHgwZyXqCs4QJbfI0cL4aqqxeoWG0W++jCBl5wHaMFU8OAL88xtLAaM6qxUDuFsBSZSTYp7MIzW8ofDWcW26gsjz12JzzusOho18rHeYRJKCbDicrQlx5NPn4YFOE\/JEol7suL7A3WjQJ8FWouVaKlOVoaa2aRcVoiZOQ5Zv304Y3m0ecrv7AcBiSpf1grvPt1xE\/TQglhuEH+RhROZ1bO4fF8tAXhzkb5WDCoQdo+H35semCwuLTjOouk2FYzHCJyEtsfbl66GSlLPMdyMlAI2lO7VMqYF5nk6edMq32Zm5n5Q+zu+N6AS0ZcmCzqqOtRmofziOLg==","interfaceName":"PayOrderNotify","version":"B2C1.0"}';
//        $data = json_decode($data,true);
        $this->param = $data;
        include_once('yypay.php');
        $this->payment = new yypay_payment($this->llpay_config);
        $xml = $this->payment->verify_notify($this->param);
        $this->pay_xml = $xml;
        $this->order = $xml['orderNo'];
    }


    public function submit()
    {


        if ($this->pay_xml['tranStat'] != 1) {
			logInfo('yy->支付失败');
            exit('甬易：error2');
        }


        return true;

    }



}

?>
