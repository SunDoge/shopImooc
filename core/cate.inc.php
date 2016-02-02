<?php

function addCate()
{
	$arr = $_POST;
	if(insert('imooc_cate',$arr)){
		$mes = "分类添加成功！<br/><a href='addCate.php'>继续添加</a>|<a href='listCate.php'>查看分类</a>";
	}else{
		$mes = "分类添加失败！<br/><a href='addCate.php'>重新添加</a>|<a href='listCate.php'>查看分类</a>";
	}
	return $mes;
}

function delCate($id)
{
	if(delete("imooc_cate", "id={$id}")){
		$mes = "删除成功!<br><a href='listCate.php'>查看分类列表</a>";
	}else{
		$mes = "删除失败<br><a href='listCate.php'>请重新删除</a>";
	}
	return $mes;
}

function editCate($id)
{
	$arr = $_POST;
	if(update("imooc_cate", $arr, "id={$id}")){
		$mes = "编辑成功<br><a href='listCate.php'>查看分类列表</a>";
	}else{
		$mes = "编辑失败<br><a href='listCate.php'>请重新修改</a>";
	}
	return $mes;
}

function getCateById($id)
{
	$sql = "select * from imooc_cate where id={$id}";
	return fetchOne($sql);
}