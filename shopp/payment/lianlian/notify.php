<?
/**
* 
*/
class lianlian_pay 
{
	
	public $param, $order, $pay_time, $config;
	public $payment;
	public function __construct($config)
	{
		$this->config = $config;
		$data = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input"); 
		$data = json_decode($data, true);
		!empty($data) ?: ($data = $_POST); 
		$this->param = $data;

        logInfo('lianlian-data:'.json_encode($data));
		$this->pay_time = strtotime($data['trade_time']);
		$this->order = $data['order_no'];
        include_once('lianlianpay.php');
    }


	public function submit()
	{
		$pay = new lianlianspay_payment($this->config);

		$sign = $this->param['sign'];
		if(!$sign){
			exit('error1');
		}

        if($this->param['trade_status'] != 'SUCCESS'){
            exit('error2');
        }

        $valid_param = $this->param;
        unset($valid_param['sign']);
        unset($valid_param['sign_type']);
		if(!$pay->verifyReturn($valid_param, $sign)){
			exit('error3');
		}
		
		return true;

	}
}
?>