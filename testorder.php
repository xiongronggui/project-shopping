<?php
require_once 'include/common.php';

$data = '{"success":1,"msg":"","data":{"source":"\u611c\u745e\u5546\u8d38","website":1,"medium":"\u82f9\u679c\u91d1","id_sum":1,"time":"0","ident":"vpiVOrCu2qPkKCKUziTfHWgKaTqHE21jRSwl8LwXcdA="}}';
$data = json_decode($data,true);
$result = curlPostJson('http://139.199.75.178:8080/achieveBuyCount',$data['data']);
var_dump($result);
?>