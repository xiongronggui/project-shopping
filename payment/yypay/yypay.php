<?php


class yypay_payment
{

    public $config;

    function __construct($config)
    {
        $this->config = $config;
    }



    /**
     * 说明：2017年5月前的原有商户、特殊商户，仍沿用MD5算法。
     * 注：先前对接成功的普通商户，2017年5月以后改造、扩展新接口的，也应升级成证书验签！
     */
    function HmacMd5($data,$key)
    {
        // RFC 2104 HMAC implementation for php.
        // Creates an md5 HMAC.
        // Eliminates the need to install mhash to compute a HMAC
        // written by shihh

        //需要配置环境支持iconv，否则中文参数不能正常处理
        $key = iconv("GB2312","UTF-8",$key);
        $data = iconv("GB2312","UTF-8",$data);

        $b = 64; // byte length for md5
        if (strlen($key) > $b) {
            $key = pack("H*",md5($key));
        }
        $key = str_pad($key, $b, chr(0x00));
        $ipad = str_pad('', $b, chr(0x36));
        $opad = str_pad('', $b, chr(0x5c));
        $k_ipad = $key ^ $ipad;
        $k_opad = $key ^ $opad;

        return md5($k_opad . pack("H*",md5($k_ipad . $data)));
    }


    /**
     * 证书验签：如非特殊商户，自2017年5月1日起，都用CERT证书方式验签！
     * 签名  生成签名串  基于sha1withRSA
     * @param string $data 签名前的字符串
     * @return string 签名串
     */
    function certSign($data) {
        $certs = array();
        openssl_pkcs12_read($this->config['pfxPath'], $certs, $this->config['pfxPwd']);
        //其中password为你的证书密码
        if(!$certs) return ;
        $signature = '';
        openssl_sign($data, $signature, $certs['pkey']);
        return base64_encode($signature);
    }

    public function verify_notify($val)
    {

        $interfaceName = $val['interfaceName'];
        $version = $val['version'];
        $tranData = $val['tranData'];	// 通知结果数据
        $signMsg = $val['signData'];	// 甬易对通知结果的签名数据

        $configFile="merchantInfo.ini";	// 配置文件
        $keyValue = $this->config['keyValue'];// 商家密钥

        ////////////////////////////////////////////////////////////
        ///////////////表单域以接口文档为准//////////////////
        ////////////////////////////////////////////////////////////

        //对返回的tranData做base64的解码
        // $tranDataDecode = mb_convert_encoding(base64_decode($tranData),"UTF-8","GBK");
        $tranDataDecode = base64_decode($tranData);

        //==========MD5验签，仅限特殊商户和2017年5月前老商户使用===================
        // 获得MD5-HMAC签名
        // $signResult = HmacMd5($tranDataDecode,$keyValue);

        // // 对返回的数据也进行验签
        // if ($signResult == $signMsg) {
        // 	//MD5验签通过
        // 	//对返回的XML数据进行解析
        // 	$retXml = simplexml_load_string($tranDataDecode);
        // 	// 下面部分商户应根据自身实际对解析出来的数据做订单成功失败等操作
        //     echo "succsee";
        // } else {
        //     //MD5验签失败
        //     echo "fail";
        // }

        //===========2017年5月以后的新商户，都用证书验签===========================

        // 对返回的数据也进行验签
        $signResult = $this->verifyData($tranData, $signMsg);
        if ($signResult==1) {
            //证书验签通过
            //对返回的XML数据进行解析
            $retXml = simplexml_load_string($tranDataDecode);
            $retXml = json_decode(json_encode($retXml),true);
            // 下面部分商户应根据自身实际对解析出来的数据做订单成功失败等操作
//            echo "success";
            return $retXml;
        }else {
            //证书验签失败
//            echo "fail";
            logInfo('yy->验签失败');
            return false;
        }
    }

    /**
     * 验签  验证签名  基于sha1withRSA
     * @param $tranData 交易数据（base64密文）
     * @param $signature 签名串
     * @return 验签成功返回1，失败0，错误返回-1
     */
    function verifyData($tranData, $signature) {
        return $this->verify($tranData, $signature, $this->config['cerPath']);
    }


    /**
     * 验签  验证签名  基于sha1withRSA
     * @param $tranData 交易数据（base64密文）
     * @param $signature 签名串
     * @param $cerFilePath 公钥cer
     * @return 验签成功返回1，失败0，错误返回-1
     */
    function verify($tranData, $signature, $cerFilePath) {
        $signature_str = base64_decode($signature);
        $sourceData = base64_decode($tranData);
//        $public_key = file_get_contents($cerFilePath);

        $result = openssl_verify($sourceData, $signature_str, $cerFilePath);
        // openssl_verify验签成功返回1，失败0，错误返回-1
        return $result;
    }


}

?>