<?php
 $param = [
            'customerid' => 77,
            'status' => 1,
            'sdpayno' => "2018032911544654421",
            'sdorderno' => "20180329115439970152",
            'total_fee' => "50.01",
            'paytype' => "kuaijie",
        ];

$string = dataCombine($param);
echo md5($string);
exit;

function dataCombine($data)
{
    $string = '';
    foreach ($data as $name => $value) {
        if($value !== ''){
            $string .= $name . '=' . $value . '&';
        }
    }
    $string .= '05db51b3bbefb6c150632d555c242a43ef5b836d';
    return $string;
}
?> 