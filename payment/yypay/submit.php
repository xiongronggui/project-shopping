<?php

class yypay_submit
{
    public $param, $config;

    public function __construct($param, $config)
    {
        $this->config = $config;
        $this->param = $param;
        include_once('yypay.php');
    }





    public function submit()
    {
//        $responseText = $this->channel();
//        tbug($responseText);
//        tbug(PAYMENT_URL.'yypay\key\201710250001059760\yoyiTestNew.pfx');

        $pay = new yypay_payment($this->config);
        $orderNo = $this->param['order_id'];
        $orderAmt = 1;
//        $orderAmt = $this->param['total'];
        $bankId = '888C';//获取付款银行获取的
        $cardType = 'X';//获取付款银行获取的
        $goodsName = 'iphone X';//商品名称
        $remark = '60001439300020';//备注
        $userId = 'shopUserId123456';//用户id
        $isBind = $this->config['isBind'];
        /**
         * 有扫码二级商户号时才必输
        扫码支付商户入驻成功后，上送商户方可从此处传入。
        如系统检测不到传入二级商户号，自动选择当前商户号，进行支付。
         */
        $MSMerchantIdB = '';
        $returnFlag = $this->config['returnFlag'];
        $random = '123456';

        $xml = '<orderNo>'.$orderNo.'</orderNo>';
        $xml .= '<orderAmt>'.$orderAmt.'</orderAmt>';
        $xml .='<bankId>'.$bankId.'</bankId>';
        $xml .='<cardType>'.$cardType.'</cardType>';
        $xml .='<goodsName>'.$goodsName.'</goodsName>';
        $xml .='<remark>'.$remark.'</remark>';
        $xml .='<userId>'.$userId.'</userId>';
        $xml .='<isBind>'.$isBind.'</isBind>';
        $xml .='<MSMerchantIdB>'.$MSMerchantIdB.'</MSMerchantIdB>';
        $xml .='<returnFlag>'.$returnFlag.'</returnFlag>';
        $xml .='<random>'.$random.'</random>';


        $transactionData = $xml; 	 //订单信息（订单号，金额，备注）
        //创建支付请求

        ////////////////////////////////////////////////////////////
        ///////支付请求表单域以接口文档为准//////////////
        ////////////////////////////////////////////////////////////
        $keyValue = $this->config['keyValue'];//商家MD5密钥
        $nodeAuthorizationURL = $this->config['payReqURL'];   //交易请求地址
        $merId = $this->config['merId'];//商户编号
        $merURL = $this->config['merURL'];	//商户接收支付成功页面跳转的地址
        $serverNotifyURL =$this->config['serverNotifyURL'];   //商户接收支付成功后台通知
        $interfaceName = $this->config['submit_interface'];
        $curType = 'CNY';
        $version='B2C1.0';

        $xmlData="<?xml version=\"1.0\" encoding=\"GBK\"?><B2CReq><merchantId>".$merId."</merchantId><curType>".$curType."</curType><returnURL>".$merURL."</returnURL><notifyURL>".$serverNotifyURL."</notifyURL>".$transactionData."</B2CReq>";//支付通道编码

        // 获得MD5-HMAC签名(特殊商户用)
        $signMsg = $pay->HmacMd5($xmlData,$keyValue);
        // 获得证书签名(新商户都用此方法)
        $signMsg = $pay->certSign($xmlData);
        // tranData做base64编码
        $tranData =  base64_encode($xmlData);

        echo "<form id='llpaysubmit' name='llpaysubmit' action='".$nodeAuthorizationURL."' method='POST' target='_blank'>
				<input type='hidden' name='interfaceName'   value='".$interfaceName."'>
				<input type='hidden' name='tranData'        value='".$tranData."'>
				<input type='hidden' name='version'         value='".$version."'>
				<input type='hidden' name='merSignMsg'      value='".$signMsg."'>
				<input type='hidden' name='merchantId'      value='".$merId."'>
				<input type='submit' value='提交支付信息'/>
				<script>document.forms['llpaysubmit'].submit();</script>;
			</form>";


    }

    //获取付款银行
    public function channel()
    {
        $pay = new yypay_payment($this->config);
        // 创建获取付款银行的请求

        // //////////////////////////////////////////////////////////
        // /////获取付款银行请求表单域以接口文档为准//////////////
        // //////////////////////////////////////////////////////////
        $keyValue = $this->config['keyValue']; // 商家密钥
        $getBankURL = $this->config['getBankURL']; // 获取付款银行请求地址
        $merId = $this->config['merId']; // 商户编号
        $interfaceName = $this->config['channel_interface'];
        $version = $this->config['version'];

        $xmlData = "<?xml version=\"1.0\" encoding=\"GBK\"?><B2CReq><remark>mark</remark></B2CReq>"; // 获取付款银行的xml

        // 获得MD5-HMAC签名(特殊商户用)
        $signMsg = $pay->HmacMd5($xmlData, $keyValue);
        // 获得证书签名(新商户都用此方法)
        $signMsg = $pay->certSign($xmlData);
        // tranData做base64编码
        $tranData = base64_encode($xmlData);
        // 组成post数据，需要对其中有符号的数据参数做转换
        $para = 'interfaceName=' . $interfaceName . '&version=' . urlencode($version) . '&tranData=' . urlencode($tranData) . '&merSignMsg=' . urlencode($signMsg) . '&merchantId=' . $merId;

        $curl = curl_init($getBankURL); // curl初始化
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // SSL证书认证
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 非严格认证
        // curl_setopt($curl, CURLOPT_CAINFO,$cacert_url);//证书地址
        curl_setopt($curl, CURLOPT_PORT, 28080); // 设置端口，视测试环境配置。上生产环境时注释掉
        curl_setopt($curl, CURLOPT_HEADER, 0); // 过滤HTTP头
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 显示输出结果
        curl_setopt($curl, CURLOPT_POST, true); // post传输数据
        curl_setopt($curl, CURLOPT_POSTFIELDS, $para); // post传输数据
        $responseText = curl_exec($curl);
// var_dump( curl_error($curl) );//如果执行curl过程中出现异常，可打开此开关，以便查看异常内容
        curl_close($curl);

// 对返回的数据做base64的解码
        $sourceData = base64_decode($responseText);
// 对返回的XML数据进行解析
        $retXml = simplexml_load_string($sourceData);
// 下面部分是示例显示用，商户应根据自身实际对解析出来的银行数据做相应的处理
        $bank = mb_convert_encoding(base64_decode($responseText),"UTF-8","GBK");
        $bank = ltrim (strstr( $bank, '?>'),'?>');
        $bank = simplexml_load_string($bank);
        $bank = json_encode($bank);
        $bank = json_decode($bank,true);
        return $bank;
    }


}

?>
