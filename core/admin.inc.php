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

function getAllAdmin()
{
	$sql = "select * from imooc_admin";
	$rows = fetch_All($sql);
	return $rows;
}

function getAdminByPage($page, $pageSize = 2)
{
	$sql = "select * from imooc_admin";
	global $totalPage,$totalRows;
	$totalRows = getResultNum($sql);
	//var_dump($totalRows);	
	$totalPage = ceil($totalRows/$pageSize);
	//$pageSize=2;
	
	if($page<1||$page==null||!is_numeric($page)){
	  $page=1;
	}
	if($page>=$totalPage)$page=$totalPage;
	$offset = ($page-1)*$pageSize;
	$sql = "select id,username,email from imooc_admin limit {$offset},{$pageSize}";
	return $rows = fetch_All($sql);
}

function editAdmin($id)
{
	$arr = $_POST;
	$arr['password'] = md5($_POST['password']);
	if(update("imooc_admin", $arr, "id={$id}")){
		$mes = "编辑成功<br><a href='listAdmin.php'>查看管理员列表</a>";
	}else{
		$mes = "编辑失败<br><a href='listAdmin.php'>请重新修改</a>";
	}
	return $mes;
}

function delAdmin($id)
{
	if(delete("imooc_admin", "id={$id}")){
		$mes = "删除成功!<br><a href='listAdmin.php'>查看管理员列表</a>";
	}else{
		$mes = "删除失败<br><a href='listAdmin.php'>请重新删除</a>";
	}
	return $mes;
}