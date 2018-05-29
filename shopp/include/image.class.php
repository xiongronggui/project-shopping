<?php
class Image {
	var $attachinfo = '';
	var $srcfile = '';
	var $targetfile = '';
	var $imagecreatefromfunc = '';
	var $imagefunc = '';
	var $attach = array();
	var $animatedgif = 0;             

	function Image($srcfile, $targetfile, $attach = array()) {

		$this->srcfile = $srcfile;
		$this->targetfile = $targetfile;
		$this->attach = $attach;
		$this->attachinfo = @getimagesize($targetfile);

			switch($this->attachinfo['mime']) {
				case 'image/jpeg':
					$this->imagecreatefromfunc = function_exists('imagecreatefromjpeg') ? 'imagecreatefromjpeg' : '';
					$this->imagefunc = function_exists('imagejpeg') ? 'imagejpeg' : '';
					break;
				case 'image/gif':
					$this->imagecreatefromfunc = function_exists('imagecreatefromgif') ? 'imagecreatefromgif' : '';
					$this->imagefunc = function_exists('imagegif') ? 'imagegif' : '';
					break;
				case 'image/png':
					$this->imagecreatefromfunc = function_exists('imagecreatefrompng') ? 'imagecreatefrompng' : '';
					$this->imagefunc = function_exists('imagepng') ? 'imagepng' : '';
					break;
			}


		$this->attach['size'] = empty($this->attach['size']) ? @filesize($targetfile) : $this->attach['size'];
		if($this->attachinfo['mime'] == 'image/gif') {
			$fp = fopen($targetfile, 'rb');
			$targetfilecontent = fread($fp, $this->attach['size']);
			fclose($fp);

		}
	}


function Thumb_GD($thumbwidth, $thumbheight, $preview = 0) {
		if( function_exists('imagecreatetruecolor') && function_exists('imagecopyresampled') && function_exists('imagejpeg')) {
			$imagecreatefromfunc = $this->imagecreatefromfunc;
			$imagefunc =  $this->imagefunc;
			list($img_w, $img_h) = $this->attachinfo;

			if( $img_w >= $thumbwidth || $img_h >= $thumbheight) {


					$attach_photo = $imagecreatefromfunc($this->targetfile);

					$x_ratio = $thumbwidth / $img_w;
					$y_ratio = $thumbheight / $img_h;

					if(($x_ratio * $img_h) < $thumbheight) {
						$thumb['height'] = ceil($x_ratio * $img_h);
						$thumb['width'] = $thumbwidth;
					} else {
						$thumb['width'] = ceil($y_ratio * $img_w);
						$thumb['height'] = $thumbheight;
					}

					$targetfile  = $this->targetfile ;
					$cx = $img_w;
					$cy = $img_h;
				} else {
					$attach_photo = $imagecreatefromfunc($this->targetfile);

					$imgratio = $img_w / $img_h;
					$thumbratio = $thumbwidth / $thumbheight;

					if($imgratio >= 1 && $imgratio >= $thumbratio || $imgratio < 1 && $imgratio > $thumbratio) {
						$cuty = $img_h;
						$cutx = $cuty * $thumbratio;
					} elseif($imgratio >= 1 && $imgratio <= $thumbratio || $imgratio < 1 && $imgratio < $thumbratio) {
						$cutx = $img_w;               
						$cuty = $cutx / $thumbratio;  
					}

					$dst_photo = imagecreatetruecolor($cutx, $cuty);
					imageCopyMerge($dst_photo, $attach_photo, 0, 0, 0, 0, $cutx, $cuty, 100);

					$thumb['width'] = $thumbwidth;
					$thumb['height'] = $thumbheight;

					$targetfile =  $this->targetfile ;
					$cx = $cutx;
					$cy = $cuty;
				}

				$thumb_photo = imagecreatetruecolor($thumb['width'], $thumb['height']);
				imageCopyreSampled($thumb_photo, $attach_photo ,0, 0, 0, 0, $thumb['width'], $thumb['height'], $cx, $cy);
				clearstatcache();

				$imagefunc($thumb_photo, $targetfile);
			}
		}
}
?>