<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
    if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL) {
        echo "<script>window.location = 'inbox.php'; </script>";
    } else {
        $id = $_GET['msgid'];
    }
?>

        <div class="dboard background mt-2 float-end w-[82%]">
            <div class="box overflow-hidden text-white">
                <h2 class="background font-semibold text-xl py-2 px-3"">View Message</h2>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        echo "<script>window.location = 'inbox.php'; </script>";
                    }
                ?>
                <div class="block p-3">               
                    <form action="" method="post">
                    <?php
                        $query = "select * from tbl_contact where id='$id'";
                        $msg = $db->select($query);
                        if ($msg) {
                            while ($result = $msg->fetch_assoc()) {
                    ?>
                        <table class="form w-full">
                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['firstname'].' '.$result['lastname'] ?>" style="width: 50%;" />
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
                                <td>
                                    <label>Date</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $fm->formatDate($result['date'], 50) ?>" style="width: 50%;" />
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
                                    <input type="submit" name="submit" Value="OK" />
                                </td>
                            </tr>
                        </table>
                        <?php } } ?>
                    </form>
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