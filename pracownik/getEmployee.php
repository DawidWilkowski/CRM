<?php
include_once("dbConn.php");
ini_set('display_errors', 1);
if ($_REQUEST['idz']) {
	$sql = "SELECT post_klienta FROM posty
WHERE idz='" . $_REQUEST['idz'] . "'";
	$resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
	$data = array();
	while ($rows = mysqli_fetch_assoc($resultset)) {
		$data = $rows;
	}
	echo json_encode($data);
} else {
	echo 0;
}
