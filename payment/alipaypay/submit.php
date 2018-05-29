<?php
class alipaypay_submit
{
	public $param, $config;
	public function __construct($param,$config)
	{
		$this->param = $param;
		$this->config = $config;
	}

	public function submit()
	{
		$params = array(
			'WIDout_trade_no' => $this->param['order_id'],
			'WIDsubject' => '商品',//$this->param['goods'],
			'WIDtotal_amount' => $this->param['total']/100,
			'WIDbody' => '',
			'appid' => $this->config['app_id']
		);


		echo '<!DOCTYPE html>'."\n";
        echo '<html>'."\n";
        echo '<head>'."\n\t";
        echo '<meta charset="utf-8" />'."\n\t";
        echo '<title>付款中</title>'."\n";
        echo '</head>'."\n<body>\n";
        echo '<form action="'.$this->config['payurl'].'" method="post" id="webform">';
        foreach ($params as $name => $value){
            echo '<input type="hidden" name="'.$name.'" value="'.$value.'"/>';
        }
        echo '</form>';
        echo '<script type="text/javascript">document.getElementById(\'webform\').submit();</script>';
        echo "\n".'</body>'."\n</html>";
        exit;
	}
}
?>