<?php
/***********************************************************
	Note	: 豆豆支付操作
	Version : 1.0
	Author  : fangyi
	Update  : 2018-03-19
***********************************************************/
class doudoupay_payment
{

    public $config, $dataArray, $getParams;

    function __construct($config)
    {
        $this->config = $config;
        include_once('lib/CryptRSA.class.php');
        include_once('lib/func.class.php');
    }


    /**
     * 参数组装后传递
     * @param $dataArray
     * @param $getParams
     * @return mixed
     */
    public function dataCombineAndSend($dataArray, $getParams)
    {
        $dataArray = func::argSort($dataArray);//sort
        $dataArray = func::array_value_to_string($dataArray);//to string

        $str_query = array_merge($getParams, ['data' => $dataArray]);
        $str_query = func::argSort($str_query);
        $str_query = func::array_value_to_string($str_query);
        $str_query = json_encode($str_query, JSON_UNESCAPED_SLASHES);

        //生成签名
        $getParams['sign'] = func::md5Sign($str_query, $this->config['md5_key']);

        $getParams = func::argSort($getParams);

        $url = 'https://api.doudoupay.com/v1?' . func::http_build_querys($getParams);
        //tbug($url);
        $crypt = new CryptRSA();
        $public_key_file = dirname(__FILE__).'/key/'.$this->config['merchant_no'].'/publicKey.pem';
        $private_key_file = dirname(__FILE__).'/key/'.$this->config['merchant_no'].'/privateKey.pem';

        $crypt->setParam('_public_key', file_get_contents($public_key_file));//加载公钥
		
        $crypt->setParam('_private_key', file_get_contents($private_key_file));//加载私钥
        $crypt->setParam('_private_key_password', $this->config['secret']);//设置私钥密码

        $encrypted = json_encode($dataArray, JSON_UNESCAPED_SLASHES);//数据转换成JSON
        $encrypted = $crypt->publicEncrypt($encrypted);//数据加密
		
        //生成post数据
        $post = ['data' => $encrypted];
        $return = func::vCurl($url, $post);//发起API通讯
		
        $return = $crypt->privateDecrypt($return);
        $array = json_decode($return, true);
        return $array;
    }

    /**
     * 验签
     * @param $data
     * @param $sign
     * @return bool
     */
    public function isValid($data, $sign)
    {
        ksort($data);
        $string = '';
        foreach ($data as $name => $value) {
            if($value){
                $string .= $name . '=' . $value . '&';
            }
        }
//        $string = substr($string, 0, strlen($string) - 1);
        $string .= 'key=';
        $res = func::md5SignVerify($string, $sign, $this->config['md5_key']);
        return $res;
    }

    /**
     * 传参基本参数
     * @param $method
     * @return array
     */
    public function getParams($method)
    {
        $getParams = [
            'pid' => $this->config['pid'],
            'method' => $method,
            'timestamp' => time(),
            'randstr' => func::getRandstr(),
        ];
        return $getParams;
    }
}
?>