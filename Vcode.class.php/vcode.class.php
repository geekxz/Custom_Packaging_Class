<?php
// +----------------------------------------------------------------------
// | Chenjundong
// +----------------------------------------------------------------------
// | Copyright (c) 2016~20xx  All rights reserved.
// +----------------------------------------------------------------------
// | Author: Chenjundong <13298176895@163.com>
// +----------------------------------------------------------------------
	/** 
	 * file: vcode.class.php 类名为Vcode
	 * 验证码类。
	 */ 
	class Vcode
	{
		private $width;		 //验证码的宽度
		private $height;	 //验证码的长度
		private $num;		 //验证码的长度个数
		private $code;       //验证码
		private $img;		 //图像的资源
		/**
		 * 定义一个构造方法__construct()，实现属性的初始化
		 * @param int $width  验证码的宽度
		 * @param int $height  验证码的长度
		 * @param int $num  验证码的长度个数
		*/
		public function __construct($width=80,$height=25,$num=4){
			$this->width=$width;
			$this->height=$height;
			$this->num=$num;
			$this->code=$this->createcode();   //调用自己的方法
		}
		/**
			定义一个获取字符串的验证码，用于保存在服务器中的函数 getcode()
			@return mixed
		*/
		public function getcode(){
			return $this->code;
		}
		/**
		 * 定义一个输出验证码函数 outcode()
		 */
		public function outimg(){			
				$this->createback();		//创建背景（颜色 大小 边框）
			
				$this->outstring();			// 画验证码（画字 大小、字体颜色）
			
				$this->setdisturbcolor();	//设置干扰元素
			
				$this->printimg(); 			//输出图像
		}
		
		/**
		 *	定义一个创建背景的函数  createback()
		 */
		private function createback(){
			//创建资源
			$this->img = imagecreatetruecolor($this->width, $this->height);
			//设置随机的背景颜色
			$bgcolor =  imagecolorallocate($this->img, rand(225, 255), rand(225, 255), rand(225, 255)); 
			//设置背景填充
			imagefill($this->img, 0, 0, $bgcolor);
			//画边框=画矩形（注意边界溢出）
			$bordercolor =  imagecolorallocate($this->img, 0, 0, 0);
			imagerectangle($this->img, 0, 0, $this->width-1, $this->height-1, $bordercolor);
		}

		/**
		 *	定义一个画验证码（画字）的函数  outstring()
		 */
		private function outstring(){
			for($i=0; $i<$this->num;$i++){
				$color= imagecolorallocate($this->img, rand(0, 128), rand(0, 128), rand(0, 128)); 
				
				$fontsize=rand(3,5);  //字体大小

				$x = 3+($this->width/$this->num)*$i; //水平位置
				$y = rand(0, imagefontheight($fontsize)-5);

				//画出每个字符
				imagechar($this->img, $fontsize, $x, $y, $this->code{$i}, $color);
			}
		}

		/**
		 *	定义一个设置干扰元素的函数  setdisturbcolor()
		 */
		private function setdisturbcolor(){
			//加上点数
			for($i=0; $i<100; $i++) {
				$color= imagecolorallocate($this->img, rand(0, 255), rand(0, 255), rand(0, 255)); 
				imagesetpixel($this->img, rand(1, $this->width-2), rand(1, $this->height-2), $color);
			}

			//加线条
			for($i=0; $i<5; $i++) {
				$linecolor=imagecolorallocate($this->img,rand(0,255),rand(0,255),rand(0,255));
				imageline($this->img,rand(0,$this->width),rand(0,30),rand(0,$this->width),rand(0,40),$linecolor);
			}
		}

		/**
		 *	定义一个输出图像的函数  printimg()
		 */
		private function printimg(){
			if (imagetypes() & IMG_GIF) {
   				 header("Content-type: image/gif");
    				imagegif($this->img);
			} elseif (function_exists("imagejpeg")) {
   				 header("Content-type: image/jpeg");
   				 imagejpeg($this->img);
			} elseif (imagetypes() & IMG_PNG) {
   				 header("Content-type: image/png");
    				imagepng($this->img);
			}  else {
  				  die("No image support in this PHP server");
			} 		
		}

		/**
		 *	定义一个生成验证码字符串的函数  createcode()
		 */
		private function createcode(){
			$codes = "3456789abcdefghrjkmnpqrstuvwxyABCDEFGHRJKLMNPQRSTUVWXY";

			for($i=0;$i < $this->num;$i++){
				$code .= $codes{rand(0,strlen($codes)-1)};
			}
			return $code;
		}

		/**
		 *	定义一个自动销毁图片资源的函数 __destruct()
		 */
		public function __destruct(){
			imagedestroy($this->img);
		}
	}