<?php
/***********************************************************
	Note	: 快捷支付
	Version : 1.0
	Author  : dai_vx
	Update  : 2018-03-30
***********************************************************/
//require_once '/include/common.php';

class qindao_payment
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
       
        $param = [
             'amount'     =>  $data['amount'],
            'merchno'    => $data['merchno'],
            'cardno' => $data['cardno'],
            'certno' => $data['certno'],
            //'goodsName'     => $this->param['goodsName'],
            'interType'       => $data['interType'],
            'notifyUrl'     =>$data['notifyUrl'],
            //'returnurl'     => //$this->config['returnurl'],
            'traceno' => $data['traceno'],
            'trueName'        => $data['trueName'],
            'mobile'        =>  $data['mobile'],
            'settleType'        =>  $data['settleType']
            
            
            
        ];
        $sign = md5($this->dataCombine($param));
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

        $param = [
            'amount'     =>  $data['amount'],
            'merchno'    => $data['merchno'],
            'cardno' => $data['cardno'],
            'certno' => $data['certno'],
            //'goodsName'     => $this->param['goodsName'],
            'interType'       => $data['interType'],
            'notifyUrl'     =>$data['notifyUrl'],
            //'returnurl'     => //$this->config['returnurl'],
            'traceno' => $data['traceno'],
            'trueName'        => $data['trueName'],
            'mobile'        =>  $data['mobile'],
            'settleType'        =>  $data['settleType']
        ];
        $data = $this->dataCombine($param);
		logInfo('qindao:'.$data.'MD5:'.md5($data));
        if($signature == md5($data)){
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
        $string .= 'E799282D6FBCA44E66A3BB44D456AE78';//$this->config['customerkey'];
        //echo $string;exit;
        return $string;
    }
}
?>