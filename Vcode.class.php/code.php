<?php 

	session_start();                        //开启session
	include "./vcode.class.php";

	$vcode = new Vcode(80,25,4);

	$_SESSION['code'] = $vcode->getcode();			//将验证码放到服务器自己的空间存一份
	$vcode->outimg();								//将验证码图片输出