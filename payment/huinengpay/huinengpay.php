<?php

/**
 *
 */
class huinengpay_payment
{
    public $_config, $param;

    function __construct($_huinengconfig, $param)
    {
        $this->_config = $_huinengconfig;
        $this->param = $param;
    }

    /**
     * 验签数据组装
     * @param $data
     * @return bool|string
     */
    public function dataCombine($data)
    {
        ksort($data);
        if(isset($data['bank_type'])){
            unset($data['bank_type']);
        }
        if(isset($data['bank_type'])){
            unset($data['bank_type']);
        }
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