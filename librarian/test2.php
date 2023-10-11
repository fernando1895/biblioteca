<?php
	require "../db_connect.php";
	require "../message_display.php";
	require "verify_librarian.php";
	require "header_librarian.php";
?>
<form name="frmSearch" method="post" action="">
    <div>
        <p>
            <input type="text" placeholder="Name" name="search[name]"
                value="<?php echo $name; ?>" /> <input type="text"
                placeholder="Code" name="search[code]"
                value="<?php echo $code; ?>" /> <input type="submit"
                name="go" class="btnSearch" value="Search"> <input
                type="reset" class="btnReset" value="Reset"
                onclick="window.location='index.php'">
        </p>
    </div>
    <div>
        <a class="font-bold float-right" href="add.php">Add New</a>
    </div>
    <table class="stripped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Code</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock Count</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
                    <?php
                    if (! empty($result)) {
                        foreach ($result as $key => $value) {
                            if (is_numeric($key)) {
                                ?>
                     <tr>
                <td><?php echo $result[$key]['name']; ?></td>
                <td><?php echo $result[$key]['code']; ?></td>
                <td><?php echo $result[$key]['category']; ?></td>
                <td><?php echo $result[$key]['price']; ?></td>
                <td><?php echo$result[$key]['stock_count']; ?></td>
                <td><a class="mr-20"
                    href="edit.php?id=<?php echo $result[$key]["id"]; ?>">Edit</a>
                    <a
                    href="delete.php?action=delete&id=<?php echo $result[$key]["id"]; ?>">Delete</a>
                </td>
            </tr>
                    <?php
                            }
                        }
                    }
                    if (isset($result["perpage"])) {
                        ?>
                        <tr>
                <td colspan="6" align=right> <?php echo $result["perpage"]; ?></td>
            </tr>
                    <?php } ?>
                    </tbody>
    </table>
</form>