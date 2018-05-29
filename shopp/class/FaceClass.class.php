<?php
	class FaceClass
	{
        public function __construct()
        {
//            include '../include/common.php';
        }

        public function golden($uid,$paytime)
        {
            global $db;
            $sql = "SELECT order_id,paytime,goods FROM `goods_order` where uid = $uid and  order_status = 1 and paytime<$paytime";
            $result = $db->query($sql) or die($db->error());
            $rs = $db->fetch_array($result);
            if ($rs['order_id']){
                $res = [
                    'success' => 0,
                    'msg'     => '没有数据',
                    'data'    => []
                ];
            }else{
                
                $data['source'] =  SOURCE ;
                $data['website'] =  1;
                $data['medium'] =  '苹果金';
                $data['id_sum'] =  1;
                $data['time'] =  $paytime;
                $data['ident'] =  'vpiVOrCu2qPkKCKUziTfHWgKaTqHE21jRSwl8LwXcdA=';
                $res = [
                    'success' => 1,
                    'msg'     => '',
                    'data'    => $data
                ];
            }
            return $res;
        }

    }
?>