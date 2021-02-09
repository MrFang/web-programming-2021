<?php
header('Content-Type: text/html; charset=utf-8');

$conn = mysql_connect("localhost", "zolotukhin", "fn9k5dkF");
mysql_set_charset('utf8');
mysql_select_db('zolotukhin', $conn);

$table_name = 'lab_2021_02_01__users';
$editPage = false;
$user = null;
$URL = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

if (isset($_POST) && isset($_POST['name']) && isset($_POST['position'])) {
    if (isset($_GET['edit']) && isset($_POST['id'])) {
        mysql_query(
            "UPDATE {$table_name} SET ".
            "name = '{$_POST['name']}', ".
            "position = '{$_POST['position']}' ".
            "WHERE id={$_POST['id']}",
            $conn
        );
    } else {
        mysql_query(
            "INSERT INTO {$table_name} (name, position) ".
            "VALUES ('{$_POST['name']}', '{$_POST['position']}')",
            $conn
        );
    }
} else if (isset($_GET['edit']) && isset($_GET['id'])) {
    $editPage = true;
} else if (isset($_GET['delete']) && isset($_GET['id'])) {
    mysql_query("DELETE FROM {$table_name} WHERE id = {$_GET['id']}", $conn);
}

if ($editPage) {
    $user = mysql_fetch_array(mysql_query("SELECT * FROM {$table_name} WHERE id = {$_GET['id']}", $conn));
}

$allUsers = mysql_query("SELECT * FROM {$table_name}", $conn);

include 'templates/bootstrapPage.php';

mysql_free_result($allUsers);
mysql_close($conn);
?>