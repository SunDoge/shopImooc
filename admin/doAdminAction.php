<?php
require_once '../include.php';
$act = $_REQUEST['act'];

switch ($act) {
	case 'logout':
		logout();
		break;
	
	case 'addAdmin':
		$mes = addAdmin();
		break;

	case 'editAdmin':
		$mes = editAdmin($_REQUEST['id']);
		break;

	case 'delAdmin':
		$mes = delAdmin($_REQUEST['id']);
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