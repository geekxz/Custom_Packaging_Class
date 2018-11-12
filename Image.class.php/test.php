<?php
	//包含这个类image.class.php
	include "image.class.php";

	$img = new Image("./images");
/*
	echo $img->thumb("dx.jpg", 1000, 1000, "th1_")."<br>";
	echo $img->thumb("dx.jpg", 800, 800, "th2_")."<br>";
	echo $img->thumb("dx.jpg", 600, 600, "th3_")."<br>";
	echo $img->thumb("dx.jpg", 400, 400, "th4_")."<br>";
	echo $img->thumb("dx.jpg", 300, 300, "th5_")."<br>";
	echo $img->thumb("dx.jpg", 200, 200, "th6_")."<br>";
	echo $img->thumb("dx.jpg", 100, 100, "th7_")."<br>";
	echo $img->thumb("dx.jpg", 50, 50, "th8_")."<br>";
 */

	// echo $img->watermark("dx.jpg", "php.gif", 0, "wa0_")."<br>";	
	// echo $img->watermark("dx.jpg", "php.gif", 1, "wa1_")."<br>";	
	// echo $img->watermark("dx.jpg", "php.gif", 2, "wa2_")."<br>";	
	// echo $img->watermark("dx.jpg", "php.gif", 3, "wa3_")."<br>";	
	// echo $img->watermark("dx.jpg", "php.gif", 4, "wa4_")."<br>";	
	// echo $img->watermark("dx.jpg", "php.gif", 5, "wa5_")."<br>";	
	// echo $img->watermark("dx.jpg", "php.gif", 6, "wa6_")."<br>";	
	// echo $img->watermark("dx.jpg", "php.gif", 7, "wa7_")."<br>";	
	// echo $img->watermark("dx.jpg", "php.gif", 8, "wa8_")."<br>";	
	// echo $img->watermark("dx.jpg", "php.gif", 9, "wa9_")."<br>";	
 	

	//  122   104   104  108
	echo $img->cut("cx.png", 122, 104, 104, 108); 
