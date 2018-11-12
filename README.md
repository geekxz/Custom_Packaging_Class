#   CustomClassPackaging(各种类的封装)
Custom class packaging
##  一、verify的使用简介
#### 1.引入

``use org\Verify;``（此路径只作为参考，需要根据自己的安放的路径引入）


#### 2.实例化使用

```
//验证码
public function checkVerify()
{
    $verify = new Verify();
    $verify->imageH = 32;
    $verify->imageW = 100;
    $verify->length = 4;
    $verify->useNoise = false;
    $verify->fontSize = 14;
    return $verify->entry();
    }      
```

#### 3.方法参数介绍

```
    /**
     * 输出验证码并把验证码的值保存的session中
     * 验证码保存到session的格式为： array('verify_code' => '验证码值', 'verify_time' => '验证码创建时间');
     * @access public
     * @param string $id 要生成验证码的标识
     * @return void
     */
    public function entry($id = '')
    {
        #自行查看verify的类，需要什么参数，自行根据需求调用
    }

```

##  二、文件上传类FileUpload的使用简介
#### 1.引入

``use org\FileUpload;``（此路径只作为参考，需要根据自己的安放的路径引入）

#### 2.实例化使用
```
$up = new FileUpload();
//设置属性(上传的位置， 大小， 类型， 名是是否要随机生成)
$up -> set("path", "./images/");
$up -> set("maxsize", 2000000);
$up -> set("allowtype", array("gif", "png", "jpg","jpeg"));
$up -> set("israndname", false);


//使用对象中的upload方法， 就可以上传文件， 方法需要传一个上传表单的名子 pic, 如果成功返回true, 失败返回false
if($up -> upload("pic")) {
	echo '<pre>';
	//获取上传后文件名子
	var_dump($up->getFileName());
	echo '</pre>';

} else {
	echo '<pre>';
	//获取上传失败以后的错误提示
	var_dump($up->getErrorMsg());
	echo '</pre>';
}
```

##  三、图像处理类Image的使用简介

#### 1.引入

``use org\Image;``（此路径只作为参考，需要根据自己的安放的路径引入）


#### 2.实例化使用(详细请参考Image.calss.php/test.php)
```
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

```

##  四、PDO操作数据库类PdoMySQL的使用简介


##  五、自定义MySQL操作数据库类Model的使用简介


##  六、字符串类String的使用简介


##  七、数组类Array的使用简介


##  八、日期时间类Date的使用简介


##  九、自定义Excel导入导出类Excel的使用简介


##  十、列表树生成工具类Tree的使用简介


## 十一、自定义转经纬度，经纬度转地址类Geohash的使用简介


## 十二、PHP阳历到农历转换的一个类Calendar的使用简介


## 十三、汉字转拼音的一个类PinYin的使用简介


## 十四、文件压缩类PHPZip的使用简介


## 十五、IP 地理位置查询类IpLocation的使用简介


