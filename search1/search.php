<?php
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_SERVER', 'localhost');
define('DB_NAME', 'hanc');


if (!$db = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME)) {
	die($db->connect_errno.' - '.$db->connect_error);
}

$arr = array();

if (!empty($_POST['keywords'])) {
	$keywords = $db->real_escape_string($_POST['keywords']);
	$sql = "SELECT * FROM items WHERE item_short LIKE '%".$keywords."%' ";
	$result = $db->query($sql) or die($mysqli->error);
	if ($result->num_rows > 0) {
		while ($obj = $result->fetch_object()) {
			$arr[] = array('item_name' => $obj->ID);
		}
	}
}
echo json_encode($arr);
