<?php
define("WEB_LANG", "utf-8");            //utf-8			gb2312			big5
header("Content-Type: text/html; charset=" . WEB_LANG);

$server_name = array(
		'fic.sxgcsy.top' => [
			'img' => 'sxgcsy',
			'name' => '国灿实业',
			'code' => '801',
			'pay' => 'sxgcsy_payment'
		]
	);

date_default_timezone_set("Asia/Shanghai");
define("ROOT", dirname(__FILE__));
define("INCLUDE_DIR", ROOT . "/include/");
define("SMARTY_DIR", ROOT . "/smarty/");
define("CLASS_DIR", ROOT . "/class/");
define("SMS_LIB", ROOT . "/smslib/");
define("ADMIN_CLASS_DIR", ROOT . "/admin/class/");
define('MODEL_URL', ROOT . "/templates/");                                    //模板保存路径
define('SOURCE', $server_name[$_SERVER['SERVER_NAME']]['name']); //来源
define('SHOPCODE', $server_name[$_SERVER['SERVER_NAME']]['code']);
define('PAYMENT_URL', ROOT . "/payment/");//支付路径
define('LOG_URL', ROOT . "/log/");//日志路径


/*define('DB_HOST', 'localhost');	//数据库主机地址，一般为localhost
define('DB_USER', 'local_xs');		//数据库用户名
define('DB_PWD', 'LFHA^K5s#a');		//数据库密码
define('DB_NAME', 'shop');	//数据库名称
define('DB_CHARSET', 'utf-8');//编码类型
define('DB_PCONNECT', False);	//是否启用持久连接*/
	

define('DB_HOST', 'localhost');	//数据库主机地址，一般为localhost
define('DB_USER', 'xuniuser');		//数据库用户名
define('DB_PWD', 'ki%D$jw6kFa3');		//数据库密码
define('DB_NAME', 'fic_shopdb');	//数据库名称
define('DB_CHARSET', 'utf-8');//编码类型
define('DB_PCONNECT', False);	//是否启用持久连接


require_once PAYMENT_URL.'payment_config.php';

$page = explode("/", $_SERVER['PHP_SELF']);
$page_url = $page[count($page) - 1];
define('PAGE_URL', $page_url);    //当前页面URL

if (!session_id()){session_start();}
?>