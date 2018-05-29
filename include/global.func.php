<?php
	//字符串转义
	function daddslashes($string, $force = 0) {
		!defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
		if(!MAGIC_QUOTES_GPC || $force) {
			if(is_array($string)) {
				foreach($string as $key => $val) {
					$string[$key] = daddslashes($val, $force);
				}
			} else {
				$string = addslashes($string);
			}
		}
		return $string;
	}

	//读取参数
	function _g($name, $type = '') {
		if ( isset($_GET[$name]) ) {
			$ret = $_GET[$name];
		}
		else if ( isset($_POST[$name]) ) {
			$ret = $_POST[$name];
		}
		else if ( isset($_REQUEST[$name]) ) {
			$ret = $_REQUEST[$name];
		}
		else{
			$ret = false;
		}
		if ($ret !== false && $type != '') {
			if ( $type == 'int' ) {
				$ret = intval($ret);
			}
			else if ( $type == 'str' ) {
				$ret = strval($ret);
			}
			else{
				settype($ret, $type);
			}
		}
		return trim($ret);
		//return $ret;
	}

	//获取随机字符串
	function random($length, $numeric = 0) {
		PHP_VERSION < '4.2.0' ? mt_srand((double)microtime() * 1000000) : mt_srand();
		$seed = base_convert(md5(print_r($_SERVER, 1).microtime()), 16, $numeric ? 10 : 35);
		$seed = $numeric ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
		$hash = '';
		$max = strlen($seed) - 1;
		for($i = 0; $i < $length; $i++) {
			$hash .= $seed[mt_rand(0, $max)];
		}
		return $hash;
	}


	//字符串解密加密
	function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
		$ckey_length = 0;	// 随机密钥长度 取值 0-32;
					// 加入随机密钥，可以令密文无任何规律，即便是原文和密钥完全相同，加密结果也会每次不同，增大破解难度。
					// 取值越大，密文变动规律越大，密文变化 = 16 的 $ckey_length 次方
					// 当此值为 0 时，则不产生随机密钥
		$key = md5($key ? $key : md5("Soong"));
		$keya = md5(substr($key, 0, 16));
		$keyb = md5(substr($key, 16, 16));
		$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

		$cryptkey = $keya.md5($keya.$keyc);
		$key_length = strlen($cryptkey);

		$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
		$string_length = strlen($string);

		$result = '';
		$box = range(0, 255);

		$rndkey = array();
		for($i = 0; $i <= 255; $i++) {
			$rndkey[$i] = ord($cryptkey[$i % $key_length]);
		}

		for($j = $i = 0; $i < 256; $i++) {
			$j = ($j + $box[$i] + $rndkey[$i]) % 256;
			$tmp = $box[$i];
			$box[$i] = $box[$j];
			$box[$j] = $tmp;
		}

		for($a = $j = $i = 0; $i < $string_length; $i++) {
			$a = ($a + 1) % 256;
			$j = ($j + $box[$a]) % 256;
			$tmp = $box[$a];
			$box[$a] = $box[$j];
			$box[$j] = $tmp;
			$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
		}

		if($operation == 'DECODE') {
			if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
				return substr($result, 26);
			} else {
				return '';
			}
		} else {
			return $keyc.str_replace('=', '', base64_encode($result));
		}
	}

	//utf8字符串截取
	function utf_substr($str,$len) 
	{  
		for($i=0; $i<$len; $i++) 
		{  
			$temp_str=substr($str, 0, 1);
			if(ord($temp_str) > 127) 
			{  
				$i++;
				if($i<$len) 
				{  
					$new_str[]=substr($str, 0, 3);
					$str=substr($str, 3);  
				} 
			} 
			else 
			{  
				$new_str[]=substr($str, 0, 1); 
				$str=substr($str, 1);  
			}  
		} 
		$result = join($new_str) ;
		if($len < strlen($str)) 
		{
			return $result . "…";
		} 
		else 
		{
			return $result;
		}
	} 

	/**
 * PHP发送Json对象数据
 *
 * @param string $url 请求url
 * @param string $jsonStr 发送的json字符串
 * @return array
 */
function http_post_json($url, $jsonStr)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($jsonStr)
        )
    );
    $response = curl_exec($ch);
    if(!$response){
		$response = curl_error($ch);
	}
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    //return $response;
    return array($httpCode, $response);
}

