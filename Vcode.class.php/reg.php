<?php 
	session_start();
	if(isset($_POST['dosubmit'])) {
		if(strtoupper($_SESSION['code']) == strtoupper($_POST['code']) ) {
			echo "输入成功!<br>";
		}else{
			echo "输入不对!<br>";
		}
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>封装验证码类</title>
</head>
<body>
	<form action="reg.php" method="post">
		username: <input type="text" name="username"><br><br>
		password: <input type="password" name="password"><br><br>
		code: <input type="text" size="4" name="code">
				 <img src="code.php" onclick="this.src='code.php?'+Math.random()"> <br><br>
				 看不清？<a href="#" id="change" class="link">换一张</a>
		<input type="submit" name="dosubmit" value="登录"><br><br>
	</form>
</body>
</html>