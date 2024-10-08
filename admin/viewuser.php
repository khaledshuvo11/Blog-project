<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
    if (!isset($_GET['userid']) || $_GET['userid'] == NULL) {
        echo "<script>window.location = 'userlist.php'; </script>";
    } else {
        $id = $_GET['userid'];
    }
?>
        <div class="dboard background mt-2 float-end w-[82%]">
            <div class="box overflow-hidden text-white">
                <h2 class="background font-semibold text-xl py-2 px-3">User Details</h2>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        echo "<script>window.location = 'userlist.php'; </script>";
                    }
                ?>
                <div class="block p-3">
                    <?php
                        $query = "select * from tbl_user where id='$id'";
                        $getuser = $db->select($query);
                        if ($getuser) {
                            while ($result = $getuser->fetch_assoc()) {
                    ?>           
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form w-full">
                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['name'] ?>" style="width: 50%;" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Username</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['username'] ?>" style="width: 50%;" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Email</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['email'] ?>" style="width: 50%;" />
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Details</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="details">
                                        <?php echo $result['details'] ?>
                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Ok" />
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