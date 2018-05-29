<?php
/***********************************************************
 * Note    : 中付宝付款操作
 * Version : 1.0
 * Author  : fangyi
 * Update  : 2018-03-02
 ***********************************************************/

//require_once '/include/common.php';

class llpcpay_payment
{

    public $config;

    function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * 签名字符串
     * @param $prestr 需要签名的字符串
     * @param $key 私钥
     * return 签名结果
     */
    function md5Sign($prestr, $key)
    {
        $logstr = $prestr . "&key=************************";
        $prestr = $prestr . "&key=" . $key;
        //file_put_contents("log.txt","签名原串:".$logstr."\n", FILE_APPEND);
        return md5($prestr);
    }

    /**
     * 验证签名
     * @param $prestr 需要签名的字符串
     * @param $sign 签名结果
     * @param $key 私钥
     * return 签名结果
     */
    function md5Verify($prestr, $sign, $key)
    {
        $logstr = $prestr . "&key=************************";
        $prestr = $prestr . "&key=" . $key;
        //file_put_contents("log.txt","prestr:".$logstr."\n", FILE_APPEND);
        $mysgin = md5($prestr);
        //file_put_contents("log.txt","1:".$mysgin."\n", FILE_APPEND);
        if ($mysgin == $sign) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 建立请求，以表单HTML形式构造（默认）
     * @param $para_temp 请求参数数组
     * @param $method 提交方式。两个值可选：post、get
     * @param $button_name 确认按钮显示文字
     * @return 提交表单HTML文本
     */
    function buildRequestForm($para_temp, $method, $button_name) {

        //待请求参数数组
        $para = $this->buildRequestPara($para_temp);
		//tbug($para);

        //风控值去斜杠
        $para['risk_item'] =stripslashes( $para['risk_item']);
        $sHtml = "<form id='llpaysubmit' name='llpaysubmit' action='" . $this->config['llpay_gateway_new'] . "' method='" . $method . "'>";
        $sHtml .= "<input type='hidden' name='version' value='" . $para['version'] . "'/>";
        $sHtml .= "<input type='hidden' name='oid_partner' value='" . $para['oid_partner'] . "'/>";
        $sHtml .= "<input type='hidden' name='user_id' value='" . $para['user_id'] . "'/>";
        $sHtml .= "<input type='hidden' name='timestamp' value='" . $para['timestamp'] . "'/>";
        $sHtml .= "<input type='hidden' name='sign_type' value='" . $para['sign_type'] . "'/>";
        $sHtml .= "<input type='hidden' name='sign' value='" . $para['sign'] . "'/>";
        $sHtml .= "<input type='hidden' name='busi_partner' value='" . $para['busi_partner'] . "'/>";
        $sHtml .= "<input type='hidden' name='no_order' value='" . $para['no_order'] . "'/>";
        $sHtml .= "<input type='hidden' name='dt_order' value='" . $para['dt_order'] . "'/>";
        $sHtml .= "<input type='hidden' name='name_goods' value='" . $para['name_goods'] . "'/>";
        $sHtml .= "<input type='hidden' name='info_order' value='" . $para['info_order'] . "'/>";
        $sHtml .= "<input type='hidden' name='money_order' value='" . $para['money_order'] . "'/>";
        $sHtml .= "<input type='hidden' name='notify_url' value='" . $para['notify_url'] . "'/>";
        $sHtml .= "<input type='hidden' name='url_return' value='" . $para['url_return'] . "'/>";
        $sHtml .= "<input type='hidden' name='userreq_ip' value='" . $para['userreq_ip'] . "'/>";
        $sHtml .= "<input type='hidden' name='url_order' value='" . $para['url_order'] . "'/>";
        $sHtml .= "<input type='hidden' name='valid_order' value='" . $para['valid_order'] . "'/>";
        $sHtml .= "<input type='hidden' name='bank_code' value='" . $para['bank_code'] . "'/>";
        $sHtml .= "<input type='hidden' name='pay_type' value='" . $para['pay_type'] . "'/>";
        $sHtml .= "<input type='hidden' name='no_agree' value='" . $para['no_agree'] . "'/>";
        $sHtml .= "<input type='hidden' name='shareing_data' value='" . $para['shareing_data'] . "'/>";
        $sHtml .= "<input type='hidden' name='risk_item' value='" . $para['risk_item'] . "'/>";
        $sHtml .= "<input type='hidden' name='id_type' value='" . $para['id_type'] . "'/>";
        $sHtml .= "<input type='hidden' name='id_no' value='" . $para['id_no'] . "'/>";
        $sHtml .= "<input type='hidden' name='acct_name' value='" . $para['acct_name'] . "'/>";
        $sHtml .= "<input type='hidden' name='flag_modify' value='" . $para['flag_modify'] . "'/>";
        $sHtml .= "<input type='hidden' name='card_no' value='" . $para['card_no'] . "'/>";
        $sHtml .= "<input type='hidden' name='back_url' value='" . $para['back_url'] . "'/>";
        //submit按钮控件请不要含有name属性
        $sHtml = $sHtml . "<input type='submit' value=''></form>";
        $sHtml = $sHtml."<script>document.forms['llpaysubmit'].submit();</script>";
        return $sHtml;
    }

    /**
     * 生成要请求给连连支付的参数数组
     * @param $para_temp 请求前的参数数组
     * @return 要请求的参数数组
     */
    function buildRequestPara($para_temp) {
        //除去待签名参数数组中的空值和签名参数
        $para_filter = $this->paraFilter($para_temp);
        //对待签名参数数组排序
        $para_sort = $this->argSort($para_filter);
        //生成签名结果
        $mysign = $this->buildRequestMysign($para_sort);
        //签名结果与签名方式加入请求提交参数组中
        $para_sort['sign'] = $mysign;
        $para_sort['sign_type'] = strtoupper(trim($this->config['sign_type']));
        foreach ($para_sort as $key => $value) {
            $para_sort[$key] = $value;
        }
        return $para_sort;
        //return urldecode(json_encode($para_sort));
    }

    /**
     * 对数组排序
     * @param $para 排序前的数组
     * return 排序后的数组
     */
    function argSort($para) {
        ksort($para);
        reset($para);
        return $para;
    }

    /**
     * 除去数组中的空值和签名参数
     * @param $para 签名参数组
     * return 去掉空值与签名参数后的新签名参数组
     */
    function paraFilter($para) {
        $para_filter = array();
        while (list ($key, $val) = each ($para)) {
            if($key == "sign" || $val == "")continue;
            else	$para_filter[$key] = $para[$key];
        }
        return $para_filter;
    }


    /**
     * 生成签名结果
     * @param $para_sort 已排序要签名的数组
     * return 签名结果字符串
     */
    function buildRequestMysign($para_sort) {
        //把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
        $prestr = $this->createLinkstring($para_sort);
        $mysign = "";
        switch (strtoupper(trim($this->config['sign_type']))) {
            case "MD5" :
                $mysign = $this->md5Sign($prestr, $this->config['key']);
                break;
            case "RSA" :
                $mysign = $this->RsaSign($prestr, $this->config['RSA_PRIVATE_KEY']);
                break;
            default :
                $mysign = "";
        }
        file_put_contents("log.txt","签名:".$mysign."\n", FILE_APPEND);
        return $mysign;
    }

    /**RSA签名
     * $data签名数据(需要先排序，然后拼接)
     * 签名用商户私钥，必须是没有经过pkcs8转换的私钥
     * 最后的签名，需要用base64编码
     * return Sign签名
     */

    function Rsasign($data,$priKey) {
        //转换为openssl密钥，必须是没有经过pkcs8转换的私钥
        $res = openssl_get_privatekey($priKey);

        //调用openssl内置签名方法，生成签名$sign
        openssl_sign($data, $sign, $res,OPENSSL_ALGO_MD5);

        //释放资源
        openssl_free_key($res);

        //base64编码
        $sign = base64_encode($sign);
        //file_put_contents("log.txt","签名原串:".$data."\n", FILE_APPEND);
        return $sign;
    }



    /**
     * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
     * @param $para 需要拼接的数组
     * return 拼接完成以后的字符串
     */
    function createLinkstring($para) {
        $arg  = "";
        while (list ($key, $val) = each ($para)) {
            $arg.=$key."=".$val."&";
        }
        //去掉最后一个&字符
        $arg = substr($arg,0,count($arg)-2);
        //file_put_contents("log.txt","转义前:".$arg."\n", FILE_APPEND);
        //如果存在转义字符，那么去掉转义
        if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}
        //file_put_contents("log.txt","转义后:".$arg."\n", FILE_APPEND);
        return $arg;
    }

    function Rsaverify($data, $sign)  {
        //读取连连支付公钥文件
        $pubKey = file_get_contents(PAYMENT_URL . 'llpcpay/key/201710250001059760/llpay_public_key.pem');

        //转换为openssl格式密钥
        $res = openssl_get_publickey($pubKey);
        
        //调用openssl内置方法验签，返回bool值
        $result = (bool)openssl_verify($data, base64_decode($sign), $res,OPENSSL_ALGO_MD5);
        
        //释放资源
        openssl_free_key($res);

        //返回资源是否成功
        return $result;
    }
}

?>