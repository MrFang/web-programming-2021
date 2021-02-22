<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

$conn = mysql_connect("localhost", "zolotukhin", "fn9k5dkF");
mysql_set_charset('utf8');
mysql_select_db('zolotukhin', $conn);

$table_name = 'lab_2021_02_01__users';

$allUsers = mysql_query("SELECT * FROM {$table_name}", $conn);

$result = [['ID', 'Name', 'Position']];

while ($row = mysql_fetch_array($allUsers)) {
    array_push($result, [$row['id'], $row['name'], $row['position']]);
}

mysql_free_result($allUsers);
mysql_close($conn);

echo json_encode(array('data' => $result));
?>