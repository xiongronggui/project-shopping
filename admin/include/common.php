<?php
	header('Content-Type: text/html; charset=utf-8');
	include_once ("../config.php");
	include_once (INCLUDE_DIR."global.func.php");
	include_once (INCLUDE_DIR."db_mysql.class.php");
	include_once (SMARTY_DIR."Smarty.class.php");
	include_once (INCLUDE_DIR."page_class.php");
	include_once (ADMIN_CLASS_DIR."BaseClass.class.php");

	//链接数据库
	$db = new dbstuff;
	$db->connect(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PCONNECT) ;

	$tpl = new Smarty();

	foreach(array( '_POST', '_GET') as $_request) {
		foreach($$_request as $_key => $_value) {
			$_key{0} != '_' && $$_key = daddslashes($_value);
		}
	}
?>