<table class="table table-bordered m-2">
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