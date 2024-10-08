<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
    if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
        echo "<script>window.location = 'index.php'; </script>";
    } else {
        $id = $_GET['pageid'];
    }
?>
<style>
    .actiondel {
        margin-left: 10px;
    }
    .actiondel a {
        border: 1px solid #ddd;
        color: #cfcdcd;
        cursor: pointer;
        font-size: 18px;
        padding: 8px 16px;
    }
    .actiondel a:hover {
        color: black;
        background: white;
    }
</style>
        <div class="dboard background mt-2 float-end w-[82%]">
            <div class="box overflow-hidden text-white">
                <h2 class="background font-semibold text-xl py-2 px-3">Edit Page</h2>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $name  = mysqli_real_escape_string($db->link, $_POST['name']);
                        $body  = mysqli_real_escape_string($db->link, $_POST['body']);

                        if ($name == "" || $body == "") {
                            echo "<span style='color: red; font-size: 18px; font-weight: 600; margin-left: 10px;'>Field Must Not Be Empty !!.</span>";
                        } else {
                            $query = "UPDATE tbl_page
                                    SET
                                    name = '$name',
                                    body = '$body'
                                    WHERE id = '$id'";
                            $updated_row = $db->update($query);

                            if ($updated_row) {
                                echo "<span style='color: green; font-size: 18px; font-weight: 600; margin-left: 10px;'>Page Updated Successfully !!.</span>";
                            } else {
                                echo "<span style='color: red; font-size: 18px; font-weight: 600;'>Page Not Updated !!.</span>";
                            }
                        }
                    }
                ?>
                <div class="block p-3">     
                <?php
                    $pagequery = "select * from tbl_page where id='$id'";
                    $pagedetails = $db->select($pagequery);
                    if ($pagedetails) {
                        while ($result = $pagedetails->fetch_assoc()) {
                ?>          
                    <form action="" method="post">
                        <table class="form w-full">
                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" name="name" value="<?php echo $result['name'] ?>" style="width: 50%;" />
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Content</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="body">
                                        <?php echo $result['body'] ?>
                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                    <span class="actiondel"><a onclick="return confirm('Are You Sure To Delete The Page')" href="deletepage.php?delpage=<?php echo $result['id'] ?>">Delete</a></span>
                                </td>
                            </tr>
                        </table>
                    </form>
                <?php } } ?>
                </div>
            </div>
        </div>
    </div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>