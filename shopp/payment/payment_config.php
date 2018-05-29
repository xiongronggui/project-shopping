<?php
$sxgcsy_payment = [
	'mobile_payment' => [
		['id' => '智汇付', 'name' => '通道一']
	],
	'pc_payment' => [
		['id' => '智汇付', 'name' => '通道一'],
		['id' => '7080', 'name' => '通道二']
	]
]; 


$bank_list = [['id'=>'cmb','name'=>'招商银行'],
              ['id'=>'icbc','name'=>'中国工商银行'],['id'=>'abc','name'=>''],['id'=>'ccb','name'=>''],['id'=>'boc','name'=>''],['id'=>'spdb','name'=>''],['id'=>'bcom','name'=>''],['id'=>'cmbc','name'=>''],['id'=>'citic','name'=>''],['id'=>'hxb','name'=>''],['id'=>'cib','name'=>''],['id'=>'gzcb','name'=>''],['id'=>'bob','name'=>''],['id'=>'cbhb','name'=>''],['id'=>'njcb','name'=>''],['id'=>'ceb','name'=>''],['id'=>'hzb','name'=>''],['id'=>'pab','name'=>''],['id'=>'shb','name'=>''],['id'=>'psbc','name'=>'']];

$sxgcsy_payment_config = [
    '米提斯' => [
        'class_name' => 'metis',
        'config_name' => 'sxgcsy_mits_config',
        'type' => ''
    ],
    '智汇付' => [
        'class_name' => 'zhihf',
        'config_name' => 'sxgcsy_zhihf_config',
        'type' => ''
    ],
    '中付宝' => [
        'class_name' => 'zfb',
        'config_name' => 'zfb_config',
        'type' => ''
    ],
    '连连' => [
        'class_name' => 'llpc',
        'config_name' => 'llpc_config',
        'type' => 'bank'
    ],
    '豆豆' => [
        'class_name' => 'doudou',
        'config_name' => 'doudou_config',
        'type' => 'quick'
    ],
    '嘉联' => [
        'class_name' => 'jialian',
        'config_name' => 'jialian_config',
        'type' => 'bank'
    ],
    '嘉联快捷' => [
        'class_name' => 'jialian',
        'config_name' => 'jialian_config',
        'type' => 'bank'
    ],
    '腾付' => [
        'class_name' => 'bzf',
        'config_name' => 'bzf_config',
        'type' => 'sel_bank'
    ],
    '7080' => [
        'class_name' => 'qilinbailin',
        'config_name' => 'sxgcsy_qilinbailin_config',
        'type' => 'bank'
    ],
    '70809' => [
        'class_name' => 'qlbl',
        'config_name' => 'qlbl_config',
        'type' => ''
    ],
    '微信' => [
        'class_name' => 'weixin',
        'config_name' => 'weixin_config',
        'type' => ''
    ]
];

$weixin_config = array(
    'appid'=>'wx13ebb5aefbcec527',
    'mchid'=>'1501215081',
    'key'=>'Wyhiaikeidkn09254689745435342545',
    'appsecret'=>'e658eb635c9a271bae64447769098de8',
    'notify_url'=>'http://www.sxgcsy.top/shopp/common_receive.php?p_c=weixin',
    'trade_type'=>'NATIVE',//交易类型JSAPI 公众号支付  NATIVE 扫码支付  APP APP支付
);

$sxgcsy_qilinbailin_config = array(
        'merchno' => '333610189990001',
        'channel' => 1,
        'settleType' => 1,
        'notifyurl' => 'http://www.sxgcsy.top/shopp/common_receive.php?p_c=qilinbailin',
        'returnurl' => 'http://www.sxgcsy.top',
        'customerkey' => '3C25C905DA50D84A84A1725115777301',
        'signature' => '',
        'payurl' => 'http://api.zhruijie.net/gateway.do?m=order'
    );

	$qlbl_config = array(
    'su_url'=>'http://api.zhruijie.net/gateway.do?m=order',
    'no_url'=>'http://api.zhruijie.net/fastH5Pay',
    'merchno'=>'333610189990001',
    'channel'=>'2',
    'settleType'=>'2',
    'notifyUrl'=>'http://' . $_SERVER['HTTP_HOST'] . '/test/common_receive.php?p_c=qlbl',
    'returnUrl'=>'http://' . $_SERVER['HTTP_HOST'] . '/test/common_receive.php?p_c=qlbl',
    'key'=>'3C25C905DA50D84A84A1725115777301',
);
	
	
$jialian_config = array(
    'version' => '1.0',
    'customerid' => '11224',
    'customerkey' => 'bf79818423367343d26ad6eba63d3adad66c57bf',
    'paytype' => 'bank',
    'bankcode' => 'CCB',
    'notifyurl' => 'http://www.sxgcsy.top/shopp/common_receive.php?p_c=jialian',
    'returnurl' => 'http://www.sxgcsy.top',
    'remark' => ''
);

$doudou_config = array(
    'merchant_no' => '1180316041250713',
    'pid' => '10801511000000109610',
    'md5_key' => '9713a3158bad74de69f632f6c38c7bab',
    'secret' => '20f634d744ba3b947b83d36f77bac450',
    'ord_currency' => 'CNY',
    'merchant_notify_url' => 'http://www.sxgcsy.top/shopp/common_receive.php?p_c=doudou',
);

