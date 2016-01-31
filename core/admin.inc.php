<?php
function checkAdmin($sql)
{
	return fetchOne($sql);
}

function checkLogined()
{
	if(empty($_SESSION['adminId'])&&empty($_COOKIE['adminId'])){
		alertMes("请先登录","login.php");
	}
}

function logout()
{
	$_SESSION = array();
	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(),"",time()-1);
	}
	if(isset($_COOKIE['adminId'])){
		setcookie("adminId","",time()-1);
	}
	if(isset($_COOKIE["adminName"])){
		setcookie("adminName","",time()-1);
	}
	session_destroy();
	header("location:login.php");
}

function addAdmin()
{
	$arr = $_POST;
	$arr['password'] = md5($_POST['password']);
	if(insert("imooc_admin",$arr)){
		$mes = "添加成功！<br/><a href='addAdmin.php'>继续添加</a>|<a href='listAdmin.php'>查看管理员列表</a>";
	}else{
		$mes = "添加失败！<br/><a href='addAdmin.php'>重新添加</a>";
	}
	return $mes;
}