<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="dboard background mt-2 float-end w-[82%]">
            <div class="box overflow-hidden text-white">
                <h2 class="background font-semibold text-xl py-2 px-3"">Add New Page</h2>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $name  = mysqli_real_escape_string($db->link, $_POST['name']);
                        $body  = mysqli_real_escape_string($db->link, $_POST['body']);

                        if ($name == "" || $body == "") {
                            echo "<span style='color: red; font-size: 18px; font-weight: 600; margin-left: 10px;'>Field Must Not Be Empty !!.</span>";
                        } else {
                           $query = "INSERT INTO tbl_page(name, body) VALUES('$name', '$body')";
                           $inserted_rows = $db->insert($query);

                            if ($inserted_rows) {
                                echo "<span style='color: green; font-size: 18px; font-weight: 600; margin-left: 10px;'>Page Created Successfully !!.</span>";
                            } else {
                                echo "<span style='color: red; font-size: 18px; font-weight: 600;'>Page Not Created !!.</span>";
                            }
                        }
                    }
                ?>
                <div class="block p-3">               
                    <form action="" method="post">
                        <table class="form w-full">
                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" name="name" placeholder="Enter Post Title..." style="width: 50%;" />
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Content</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="body"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Create" />
                                </td>
                            </tr>
                        </table>
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