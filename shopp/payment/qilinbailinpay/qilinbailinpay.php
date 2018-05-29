<?php
/***********************************************************
	Note	: 宝泽付付款操作
	Version : 1.0
	Author  : fangyi
	Update  : 2018-03-02
***********************************************************/
//require_once '/include/common.php';

class qilinbailinpay_payment
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
        if(isset($data['signature'])){
            unset($data['signature']);
        }
        if (empty($data))
        {
            return false;
        }
        
        $sign = md5($this->dataCombine($data));
        logInfo('发送加密值:'.$sign);
        return $sign;
    }

    /**
     * 利用公钥和数字签名以及约定数据验证合法性
     * @param array|string $data 待验证数据
     * @param string $signature 数字签名
     * @return int 1:correct验证成功 0:incorrect验证失败
     */
    public function isValid($data = [], $signature = '')
    {

        if (empty($data) || empty($signature))
        {
            return false;
        }

        $params = [
            'merchno'       => $data['merchno'],
            'traceno'     => $data['traceno'],
            'amount'       => $data['amount'],
            'orderno'  => $data['orderno'],
            'channelOrderno'     => $data['channelOrderno'],
            'status' => $data['status']
        ];
        $data = $this->dataCombine($params);
        logInfo('加密结果:'.strtoupper(md5($data)));
        if($signature ==  strtoupper(md5($data))){
            return true;
        }else{
            return false;
        }
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
        $string .= $this->config['customerkey'];
        logInfo('回调加密字符串:'.$string);
        return $string;
    }
}
?>