<?php
require_once '../include.php';
$sql = "select * from imooc_admin";
$totalRows = getResultNum($sql);
//var_dump($totalRows);
$pageSize = 2;
$totalPage = ceil($totalRows/$pageSize);
$page = $_REQUEST['page']?(int)$_REQUEST['page']:1;
if($page<1|$page==null|!is_numeric($page)){
	$page = 1;
}elseif($page>=$totalPage){
	$page = $totalPage;
}
$offset = ($page-1)*$pageSize;
$sql = "select * from imooc_admin limit {$offset},{$pageSize}";
$rows = fetch_All($sql);
print_r($rows);
$url = $_SERVER['PHP_SELF'];
$index
$p = "";
for($i=1;$i<=$totalPage;$i++){
	if($page==$i){
		$p.="[{$i}]";
	}else{
		$p.="<a href='{$url}?page={$i}'>[{$i}]</a>";
	}
}
echo $p;