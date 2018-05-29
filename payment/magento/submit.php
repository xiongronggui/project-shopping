<?php
class magentopay_submit
{
	public $param, $config;

    public function __construct($param, $config)
    {
        $this->param = $param;
        $this->config = $config;
    }

    public function submit()
    {
    	$args = array(
    			'userid' => $this->param['uid'],
    			'email' => 'sxgcsy@xs.com',
    			'body' => '随机',
    			'website' => '801',
    			'amount' => $this->param['total'],
    			'spbill_create' => '127.0.0.1',
    			'orderid' => $this->param['order_id'],
    			'payment' => '',
    			'notifyurl' => '',
    			'returnulr' => '',
    			'time_expire' => '',
    			'fee_type' => '',
    			'sign' => ''
			);

    }
}
?>