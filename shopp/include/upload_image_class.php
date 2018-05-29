<?php
class upload_image
{
   var $img_type, $img_name,$upfile;
   public  $img_size = 10000000;
   var $extention_list = array('image/jpg','image/jpeg','image/pjpeg','image/gif','image/png','image/x-png');
   var $datetime ;  //设置文件前缀
   var $dir  ;      //上传的目录
   var $ext_type;
   function up_image($img,$time ,$content_type)
   {
   	    $str = ''; 
   	    
   		$this->img_type = $img['type'];
   		$str .= $this->check_img_size($img);
        $str .= $this->check_img_type($img);
        $this->get_img_ext($img);
        $this->set_file_pre();
        $this->set_dir($time,$content_type);
        $str .= $this->upload_img($img);
        return $str;
   }
  
   
   function check_img_size($img)
   {
        if ($img['size'] > $this->img_size )
        return $this->error('上传的图片太大！');
  }
   function check_img_type($img)
   {
   		if(!in_array($img['type'],$this->extention_list))
   		{
   		 return	$this->error('上传的图片的格式只能为jpg,png,gif。');
   		}
   }

   function get_img_ext($img)
   {
      switch($img['type'])
      {
           case $this->extention_list[0]:
           {
           		$this->ext_type = '.jpg';
           		break;
           }
		   case $this->extention_list[1]:
           {
           		$this->ext_type = '.jpg';
           		break;
           }
		   case $this->extention_list[2]:
           {
           		$this->ext_type = '.jpg';
           		break;
           }
		   case $this->extention_list[3]:
           {
           		$this->ext_type = '.gif';
           		break;
           }
           case $this->extention_list[4]:
           {
           		$this->ext_type = '.png';
           		break;
           }
           case $this->extention_list[5]:
           {
           		$this->ext_type = '.png';
           		break;
           }
           break;
      }
   }

   function set_file_pre()
   {
   	$this->datetime = date("YmdHis",time()) . rand(1000,9999);
   }
   function  set_new_name()
   {
   	  $file_name = $this->datetime.$this->ext_type;
   	  return $file_name;
   }
   function get_dir_filename()
   {
   	  $filename = $this->dir .$this->set_new_name();
   	  //$filename = substr($filename,3); // 去掉../
   	  return $filename;
   	  
   }
   function upload_img($img)
   {
   	  $file = $this->get_dir_filename();
   	  
   	  if(!move_uploaded_file($img['tmp_name'],$file))
   	  {
   	      return   $this->error('上传失败！');
   	  }
   }
   function  set_dir($time,$content_type,$tag = 'images')
   {
	   	$dir = $content_type.'/'.date("Ymd",$time).'/' .$tag. "/";
	   	$dirNames = explode('/', $dir);
	  
	        for($i=0; $i<count($dirNames)-1; $i++) 
	        {
	            $temp .= $dirNames[$i].'/';
	            if (!is_dir($temp)) 
	            {
	                $oldmask = umask(0);
	                mkdir($temp, 0777);
	                umask($oldmask);
	            }
	        }
	   	 $this->dir = $dir;
	   	 return $this->dir;
   }
   function  get_dir($time,$content_type,$tag = 'images')
   {
   	 $dir = $content_type.'/'.date("Ymd",$time).'/' .$tag. "/";
   	 return $dir;
   }
   function error($msg)
   {
   	  return $msg;
   }
}
?>