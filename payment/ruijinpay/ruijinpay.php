<?php
/***********************************************************
	Note	: 瑞金付款操作
	Version : 1.0
	Author  : fangyi
	Update  : 2018-03-02
***********************************************************/
class ruijinpay_payment
{

    public $config;

    function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * 利用约定数据和私钥生成数字签名
     * @param array|string $data 待签数据
     * @return String 返回签名
     */
    public function sign($data = [])
    {
        if (empty($data))
        {
            return false;
        }
        if(isset($data['sign'])){
            unset($data['sign']);
        }

        if(isset($data['sign_type'])){
            unset($data['sign_type']);
        }


        $private_key = file_get_contents(dirname(__FILE__).'/key/'.$this->config['merchant_code'].'/privateKey.pem');
        if (empty($private_key))
        {
            //echo 'Private Key error!';
            return false;
        }

        $pkeyid = openssl_get_privatekey($private_key);
        //tbug($private_key);
        if (empty($pkeyid))
        {
            //echo 'private key resource identifier False!';
            return false;
        }

        $verify = openssl_sign($this->dataCombine($data), $signature, $pkeyid, OPENSSL_ALGO_MD5);
        openssl_free_key($pkeyid);
        $signature = base64_encode($signature);

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

        if (empty($data) || empty($signature))
        {
            return false;
        }

        $public_key = file_get_contents(dirname(__FILE__).'/key/'.$this->config['merchant_code'].'/publicKey.pem');
        if (empty($public_key))
        {
            //echo 'Public Key error!';
            return false;
        }

        $pkeyid = openssl_get_publickey($public_key);
        if (empty($pkeyid))
        {
            //echo 'public key resource identifier False!';
            return false;
        }
        $data = $this->dataCombine($data);
        $signature = base64_decode($signature);
        $ret = openssl_verify($data, $signature, $pkeyid, OPENSSL_ALGO_MD5);
        /*switch ($ret)
        {
            case -1:
                echo 'error';
                break;
            default:
                echo $ret ==1 ? 'correct' : 'incorrect';//0:incorrect
                break;
        }*/
        return $ret;
    }

    /**
     * 敏感数据加密
     * @param string $card_no
     * @param string $card_name
     * @param string $id_no
     * @return int -1:error验证错误 1:correct验证成功 0:incorrect验证失败
     */
    public function encrypt_info_sign($card_no = '', $card_name = '', $id_no = '')
    {
        $public_key = file_get_contents(dirname(__FILE__).'/key/'.$this->config['merchant_code'].'/publicKey.pem');
        if (empty($public_key))
        {
            return false;
        }
        $encrypt = $card_no.'|'.$card_name.'|'.$id_no;

        openssl_public_encrypt($encrypt,$info, $public_key);
        $encrypt_info = base64_encode($info);//encrypt_info参数参与签名
        return $encrypt_info;
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

    /**
     * CURL
     * @param $postdata
     * @param $url
     * @return bool|mixed
     */
    public function postCurl($url, $postdata){

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postdata));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response=curl_exec($ch);
        return  $response;
    }

    public function xmlToArray($xml)
    {
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $values;
    }
}
?>