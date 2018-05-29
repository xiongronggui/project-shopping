<?php
/*国灿配置*/
$sxgcsy_payment = [
    'mobile_payment' => [
        ['id' => '智汇付', 'name' => '通道一']
    ],
    'pc_payment' => [
        ['id' => '智汇付', 'name' => '通道一'],
        ['id' => '柒零捌零', 'name' => '通道二']
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
        'type' => 'bank'
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
    '柒零捌零' => [
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
    ],
    '支付宝' => [
        'class_name' => 'alipay',
        'config_name' => 'sxgcsy_alipay_config',
        'type' => ''
    ]
];

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

$sxgcsy_alipay_config  = array (  
    //应用ID,您的APPID。
    'app_id' => "2018040502507735",
    'payurl' => 'http://www.sxgcsy.top/alipay/pagepay/pagepay.php',
);

/*国灿配置end*/

/*海明宫商贸配置*/
$hmgsm_payment = [
    'mobile_payment' => [
        ['id' => '支付宝', 'name' => '通道一']
    ],
    'pc_payment' => [
        ['id' => '支付宝', 'name' => '通道一']
    ]
];

$hmgsm_payment_config = [
    '支付宝' => [
        'class_name' => 'alipay',
        'config_name' => 'hmgsm_alipay_config',
        'type' => ''
    ],
    '微信支付' => [
        'class_name' => 'weixin',
        'config_name' => 'hmgsm_weixin_config',
        'type' => ''
    ]
];

$hmgsm_alipay_config  = array (  
    //应用ID,您的APPID。
    'app_id' => "2018040202488423",
    'payurl' => 'http://www.hmgsm.top/alipay/pagepay/pagepay.php',
);

$hmgsm_weixin_config = array(
    'appid'=>'wx5e269b7f7f785608',
    'mchid'=>'1501249721',
    'key'=> 'e658eb635c9a271bae64447769098de8',//'Wyhiaikeidkn09254689745435342545',
    'appsecret'=>'d65a527fd506f95c6de544466f5728e4',
    'notify_url'=>'http://www.hmgsm.top/shopp/common_receive.php?p_c=weixin',
    'trade_type'=>'NATIVE',//交易类型JSAPI 公众号支付  NATIVE 扫码支付  APP APP支付
);
/*海明宫商贸配置end*/

/*兴卓商贸配置*/
$xaxzsm_payment = [
    'mobile_payment' => [
        ['id' => '支付宝', 'name' => '通道一']
    ],
    'pc_payment' => [
        ['id' => '支付宝', 'name' => '通道一']
    ]
];

$xaxzsm_payment_config = [
    '支付宝' => [
        'class_name' => 'alipay',
        'config_name' => 'xsxzsm_alipay_config',
        'type' => ''
    ]
];

$xsxzsm_alipay_config  = array (  
    //应用ID,您的APPID。
    'app_id' => "2018033102481267",
    'payurl' => 'http://www.xsxzsm.top/alipay/pagepay/pagepay.php',
);

/*兴卓商贸配置end*/

/*怀琨商贸*/
$dueseeff_payment = [
    'mobile_payment' => [
        ['id' => '转账/汇款', 'name' => '人工支付']
    ],
    'pc_payment' => [
        ['id' => '转账/汇款', 'name' => '人工支付']
    ]
];

$dueseeff_payment_config = [
    '转账/汇款' => [
        'class_name' => 'people',
        'config_name' => 'dueseeff_people_config',
        'type' => ''
    ]
];

$dueseeff_alipay_config  = array (  
    //应用ID,您的APPID。
    'app_id' => "2018033102481267",
    'payurl' => 'http://www.dueseeff.top/alipay/pagepay/pagepay.php',
);
/*怀琨商贸end*/

/*西安愜瑞商贸有限公司*/
$xaqrsm_payment = [
    'mobile_payment' => [
        ['id' => '支付宝', 'name' => '通道一']
    ],
    'pc_payment' => [
        ['id' => '支付宝', 'name' => '通道一']
    ]
];

$xaqrsm_payment_config = [
    '支付宝' => [
        'class_name' => 'alipay',
        'config_name' => 'xaqrsm_alipay_config',
        'type' => ''
    ]
];

$xaqrsm_alipay_config  = array (  
    //应用ID,您的APPID。
    'app_id' => "2018040502507675",
    'payurl' => 'http://www.xaqrsm.top/alipay/pagepay/pagepay.php',
);
/*西安愜瑞商贸有限公司end*/

/*西安德廷商贸公司*/
$xadysm_payment = [
    'mobile_payment' => [
        ['id' => '支付宝', 'name' => '通道一']
    ],
    'pc_payment' => [
        ['id' => '支付宝', 'name' => '通道一']
    ]
];

$xadysm_payment_config = [
    '支付宝' => [
        'class_name' => 'alipay',
        'config_name' => 'xadysm_alipay_config',
        'type' => ''
    ]
];

$xadysm_alipay_config  = array (  
    //应用ID,您的APPID。
    'app_id' => "2018040502507818",
    'payurl' => 'http://www.xadysm.top/alipay/pagepay/pagepay.php',
);
/*西安德廷商贸公司end*/

/*北京电吧电力工程有限公司*/
$bjdbdl_payment = [
    'mobile_payment' => [
        ['id' => '支付宝', 'name' => '通道一']
    ],
    'pc_payment' => [
        ['id' => '支付宝', 'name' => '通道一']
    ]
];

$bjdbdl_payment_config = [
    '支付宝' => [
        'class_name' => 'alipay',
        'config_name' => 'bjdbdl_alipay_config',
        'type' => ''
    ]
];

$bjdbdl_alipay_config  = array (  
    //应用ID,您的APPID。
    'app_id' => "2018040502507289",
    'payurl' => 'http://www.bjdbdl.top/alipay/pagepay/pagepay.php',
);
/*北京电吧电力工程有限公司end*/

/*西安萨日工贸有限公司*/
$xasrgm_payment = [
    'mobile_payment' => [
        ['id' => '支付宝', 'name' => '通道一']
    ],
    'pc_payment' => [
        ['id' => '支付宝', 'name' => '通道一']
    ]
];

$xasrgm_payment_config = [
    '支付宝' => [
        'class_name' => 'alipay',
        'config_name' => 'xasrgm_alipay_config',
        'type' => ''
    ]
];

$xasrgm_alipay_config  = array (  
    //应用ID,您的APPID。
    'app_id' => "2018040502507301",
    'payurl' => 'http://www.xasrgm.top/alipay/pagepay/pagepay.php',
);
/*西安萨日工贸有限公司end*/

/*煜凯网络*/
$smfe9sn_payment = [
    'mobile_payment' => [
        ['id' => '微信支付', 'name' => '通道一']
    ],
    'pc_payment' => [
        ['id' => '微信支付', 'name' => '通道一']
    ]
];

$smfe9sn_payment_config = [
    '支付宝' => [
        'class_name' => 'alipay',
        'config_name' => 'smfe9sn_alipay_config',
        'type' => ''
    ],
    '微信支付' => [
        'class_name' => 'weixin',
        'config_name' => 'smfe9sn_weixin_config',
        'type' => ''
    ]
];

$smfe9sn_alipay_config  = array (  
    //应用ID,您的APPID。
    'app_id' => "2018040202488324",
    'payurl' => 'http://www.smfe9sn.top/alipay/pagepay/pagepay.php',
);

$smfe9sn_weixin_config = array(
    'appid'=>'wx709c42c7e61170da',
    'mchid'=>'1501400721',
    'key'=> 'Wefyuihfsdaughfkhjkhuksd48921734',
    'appsecret'=>'370fca88be46a5aaca009274297756f8',
    'notify_url'=>'http://www.smfe9sn.top/shopp/common_receive.php?p_c=weixin',
    'trade_type'=>'NATIVE',//交易类型JSAPI 公众号支付  NATIVE 扫码支付  APP APP支付
);
/*煜凯网络end*/

/*陕西富泰达实业有限公司*/
$ftdsy_payment = [
    'mobile_payment' => [
        ['id' => '支付宝', 'name' => '通道一']
    ],
    'pc_payment' => [
        ['id' => '支付宝', 'name' => '通道一'],
        ['id' => '微信支付', 'name' => '通道二'],
        ['id' => '子账户', 'name' => '通道三']
    ]
];

$ftdsy_payment_config = [
    '支付宝' => [
        'class_name' => 'alipay',
        'config_name' => 'ftdsy_alipay_config',
        'type' => ''
    ],
    '子账户' => [
        'class_name' => 'alipay',
        'config_name' => 'ftdsy_alipay1_config',
        'type' => ''
    ],
    '微信支付' => [
        'class_name' => 'weixin',
        'config_name' => 'ftdsy_weixin_config',
        'type' => ''
    ]
];

$ftdsy_alipay_config  = array (  
    //应用ID,您的APPID。
    'app_id' => "2018040202488324",
    'payurl' => 'http://www.ftdsy.top/alipay/pagepay/pagepay.php',
);

$ftdsy_alipay1_config  = array (  
    //应用ID,您的APPID。
    'app_id' => "2018041402557746",
    'payurl' => 'http://www.ftdsy.top/alipay/pagepay/pagepay.php',
);

$ftdsy_weixin_config = array(
    'appid'=>'wx1649b93d1a358822',
    'mchid'=>'1501334111',
    'key'=> 'e658eb635c9a271bae64447769098de8',//'Wyhiaikeidkn09254689745435342545',
    'appsecret'=>'1e30cb453e4d55d46e1df60aa506e797',
    'notify_url'=>'http://www.ftdsy.top/shopp/common_receive.php?p_c=weixin',
    'trade_type'=>'NATIVE',//交易类型JSAPI 公众号支付  NATIVE 扫码支付  APP APP支付
);
/*陕西富泰达实业有限公司end*/

/*西安鑫霏商贸有限公司*/
$xaxfl_payment = [
    'mobile_payment' => [
        ['id' => '支付宝', 'name' => '通道一']
    ],
    'pc_payment' => [
        ['id' => '支付宝', 'name' => '通道一'],
        ['id' => '微信支付', 'name' => '通道二'],
        ['id' => '子账户', 'name' => '通道三']
    ]
];

$xaxfl_payment_config = [
    '支付宝' => [
        'class_name' => 'alipay',
        'config_name' => 'xaxfl_alipay_config',
        'type' => ''
    ],
    '子账户' => [
        'class_name' => 'alipay',
        'config_name' => 'xaxfl_alipay1_config',
        'type' => ''
    ],
    '微信支付' => [
        'class_name' => 'weixin',
        'config_name' => 'xaxfl_weixin_config',
        'type' => ''
    ]
];
$xaxfl_alipay1_config  = array (  
    //应用ID,您的APPID。
    'app_id' => "2018041602569019",
    'payurl' => 'http://www.xaxfl.top/alipay/pagepay/pagepay.php',
);
/*西安鑫霏商贸有限公司end*/

/*故城县扬铃商贸有限公司*/
$ladao_payment = [
    'mobile_payment' => [
        ['id' => '支付宝', 'name' => '通道一']
    ],
    'pc_payment' => [
        ['id' => '支付宝', 'name' => '通道一'],
        ['id' => '微信支付', 'name' => '通道二'],
        ['id' => '子账户', 'name' => '通道三']
    ]
];

$ladao_payment_config = [
    '支付宝' => [
        'class_name' => 'alipay',
        'config_name' => 'ladao_alipay_config',
        'type' => ''
    ],
    '子账户' => [
        'class_name' => 'alipay',
        'config_name' => 'ladao_alipay_config',
        'type' => ''
    ],
    '微信支付' => [
        'class_name' => 'weixin',
        'config_name' => 'ladao_weixin_config',
        'type' => ''
    ]
];
$ladao_alipay_config  = array (  
    //应用ID,您的APPID。
    'app_id' => "2018041502561538",
    'payurl' => 'http://www.ladao.top/alipay/pagepay/pagepay.php',
);
/*故城县扬铃商贸有限公司end*/

/*陕西迈远电子科技有限公司*/
$mydzkj_payment = [
    'mobile_payment' => [
        ['id' => '支付宝', 'name' => '通道一']
    ],
    'pc_payment' => [
        ['id' => '支付宝', 'name' => '通道一'],
        ['id' => '微信支付', 'name' => '通道二'],
        ['id' => '子账户', 'name' => '通道三']
    ]
];

$mydzkj_payment_config = [
    '支付宝' => [
        'class_name' => 'alipay',
        'config_name' => 'mydzkj_alipay_config',
        'type' => ''
    ],
    '子账户' => [
        'class_name' => 'alipay',
        'config_name' => 'mydzkj_alipay_config',
        'type' => ''
    ],
    '微信支付' => [
        'class_name' => 'weixin',
        'config_name' => 'mydzkj_weixin_config',
        'type' => ''
    ]
];
$mydzkj_alipay_config  = array (  
    //应用ID,您的APPID。
    'app_id' => "2018041502561538",
    'payurl' => 'http://www.mydzkj.top/alipay/pagepay/pagepay.php',
);
/*陕西迈远电子科技有限公司end*/

$klt_payment = [
    'mobile_payment' => [
        ['id' => '微信', 'name' => '通道一']
    ],
    'pc_payment' => [
        ['id' => '微信', 'name' => '微信'],
        ['id' => '豆豆', 'name' => '豆豆']
    ]
];

$klt_payment_config = [
    '支付宝' => [
        'class_name' => 'alipay',
        'config_name' => 'ftdsy_alipay_config',
        'type' => ''
    ],
    '微信' => [
        'class_name' => 'weixin',
        'config_name' => 'ftdsy_weixin_config',
        'type' => ''
    ],
    '豆豆' => [
        'class_name' => 'doudou',
        'config_name' => 'doudou_config',
        'type' => 'sel_bank'
    ]
];

/*$klt_weixin_config = array(
    'appid'=>'wx1649b93d1a358822',
    'mchid'=>'1501334111',
    'key'=> 'e658eb635c9a271bae64447769098de8',
    'appsecret'=>'1e30cb453e4d55d46e1df60aa506e797',
    'notify_url'=>'http://www.ftdsy.top/shopp/common_receive.php?p_c=weixin',
    'trade_type'=>'NATIVE',
);*/

/*$klt_weixin_config = array(
    'appid'=>'wx790c4daf361633ca',
    'mchid'=>'1502608681',
    'key'=> '3yx3i8T59qc4Vk360S7z2u2c8l93Q3xd',
    'appsecret'=>'7dc6edb5082558a837b8ef7590807425',
    'notify_url'=>'http://www.ftdsy.top/shopp/common_receive.php?p_c=weixin',
    'trade_type'=>'NATIVE',
);*/


    
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
    'cerchant_return_url' => 'http://www.xmggwhcb.top/'
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
