<?php
/**
* 	配置账号信息
*/
include ROOT."/shopp/config.php";
include PAYMENT_URL.'payment_config.php';
$host = $_SERVER['HTTP_HOST'];
$payment_config = $server_name[$host]['img'].'_payment_config';
$payment_config = $$payment_config;
$pay_config = $payment_config['微信']['config_name'];
$weixin_config = $$pay_config;
define('APPID_N',$weixin_config['appid']);
define('MCHID_N',$weixin_config['mchid']);
define('KEY_N',$weixin_config['key']);
define('APPSECRET_N',$weixin_config['appsecret']);

class WxPayConfig
{
	//=======【基本信息设置】=====================================
	//

	/**
	 * TODO: 修改这里配置为您自己申请的商户信息
	 * 微信公众号信息配置
	 * 
	 * APPID：绑定支付的APPID（必须配置，开户邮件中可查看）
	 * 
	 * MCHID：商户号（必须配置，开户邮件中可查看）
	 * 
	 * KEY：商户支付密钥，参考开户邮件设置（必须配置，登录商户平台自行设置）
	 * 设置地址：https://pay.weixin.qq.com/index.php/account/api_cert
	 * 
	 * APPSECRET：公众帐号secert（仅JSAPI支付的时候需要配置， 登录公众平台，进入开发者中心可设置），
	 * 获取地址：https://mp.weixin.qq.com/advanced/advanced?action=dev&t=advanced/dev&token=2005451881&lang=zh_CN
	 * @var string
	 */
	const APPID = APPID_N;
	const MCHID = MCHID_N;
	const KEY = KEY_N;
	const APPSECRET = APPSECRET_N;

//    const APPID = 'wx13ebb5aefbcec527';
//    const MCHID = '1501215081';
//    const KEY = 'Wyhiaikeidkn09254689745435342545';
//    const APPSECRET = 'e658eb635c9a271bae64447769098de8';
	
	//=======【证书路径设置】=====================================
	/**
	 * TODO：设置商户证书路径
	 * 证书路径,注意应该填写绝对路径（仅退款、撤销订单时需要，可登录商户平台下载，
	 * API证书下载地址：https://pay.weixin.qq.com/index.php/account/api_cert，下载之前需要安装商户操作证书）
	 * @var path
	 */
	const SSLCERT_PATH = '../cert/apiclient_cert.pem';
	const SSLKEY_PATH = '../cert/apiclient_key.pem';
	
	//=======【curl代理设置】===================================
	/**
	 * TODO：这里设置代理机器，只有需要代理的时候才设置，不需要代理，请设置为0.0.0.0和0
	 * 本例程通过curl使用HTTP POST方法，此处可修改代理服务器，
	 * 默认CURL_PROXY_HOST=0.0.0.0和CURL_PROXY_PORT=0，此时不开启代理（如有需要才设置）
	 * @var unknown_type
	 */
	const CURL_PROXY_HOST = "0.0.0.0";//"10.152.18.220";
	const CURL_PROXY_PORT = 0;//8080;
	
	//=======【上报信息配置】===================================
	/**
	 * TODO：接口调用上报等级，默认紧错误上报（注意：上报超时间为【1s】，上报无论成败【永不抛出异常】，
	 * 不会影响接口调用流程），开启上报之后，方便微信监控请求调用的质量，建议至少
	 * 开启错误上报。
	 * 上报等级，0.关闭上报; 1.仅错误出错上报; 2.全量上报
	 * @var int
	 */
	const REPORT_LEVENL = 1;

//    public function __construct($config)
//    {
//        $this->APPID = $config['appid'];
//        $this->MCHID = $config['mchid'];
//        $this->KEY = $config['key'];
//        $this->APPSECRET = $config['appsecret'];
//    }


}
