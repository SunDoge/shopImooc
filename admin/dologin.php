<?php
require_once '../include.php';
$username = $_POST['username'];
$password = md5($_POST['password']);
$verify   = $_POST['verify'];
$verify1  = $_SESSION['verify'];
if(empty($_POST['autoFlag'])){
	$autoFlag = 0;
}else{
	$autoFlag = $_POST['autoFlag'];
}

if($verify == $verify1){
	$sql = "select * from imooc_admin where username='{$username}' and password='{$password}'";
	$row = checkAdmin($sql);
	//print_r($res);
	if($row){
		if($autoFlag){
			setcookie("adminId", $row['id'], time()+7*24*3600);
			setcookie("adminName", $row['username'], time()+7*24*3600);
		}
		$_SESSION['adminName'] = $row['username'];
		$_SESSION['adminId'] = $row['id'];
		alertMes("登录成功","index.php");
	}else{
		alertMes("登录失败","login.php");
	}
}else{
	alertMes("验证码错误","login.php");
}