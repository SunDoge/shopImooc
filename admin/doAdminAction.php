<?php
require_once '../include.php';
$act = $_REQUEST['act'];
$id = $_REQUEST['id'];
/*
if($act == "logout"){
	logout();
}elseif ($act == "addAdmin") {
	$mes = addAdmin();
}
*/
switch ($act) {
	case 'logout':
		logout();
		break;
	
	case 'addAdmin':
		$mes = addAdmin();
		break;

	case 'editAdmin':
		$mes = editAdmin();
		break;	
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	if($mes){
		echo $mes;
	}
?>
</body>
</html>