function _curlPost($url, $data, $timeout = 30)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

    /*curl_setopt($ch, CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/form-data',
            'Content-Length:' . strlen(json_encode($data))
            )
    );*/

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $res = curl_exec($ch);
    $errorno = curl_errno($ch);
    
    if ($errorno) {
        curl_close($ch);
        return array('errorno' => false, 'errmsg' => $errorno);
    }
    curl_close($ch);
    return json_decode($res, true);
}

function curlRequest($url, $post='', $cookie='', $returnCookie = 0)
{
	$curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)');
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domain_url = $protocol . '' . $_SERVER['HTTP_HOST'];
    curl_setopt($curl, CURLOPT_REFERER, $domain_url);

    /*
     $origin = 'Origin: http://tc.orgs.com';  //值有冒号会失败
     curl_setopt($curl, CURLOPT_HTTPHEADER, array($origin));
    */
    //curl_setopt($curl, CURLOPT_REFERER, $_SERVER['SERVER_NAME']);

    if($post) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
    }
    if($cookie) {
        curl_setopt($curl, CURLOPT_COOKIE, $cookie);
    }
    curl_setopt($curl, CURLOPT_HEADER, $returnCookie);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);

    if (curl_errno($curl)) {
        return curl_error($curl);
    }
    curl_close($curl);
    if($returnCookie){
        list($header, $body) = explode("\r\n\r\n", $data, 2);
        preg_match_all("/Set\-Cookie:([^;]*);/", $header, $matches);
        $info['cookie']  = substr($matches[1][0], 1);
        $info['content'] = $body;
        return $info;
    }else{
        return $data;
    }
    return $data;
}


/**
 * json curl 发送消息
 * @param string $url
 * @param string $data
 * @param bool $json
 * @return mixed:boolean number
 */
function curlPostJson($url, $data = null, $json = true)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_TIMEOUT, 60);
    if (!empty($data)) {
        if($json && is_array($data)){
            $data = json_encode( $data );
        }
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        if($json){ //发送JSON数据
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_HTTPHEADER,
                array(
                    'Content-Type: application/json',
                    'Content-Length:' . strlen($data))
            );
        }else{
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_HTTPHEADER,
                array(
                    'Content-Type: application/x-www-form-urlencoded',
                    'Content-Length:' . strlen($data))
            );
        }
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $res = curl_exec($curl);

    $errorno = curl_errno($curl);
    
    if ($errorno) {
        curl_close($curl);
        return array('errorno' => false, 'errmsg' => $errorno);
    }
    curl_close($curl);
    return json_decode($res, true);
}


function tbug($data = '', $exit = true)
{
    header('Content-type: text/html; charset=utf-8');
    echo '<pre/>';
    print_r($data);
    !$exit || exit ();
}

function logInfo($data, $log_prefix = 'log')
{
    $log_path = sprintf('%s/%s_%s.log', LOG_URL, $log_prefix, date('Ymd'));
    //tbug([$log_path, $data]);
    file_put_contents($log_path, '-------------------' . PHP_EOL, FILE_APPEND);
    file_put_contents($log_path, date('Y-m-d H:i:s'/*, strtotime('+7 hours')*/) . PHP_EOL, FILE_APPEND);
    file_put_contents($log_path, $data . PHP_EOL, FILE_APPEND);
    file_put_contents($log_path, '-------------------' . PHP_EOL, FILE_APPEND);
}

/**
 * 
 * 根据php的$_SERVER['HTTP_USER_AGENT'] 中各种浏览器访问时所包含各个浏览器特定的字符串来判断是属于PC还是移动端
 * @author  
 * @lastmodify 
 * @return  BOOL
 */
