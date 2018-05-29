<?php
/***********************************************************
	Note	: 高汇通付款操作
	Version : 1.0
	Author  : fangyi
	Update  : 2018-03-02
***********************************************************/
class ghtpay_payment
{

    public $config;

    function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * 利用约定数据和私钥生成数字签名
     * @param array $data 待签数据
     * @return String 返回签名
     */
    public function sign($data = [])
    {
        if(isset($data['sign'])){
            unset($data['sign']);
        }
        if (empty($data))
        {
            return false;
        }

        $private_key = file_get_contents(dirname(__FILE__).'/key/'.$this->config['merchantNo'].'/privateKey.pem');
        if (empty($private_key))
        {
            //echo 'Private Key error!';
            return false;
        }
        $data = $this->dataCombine($data);
        openssl_sign($data, $signature, $private_key, OPENSSL_ALGO_SHA1);
        $signature = base64_encode($signature);
        $signature = urlencode($signature);
        return $signature;
    }

    /**
     * 利用公钥和数字签名以及约定数据验证合法性
     * @param array|string $data 待验证数据
     * @param string $signature 数字签名
     * @return int -1:error验证错误 1:correct验证成功 0:incorrect验证失败
     */
    public function isValid($data = [], $signature = '')
    {
        if(isset($data['sign'])){
            unset($data['sign']);
        }
        if (empty($data) || empty($signature))
        {
            return false;
        }

        $public_key = file_get_contents(dirname(__FILE__).'/key/'.$this->config['merchantNo'].'/publicKey.pem');
        if (empty($public_key))
        {
            //echo 'Public Key error!';
            return false;
        }
        $data = $this->dataCombine($data);
        $ret = openssl_verify($data, base64_decode(rawurldecode($signature)), rawurldecode($public_key),OPENSSL_ALGO_SHA1);
        return $ret;
    }

    /**
     * 验签数据组装
     * @param $data
     * @return bool|string
     */
    public function dataCombine($data)
    {
        ksort($data);
        $string = '';
        foreach ($data as $name => $value) {
            if($value !== ''){
                $string .= $name . '=' . $value . '&';
            }
        }
        $string = substr($string, 0, strlen($string) - 1);
        return $string;
    }
}
?>