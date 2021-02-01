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
            "position = '{$_POST['position']}'",
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if ($editPage && !is_null($user)) { ?>
        <form action=<?php echo '"'.$URL."?edit=".'"' ?> method="post" enctype="multipart/form-data">
            <input type="number" name="id" value=<?php echo '"'.$user['id'].'"' ?> readonly />
            <input type="text" name="name" value=<?php echo '"'.$user['name'].'"' ?> required />
            <input type="text" name="position" value=<?php echo '"'.$user['position'].'"' ?> required />
            <input type="submit" />
        </form>
    <?php } else { ?>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="name" required />
            <input type="text" name="position" required />
            <input type="submit" />
        </form>
    <?php } ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Position</th>
            <th></th>
            <th></th>
        </tr>
        <?php while ($row = mysql_fetch_array($allUsers)) { ?>
        <tr>
            <td><?php echo $row['id']?></td>
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['position']?></td>
            <td><a href=<?php echo '"'.$URL."?edit=&id={$row['id']}".'"' ?>>Edit<a></td>
            <td><a href=<?php echo '"'.$URL."?delete=&id={$row['id']}".'"' ?>>Delete<a></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php
mysql_free_result($allUsers);
mysql_close($conn);
?>