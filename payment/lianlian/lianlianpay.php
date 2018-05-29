<?
/**
* 
*/
class lianlianpay_payment
{
	
	private $_config;

	function __construct($_lianlianconfig)
	{
		$this->_config = $_lianlianconfig;
	}

	/**
	 * 针对return_url验证消息是否是连连支付发出的合法消息
	 * @return 验证结果
	 */
	function verifyReturn($data = []) {
		if (empty($data)) { //判断数组是否为空
			return false;
		} else {
			//首先对获得的商户号进行比对
			if (trim($data['oid_partner' ]) != $this->_config['oid_partner']) {
				//商户号错误
				return false;
			}

			//生成签名结果
			$parameter = array (
				'oid_partner' => $data['oid_partner' ],
				'sign_type' => $data['sign_type'],
				'dt_order' => $data['dt_order' ],
				'no_order' =>  $data['no_order' ],
				'oid_paybill' => $data['oid_paybill' ],
				'money_order' => $data['money_order' ],
				'result_pay' =>  $data['result_pay'],
				'settle_date' => $data['settle_date'],
				'info_order' =>$data['info_order'],
				'pay_type'=>$data['pay_type'],
				'bank_code'=>$data['bank_code'],
			);

			if (!$this->getSignVeryfy($parameter, trim($data['sign' ]))) {
				return false;
			}
			return true;

		}
	}

	/**
	 * 获取返回时的签名验证结果
	 * @param $para_temp 通知返回来的参数数组
	 * @param $sign 返回的签名结果
	 * @return 签名验证结果
	 */
	function getSignVeryfy($para_temp, $sign) {
		//除去待签名参数数组中的空值和签名参数
		
		$para_filter = paraFilter($para_temp);
		//对待签名参数数组排序
		$para_sort = argSort($para_filter);

		//把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
		$prestr = createLinkstring($para_sort);
		logInfo('lianlian-本地原串:'.$prestr);
		//$prestr = 'dt_order=20180301092053&money_order=0.1&no_order=P2018030188G002&oid_partner=201710250001059760&oid_paybill=2018030169612388&pay_type=1&result_pay=SUCCESS&settle_date=20180301&sign_type=RSA';
		//$sign = "ceddUATUyyl0dHUR4Eq8zisKJX49CL40gvxPau4ehPYLKHSVaqKLZeP9bZxag7b4jfFjTq2GGpelYKFzb3PNLOlo7tlkWrIXVsOX0OZ6qtSsUB/smlo9bvByLy6tj////iyey3G08MdguvHIM90VsfdFGkfd9qWye/t8SFxGlW8=";
		//$private_content = file_get_contents('llpay_public_key.pem');
		//$prestr = Rsasign($prestr,trim($private_content));
		$isSgin = false;
		switch (strtoupper(trim($this->_config['sign_type']))) {
			case "MD5" :
				$isSgin = md5Verify($prestr, $sign, $this->_config['key']);
				break;
			case "RSA": $isSgin = $this->Rsaverify($prestr,$sign); 
				break;
			default :
				$isSgin = true;
		}

		return $isSgin;
	}

	function Rsaverify($data, $sign)  {
		//读取连连支付公钥文件
		$pubKey = file_get_contents(dirname(__FILE__).'/key/'.$this->_config['oid_partner'].'/privateKey.pem');

		//转换为openssl格式密钥
		$res = openssl_get_publickey($pubKey);

		//调用openssl内置方法验签，返回bool值
		$result = (bool)openssl_verify($data, base64_decode($sign), $res,OPENSSL_ALGO_MD5);
		
		//释放资源
		openssl_free_key($res);

		//返回资源是否成功
		return $result;
	}
}
?>