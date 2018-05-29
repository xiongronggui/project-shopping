<?
/**
* 
*/
class lianlian_submit 
{
	
	public $param, $config;
	public function __construct($param,$config)
	{
		$this->param = $param;
		$this->config = $config;
		include_once('lianlianpay.php');
	}

	public function submit()
	{
		$payment = new lianlianpay_payment($this->config);
		$tt = date('Y').date('m').date('d').date('H').date('i').date('s');
		$risk_item = array(
					"frms_ware_category"=>4003,
					"user_info_mercht_userno" => param['uid'],
					"user_info_dt_register" => $tt,
					"user_info_bind_phone" => '13532520511',
					"delivery_addr_province" => '340000',
					"delivery_addr_city" => '341600',
					"delivery_phone" => $rs['mobile'],
					"logistics_mode" => '3',
					"delivery_cycle" => '24h',
					"goods_count" => 1
			);
		$argparam = array("version"=>$this->config['version'],
			"oid_partner"=>$this->config['mid'], 
			"sign_type"=>$this->config['sign_type'],
			"userreq_ip"=>"" ,
			"id_type"=>"0" ,
			"valid_order"=> "10080","user_id"=>"22222222" ,
			"timestamp"=> $tt, "busi_partner"=>"109001" ,"no_order"=>$this->param['order_id'],"dt_order"=> $tt ,
			"name_goods"=>$this->param['goods'],"info_order"=>"" ,
			"money_order"=>$this->param['total'],"notify_url"=>$this->config['notify_url'],
			"url_return"=> "http://www.lbjfsm.com/framework/www/lllib/return_url.php" ,"url_order"=> "" ,"bank_code"=> "" ,
			"pay_type"=> "" ,"no_agree"=> "" ,"shareing_data"=>"", "id_no"=> "" ,
			"acct_name"=>"" ,"flag_modify"=>"1" ,"card_no"=>"" ,"back_url"=>"",
			"risk_item" => $risk_item);

	}
}
?>