function checkmobile()
{
	 global $_G;
	 $mobile = array();
	//各个触控浏览器中$_SERVER['HTTP_USER_AGENT']所包含的字符串数组
	 static $touchbrowser_list =array('iphone', 'android', 'phone', 'mobile', 'wap', 'netfront', 'java', 'opera mobi', 'opera mini',
	    'ucweb', 'windows ce', 'symbian', 'series', 'webos', 'sony', 'blackberry', 'dopod', 'nokia', 'samsung',
	    'palmsource', 'xda', 'pieplus', 'meizu', 'midp', 'cldc', 'motorola', 'foma', 'docomo', 'up.browser',
	    'up.link', 'blazer', 'helio', 'hosin', 'huawei', 'novarra', 'coolpad', 'webos', 'techfaith', 'palmsource',
	    'alcatel', 'amoi', 'ktouch', 'nexian', 'ericsson', 'philips', 'sagem', 'wellcom', 'bunjalloo', 'maui', 'smartphone',
	    'iemobile', 'spice', 'bird', 'zte-', 'longcos', 'pantech', 'gionee', 'portalmmm', 'jig browser', 'hiptop',
	    'benq', 'haier', '^lct', '320x320', '240x320', '176x220');
	//window手机浏览器数组【猜的】
	 static $mobilebrowser_list =array('windows phone');
	//wap浏览器中$_SERVER['HTTP_USER_AGENT']所包含的字符串数组
	 static $wmlbrowser_list = array('cect', 'compal', 'ctl', 'lg', 'nec', 'tcl', 'alcatel', 'ericsson', 'bird', 'daxian', 'dbtel', 'eastcom',
	   'pantech', 'dopod', 'philips', 'haier', 'konka', 'kejian', 'lenovo', 'benq', 'mot', 'soutec', 'nokia', 'sagem', 'sgh',
	   'sed', 'capitel', 'panasonic', 'sonyericsson', 'sharp', 'amoi', 'panda', 'zte');
	 $pad_list = array('pad', 'gt-p1000');
	 $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
	 if(dstrpos($useragent, $pad_list)) {
	  return false;
	 }
	 if(($v = dstrpos($useragent, $mobilebrowser_list, true))){
	  $_G['mobile'] = $v;
	  return '1';
	 }
	 if(($v = dstrpos($useragent, $touchbrowser_list, true))){
	  $_G['mobile'] = $v;
	  return '2';
	 }
	 if(($v = dstrpos($useragent, $wmlbrowser_list))) {
	  $_G['mobile'] = $v;
	  return '3'; //wml版
	 }
	 $brower = array('mozilla', 'chrome', 'safari', 'opera', 'm3gate', 'winwap', 'openwave', 'myop');
	 if(dstrpos($useragent, $brower)) return false;
	 $_G['mobile'] = 'unknown';
	//对于未知类型的浏览器，通过$_GET['mobile']参数来决定是否是手机浏览器
	 if(isset($_G['mobiletpl'][$_GET['mobile']])) {
	  return true;
	 } else {
	  return false;
	 }
}
/**
 * 判断$arr中元素字符串是否有出现在$string中
 * @param  $string     $_SERVER['HTTP_USER_AGENT'] 
 * @param  $arr          各中浏览器$_SERVER['HTTP_USER_AGENT']中必定会包含的字符串
 * @param  $returnvalue 返回浏览器名称还是返回布尔值，true为返回浏览器名称，false为返回布尔值【默认】
 * @author  
 * @lastmodify  
 */
function dstrpos($string, $arr, $returnvalue = false) 
{
	 if(empty($string)) return false;
	 foreach((array)$arr as $v) {
	  if(strpos($string, $v) !== false) {
	   $return = $returnvalue ? $v : true;
	   return $return;
	  }
	 }
	 return false;
}


function returnData($code, $msg, $data,$url='')
{
    $res = [
        'success' => $code,
        'msg'     => $msg,
        'url' => $url,
        'data'    => $data
    ];
    echo json_encode($res);
    exit;
}

//将XML转为array
function xmlToArray($xml)
{
    //禁止引用外部xml实体
    libxml_disable_entity_loader(true);
    $values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    return $values;
}

function send_sms($order_id,$password,$mobile)
{
	include SMS_LIB."TopSdk.php";

	$appkey = "24802154";
	$secret = "48af266ccac4d014ff36f29a6e23b504";

	$sign_name = "鑫圣";
	$temp_code = "SMS_125865060";

	$time = date("Y-m-d H:i", $rs['addtime']);
	$mobile = $rs['mobile'];

	$c = new TopClient;
	$c->appkey = $appkey;
	$c->secretKey = $secret;
	$req = new AlibabaAliqinFcSmsNumSendRequest;
	$req->setSmsType("normal");
	$req->setSmsFreeSignName($sign_name);
	$req->setSmsParam("{'time':'$time', 'order_id':'$order_id', 'pwd':'$password'}");
	$req->setRecNum($mobile);
	$req->setSmsTemplateCode($temp_code);
	$resp = $c->execute($req);
}

function getIp(){
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")){
        $ip = getenv("HTTP_CLIENT_IP");
    }else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")){
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    }else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")){
        $ip = getenv("REMOTE_ADDR");
    }else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")){
        $ip = $_SERVER['REMOTE_ADDR'];
    }else{
        $ip = "unknown";
    }
    return($ip);
}
?>