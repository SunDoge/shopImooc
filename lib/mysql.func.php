<?php
function connect()
{
	//mysql_connect()
	try {
		$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET, DB_USER, DB_PWD);
		return $pdo;
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
	
}

function insert($table, $array)
{
	$key = join(",",array_keys($array));
	$vals = "'".join("','",array_values($array))."'";
	$sql = "insert {$table}($key) values({$vals})";
	$stmt = connect();
	return $stmt->exec($sql);
}

function update($table, $array, $where = null)
{
	foreach ($array as $key => $val) {
		if($str==null){
			$sep = "";
		}else{
			$sep = ",";
		}
		$str .= $sep.$key."='".$val."'";
	}
	$sql = "update {$table} set {$str} ".($where==null?null:"where ".$where);
	$stmt = connect();
	return $stmt->exec($sql);
}

function delete($table, $where=null)
{
	$where = $where==null?null:" where ".$where;
	$sql = "delete from {$table} {$where}";
	$stmt = connect();
 	return $stmt->exec($sql);
}

function fetchOne($sql, $result_type = PDO::FETCH_ASSOC)
{
	$stmt = connect();
	return $result = $stmt->query($sql,$result_type)->fetch();
}

function fetchAll($sql, $result_type = PDO::FETCH_ASSOC)
{
	$stmt = connect();
	return $result = $stmt->query($sql, $result_type)->fetchAll();
}

function getResultNum($sql)
{
	$stmt = connect();
	return $stmt->rowCount();
}