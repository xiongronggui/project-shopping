<?php
define("WEB_LANG", "utf-8");            //utf-8			gb2312			big5
header("Content-Type: text/html; charset=" . WEB_LANG);

$server_name = array(
		'www.sxgcsy.top' => [
			'img' => 'sxgcsy',
			'name' => '国灿实业',
			'code' => '801',
			'pay' => 'sxgcsy_payment',
			'db' => 'fic_shopdb'
		],
		'www.dueseeff.top' => [
			'img' => 'dueseeff',
			'name' => '怀琨商贸',
			'code' => '802',
			'pay' => 'dueseeff_payment',
			'db' => 'fic_shopdb'
		],
		'www.hmgsm.top' => [
			'img' => 'hmgsm',
			'name' => '海明宫商贸',
			'code' => '803',
			'pay' => 'hmgsm_payment',
			'db' => 'fic_shopdb'
		],
		'www.xaxzsm.top' => [
			'img' => 'xaxzsm',
			'name' => '兴卓商贸',
			'code' => '804',
			'pay' => 'xaxzsm_payment',
			'db' => 'fic_shopdb'
		],
		'www.xasrgm.top' => [
			'img' => 'xasrgm',
			'name' => '萨日工贸',
			'code' => '805',
			'pay' => 'xasrgm_payment',
			'db' => 'fic_shopdb'
		],
		'www.xaqrsm.top' => [
			'img' => 'xaqrsm',
			'name' => '愜瑞商贸',
			'code' => '806',
			'pay' => 'xaqrsm_payment',
			'db' => 'fic_shopdb'
		],
		'www.xadysm.top' => [
			'img' => 'xadysm',
			'name' => '德延商贸',
			'code' => '807',
			'pay' => 'xadysm_payment',
			'db' => 'fic_shopdb'
		],
		/*'www.bjdbdl.top' => [
			'img' => 'bjdbdl',
			'name' => '电吧电力',
			'code' => '808',
			'pay' => 'bjdbdl_payment'
		],*/
		'www.smfe9sn.top' => [
			'img' => 'smfe9sn',
			'name' => '煜凯网络',
			'code' => '808',
			'pay' => 'smfe9sn_payment',
			'db' => 'fic_shopdb'
		],
		'www.ftdsy.top' => [
			'img' => 'ftdsy',
			'name' => '富泰达',
			'code' => '901',
			'pay' => 'ftdsy_payment',
			'db' => 'fic_xsmcfx'
		],
		'www.ladao.top' => [
			'img' => 'ladao',
			'name' => '扬玲商贸',
			'code' => '902',
			'pay' => 'ladao_payment',
			'db' => 'shop'
		],
		'www.mydzkj.top' => [
			'img' => 'mydzkj',
			'name' => '迈远电子',
			'code' => '902',
			'pay' => 'mydzkj_payment',
			'db' => 'shop'
		],
		'192.168.1.96:8091' => [
			'img' => 'klt',
			'name' => '本地测试',
			'code' => '811',
			'pay' => 'klt_payment',
			'db' => 'panda_shop'
		],
		'www.panda.com:8888' => [
			'img' => 'klt',
			'name' => '本地测试',
			'code' => '811',
			'pay' => 'klt_payment',
			'db' => 'panda_shop'
		]
	);

$goods_list = ['Love Story','Top-up Point','Software SN','Network Software','Internet Phone','Online Gaming Equipment','Software Source Code','APP Source Code','Continued Story'];

date_default_timezone_set("Asia/Shanghai");
define("ROOT", dirname(__FILE__));
define("INCLUDE_DIR", ROOT . "/include/");
define("SMARTY_DIR", ROOT . "/smarty/");
define("CLASS_DIR", ROOT . "/class/");
define("SMS_LIB", ROOT . "/smslib/");
define("ADMIN_CLASS_DIR", ROOT . "/admin/class/");
define('MODEL_URL', ROOT . "/templates/");                                    //模板保存路径
define('SOURCE', $server_name[$_SERVER['HTTP_HOST']]['name']); //来源
define('SHOPCODE', $server_name[$_SERVER['HTTP_HOST']]['code']);
define('db',$server_name[$_SERVER['HTTP_HOST']]['db']);
define('PAYMENT_URL', ROOT . "/payment/");//支付路径
define('LOG_URL', ROOT . "/log/");//日志路径

$interface_url = array(
	'net' => 'http://testapi.xs9999.com/Crm',
	'usernet' => 'http://testapi.xs9999.com/User/',
	'pwd' => '12qdrgf&^%68gnf4z1'
);


define('DB_HOST', '');    //数据库主机地址，一般为localhost
define('DB_USER', '');        //数据库用户名
define('DB_PWD', '');        //数据库密码
define('DB_NAME', '');    //数据库名称
define('DB_CHARSET', 'utf-8');//编码类型
define('DB_PCONNECT', False);    //是否启用持久连接


require_once PAYMENT_URL.'payment_config.php';

$page = explode("/", $_SERVER['PHP_SELF']);
$page_url = $page[count($page) - 1];
define('PAGE_URL', $page_url);    //当前页面URL

if (!session_id()){session_start();}
$login_time = 7200;
setcookie(session_name(),session_id(),time()+$login_time,"/");
?>