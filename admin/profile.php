<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
    $userid   = Session::get('userId');
    $userrole = Session::get('userRole');
?>
        <div class="dboard background mt-2 float-end w-[82%]">
            <div class="box overflow-hidden text-white">
                <h2 class="background font-semibold text-xl py-2 px-3">Update Profile</h2>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $name     = mysqli_real_escape_string($db->link, $_POST['name']);
                        $username = mysqli_real_escape_string($db->link, $_POST['username']);
                        $email    = mysqli_real_escape_string($db->link, $_POST['email']);
                        $details  = mysqli_real_escape_string($db->link, $_POST['details']);

                        $query = "UPDATE tbl_user
                                SET
                                name     = '$name',
                                username = '$username',
                                email    = '$email',
                                details  = '$details'
                                WHERE id = '$userid'";
                        $update_row = $db->update($query);
                        if ($update_row) {
                            echo "<span style='color: green; font-size: 18px; font-weight: 600; margin-left: 10px;'>User Data Updated Successfully !!.</span>";
                        } else {
                            echo "<span style='color: red; font-size: 18px; font-weight: 600;'>User Data Not Updated !!.</span>";
                        }
                    }
                ?>
                <div class="block p-3">
                    <?php
                        $query = "select * from tbl_user where id='$userid' AND role='$userrole'";
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
                                    <input type="text" name="name" value="<?php echo $result['name'] ?>" style="width: 50%;" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Username</label>
                                </td>
                                <td>
                                    <input type="text" name="username" value="<?php echo $result['username'] ?>" style="width: 50%;" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Email</label>
                                </td>
                                <td>
                                    <input type="text" name="email" value="<?php echo $result['email'] ?>" style="width: 50%;" />
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
                                    <input type="submit" name="submit" Value="Save" />
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