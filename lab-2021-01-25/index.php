<?php
header('Content-Type: text/html; charset=utf-8');
$db = json_decode(file_get_contents('./db.json'), true);

if (isset($_POST) && isset($_POST['name']) && isset($_POST['position'])) {
    if (isset($db) && isset($db['data'])) {
        $max_id = $db['data'][0]['id'];
        
        foreach ($db['data'] as $data) {
            if ($data['id'] > $max_id) {
                $max_id = $data['id'];
            }
        }
        
        array_push($db['data'], array(
            'id' => $max_id + 1,
            'name' => $_POST['name'],
            'position' => $_POST['position']
        ));
    } else {
        $db = array(
            'data' => array(
                array(
                    'id' => 1,
                    'name' => $_POST['name'],
                    'position' => $_POST['position']
                )
            )
        );
    }
    
    $fp = fopen('db.json', 'w');
    fwrite($fp, json_encode($db));
    fclose($fp);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="." method="post" enctype="multipart/form-data">
        <input type="text" name="name" required />
        <input type="text" name="position" required />
        <input type="submit" />
    </form>
    <?php if (isset($db) && isset($db['data'])) { ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Position</th>
        </tr>
        <?php foreach ($db['data'] as $data) { ?>
        <tr>
            <td><?php echo $data['id']?></td>
            <td><?php echo $data['name']?></td>
            <td><?php echo $data['position']?></td>
        </tr>
        <?php } ?>
    </table>
    <?php } ?>
</body>
</html>