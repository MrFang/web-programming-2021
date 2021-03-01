<?php
require __DIR__ . '/vendor/autoload.php';

$smarty = new Smarty();

$smarty->template_dir = __DIR__ . '/templates/';
$smarty->compile_dir  = __DIR__ . '/templates_c/';
$smarty->config_dir   = __DIR__ . '/configs/';
$smarty->cache_dir    = __DIR__ . '/cache/';

header('Content-Type: text/html; charset=utf-8');

$conn = mysql_connect("localhost", "zolotukhin", "fn9k5dkF");
mysql_set_charset('utf8');
mysql_select_db('zolotukhin', $conn);

$table_name = 'lab_2021_02_01__users';
$editPage = false;
$editUser = null;
$URL = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$allUsers = [];

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
    $editUser = mysql_fetch_array(mysql_query("SELECT * FROM {$table_name} WHERE id = {$_GET['id']}", $conn));
}

$allUsersQuery = mysql_query("SELECT * FROM {$table_name}", $conn);

while ($user = mysql_fetch_array($allUsersQuery)) {
  array_push($allUsers, $user);
}

$smarty->assign('editPage', $editPage);
$smarty->assign('editUser', $editUser);
$smarty->assign('URL', $URL);
$smarty->assign('allUsers', $allUsers);


$smarty->display('bootstrapPage.tpl');

mysql_free_result($allUsersQuery);
mysql_close($conn);
