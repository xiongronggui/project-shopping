<?php
	function logInfo($data, $log_name = 'log.txt')
{
    file_put_contents($log_name, '-------------------' . PHP_EOL, FILE_APPEND);
    file_put_contents($log_name, date('Y-m-d H:i:s'/*, strtotime('+7 hours')*/) . PHP_EOL, FILE_APPEND);
    file_put_contents($log_name, json_encode($data) . PHP_EOL, FILE_APPEND);
    file_put_contents($log_name, '-------------------' . PHP_EOL, FILE_APPEND);
}
logInfo($_POST);
?>

	
	
