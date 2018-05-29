<?php
/***********************************************************
	Note	: metisPay付款操作
	Version : 1.0
	Author  : fangyi
	Update  : 2018-03-02
***********************************************************/
class metispay_payment
{

    public $config;

    function __construct($metis)
    {
        $this->config = $metis;
    }

    /**
     * 利用约定数据和私钥生成数字签名
     * @param array $data 待签数据
     * @return String 返回签名
     */
    public function sign($data = [])
    {
        if(isset($data['signature'])){
            unset($data['signature']);
        }
        if (empty($data))
        {
            return false;
        }

        $private_key = file_get_contents(dirname(__FILE__).'/key/'.$this->config['orgId'].'/privateKey.pem');
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

        $public_key = file_get_contents(dirname(__FILE__).'/key/'.$this->config['orgId'].'/publicKey.pem');
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
     * 验签数据组装
     * @param $data
     * @return bool|string
     */
    private function dataCombine($data)
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