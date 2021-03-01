<form action=<?php echo '"'.$URL."?edit=".'"' ?> method="post" enctype="multipart/form-data">
    <div class="form-group m-2">
        <label>ID</label>
        <input class="form-control" type="number" name="id" value=<?php echo '"'.$user['id'].'"' ?> readonly />
    </div>
    <div class="form-group m-2">
        <label>Name</label>
        <input class="form-control" type="text" name="name" value=<?php echo '"'.$user['name'].'"' ?> required />
    </div>
    <div class="form-group m-2">
        <label>Position</label>
        <input class="form-control" type="text" name="position" value=<?php echo '"'.$user['position'].'"' ?> required />
    </div>
    <button type="submit" class="btn btn-primary m-2">Submit</button>
</form>