$bzf_config = array(
    'version' => '1.0',
    'customerid' => '77',
    'customerkey' => '05db51b3bbefb6c150632d555c242a43ef5b836d',
    'paytype' => 'bank',
    'bankcode' => 'CCB',
    'notifyurl' => 'http://www.sxgcsy.top/shopp/common_receive.php?p_c=bzf',
    'returnurl' => 'http://www.sxgcsy.top',
    'remark' => '',
	'payurl' => 'http://www.ymhjzx.com/apisubmit'
);

$kailiantong_config = array(
    "inputCharset" => "1",
    "pickupUrl" => "http://www.cuilvshop.com/shop/ucenter.php",
    "receiveUrl" => "http://www.cuilvshop.com/shop/receive.php",
    "version" => "v1.0",
    "language" => "1",
    "signType" => "0",
    "merchantId" => "105053170830001",
    "orderNo" => "",
    "orderAmount" => "",
    "orderCurrency" => "156",
    "orderDatetime" => "",
    "productName" => "",
    "payType" => "0",
    "key" => "XShk99998888",
);

$sxgcsy_mits_config = array(
    "orgId" => "00113589", //00113583
    "source" => "2",
    "currency" => "RMB",
    "account" => "15814728407", //13640939398
    "bankCode" => "CCB",
    "notifyUrl" => "http://www.sxgcsy.top/shopp/common_receive.php?p_c=metis",
    "callbackUrl" => "http://www.sxgcsy.top",
    "subject" => "",
    "orgOrderNo" => "",
    "amount" => "",
    "clientIp" => "127.0.0.1",
    "orderDate" => "",
    "signature" => ""
);

$sxgcsy_zhihf_config = array(
    'merchant_private_key'=>file_get_contents(PAYMENT_URL . 'zhihfpay/key/Z800168333013/privateKey.pem'),
    'merchant_public_key' => file_get_contents(PAYMENT_URL . 'zhihfpay/key/Z800168333013/publicKey.pem'),
    'zhihpay_public_key' =>file_get_contents(PAYMENT_URL . 'zhihfpay/key/Z800168333013/zhihf_publicKey.pem'),
    'merchant_code'=>'Z800168333013',
    'service_type'=>'direct_pay',
    'interface_version'=>'V3.0',
    'sign_type'=>'RSA-S',
    'input_charset'=>'UTF-8',
    'notify_url'=>'http://www.sxgcsy.top/shopp/common_receive.php?p_c=zhihf',
);

$zfb_config = array(
    'version' => '1.0',
    'customerid' => '11032',
    'customerkey' => '78e91a4c339d3442b30ccd0c1d1687eaad7046b4',
    'paytype' => 'bank',
    'bankcode' => 'CCB',
    'notifyurl' => 'http://www.sxgcsy.top/shopp/common_receive.php?p_c=zfb',
    'returnurl' => 'http://www.sxgcsy.top',
    'remark' => '',
    'get_code' => '0',
);


$ll_config = array(
    'version' => '1.1',
    'oid_partner' => '201408071000001539',//商户编号
    'sign_type' => strtoupper('RSA'),//签名方式
    'busi_partner' => '109001',//商户业务类型  虚拟商品销售：101001 实物商品销售：109001、
    'dt_order' => date('YmdHis'),//商户订单时间
    'user_id' => '22222222',//商户用户唯一编号
    'notify_url' => 'http://www.sxgcsy.top/shopp/common_receive.php?p_c=ll',//服务器异步通知地址
    'llpay_gateway_new' => 'https://wap.lianlianpay.com/payment.htm',//请求地址
    'app_request' => '1.1',//请求应用标识  1-Android 2-ios 3-WAP
    'sign' => '1.1',//签名
    'name_goods' => '羽毛球',//商品名称
    'RSA_PRIVATE_KEY' => file_get_contents(PAYMENT_URL . 'llpay/key/201710250001059760/llpay_private_key.pem'),
);

$llpc_config = array(
    'oid_partner' => '201710250001059760',

//秘钥格式注意不能修改（左对齐，右边有回车符）
    'RSA_PRIVATE_KEY' => file_get_contents(PAYMENT_URL . 'llpcpay/key/201710250001059760/llpay_private_key.pem'),

//安全检验码，以数字和字母组成的字符
    'key' => '201408071000001539_sahdisa_20141205',

//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑

//版本号
    'version' => '1.0',
    'notify_url' => 'http://www.sxgcsy.top/shopp/common_receive.php?p_c=llpc',
    'url_return' => 'http://www.lbjfsm.com',
    'busi_partner' => '109001',

//防钓鱼ip 可不传或者传下滑线格式
    'userreq_ip' => '10_10_246_110',

//证件类型
    'id_type' => '0',

//签名方式 不需修改
    'sign_type' => strtoupper('RSA'),

//订单有效时间  分钟为单位，默认为10080分钟（7天）
    'valid_order' => "10080",

//字符编码格式 目前支持 gbk 或 utf-8
    'input_charset' => strtolower('utf-8'),

//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
    'transport' => 'http',
    'llpay_gateway_new'=>'https://cashier.lianlianpay.com/payment/bankgateway.htm'
);
?>
