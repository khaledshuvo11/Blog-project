<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
    if (!isset($_GET['editpostid']) || $_GET['editpostid'] == NULL) {
        echo "<script>window.location = 'postlist.php'; </script>";
    } else {
        $postid = $_GET['editpostid'];
    }
?>
        <div class="dboard background mt-2 float-end w-[82%]">
            <div class="box overflow-hidden text-white">
                <h2 class="background font-semibold text-xl py-2 px-3"">Update Post</h2>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $cat  = mysqli_real_escape_string($db->link, $_POST['cat']);
                        $title  = mysqli_real_escape_string($db->link, $_POST['title']);
                        $body   = mysqli_real_escape_string($db->link, $_POST['body']);
                        $tags   = mysqli_real_escape_string($db->link, $_POST['tags']);
                        $author = mysqli_real_escape_string($db->link, $_POST['author']);
                        $userid = mysqli_real_escape_string($db->link, $_POST['userid']);

                        $permited  = array('jpg', 'jpeg', 'png', 'gif');
                        $file_name = $_FILES['image']['name'];
                        $file_size = $_FILES['image']['size'];
                        $file_temp = $_FILES['image']['tmp_name'];

                        $div = explode('.', $file_name);
                        $file_ext = strtolower(end($div));
                        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                        $uploaded_image = "upload/".$unique_image;

                        if ($cat == "" || $title == "" || $body == "" || $tags == "" || $author == "") {
                            echo "<span style='color: red; font-size: 18px; font-weight: 600; margin-left: 10px;'>Field Must Not Be Empty !!.</span>";
                        } else {
                            if (!empty($file_name)) {
                                if ($file_size >1048567) {
                                    echo "<span class='error'>Image Size should be less then 1MB! </span>";
                                } elseif (in_array($file_ext, $permited) === false) {
                                    echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                                } else {
                                    move_uploaded_file($file_temp, $uploaded_image);
                                    $query = "UPDATE tbl_post
                                            SET
                                            cat    = '$cat',
                                            title  = '$title',
                                            body   = '$body',
                                            image  = '$uploaded_image',
                                            tags   = '$tags',
                                            author = '$author',
                                            userid = '$userid'
                                            WHERE id = '$postid'";
                                    $update_row = $db->update($query);
                                    if ($update_row) {
                                        echo "<span style='color: green; font-size: 18px; font-weight: 600; margin-left: 10px;'>Category Updated Successfully !!.</span>";
                                    } else {
                                        echo "<span style='color: red; font-size: 18px; font-weight: 600;'>Category Not Updated !!.</span>";
                                    }
                                }
                            } else {
                                $query = "UPDATE tbl_post
                                            SET
                                            cat    = '$cat',
                                            title  = '$title',
                                            body   = '$body',
                                            tags   = '$tags',
                                            author = '$author',
                                            userid = '$userid'
                                            WHERE id = '$postid'";
                                    $update_row = $db->update($query);
                                    if ($update_row) {
                                        echo "<span style='color: green; font-size: 18px; font-weight: 600; margin-left: 10px;'>Category Updated Successfully !!.</span>";
                                    } else {
                                        echo "<span style='color: red; font-size: 18px; font-weight: 600;'>Category Not Updated !!.</span>";
                                    }
                                }
                            }
                        }
                ?>
                <div class="block p-3">
                    <?php
                        $query = "select * from tbl_post where id='$postid' order by id desc";
                        $getpost = $db->select($query);
                        while ($postresult = $getpost->fetch_assoc()) {
                    ?>           
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form w-full">
                            <tr>
                                <td>
                                    <label>Title</label>
                                </td>
                                <td>
                                    <input type="text" name="title" value="<?php echo $postresult['title'] ?>" style="width: 50%;" />
                                </td>
                            </tr>
                        
                            <tr>
                                <td>
                                    <label>Category</label>
                                </td>
                                <td>
                                    <select id="select" name="cat">
                                        <option>Select Category</option>
                                    <?php
                                        $query = "select * from tbl_category";
                                        $category = $db->select($query);

                                        if ($category) {
                                            while ($result = $category->fetch_assoc()) {
                                    ?>
                                    <option 
                                        <?php 
                                            if ($postresult['cat'] == $result['id']) { ?>
                                                selected="selected"
                                        <?php } ?>    value="<?php echo $result['id']?>"><?php echo $result['name'] ?>
                                    </option>
                                    <?php } } ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Upload Image</label>
                                </td>
                                <td>
                                    <img src="<?php echo $postresult['image'] ?>" height="50px" width="100px" style="margin-left: 5px;" alt="">
                                    <input type="file" name="image" style="margin: 5px;" />
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Content</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="body">
                                        <?php echo $postresult['body'] ?>
                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Tags</label>
                                </td>
                                <td>
                                    <input type="text" name="tags" value="<?php echo $postresult['tags'] ?>" style="width: 50%;" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Author</label>
                                </td>
                                <td>
                                    <input type="text" name="author" value="<?php echo $postresult['author'] ?>" style="width: 50%;" />
                                    <input type="hidden" name="userid" value="<?php echo Session::get('userId')?>" style="width: 50%;" />
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
                    <?php } ?>
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