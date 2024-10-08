<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<style>
.leftside {
    float: left;
    width: 70%;
}
.rightside {
    float: left;
    width: 20%;
}
.rightside img {
    height: 160px;
    width: 170px;
}
</style>
    
        <div class="dboard background mt-2 float-end w-[82%]">
            <div class="box h-[410px] clear text-white">
                <h2 class="background font-semibold text-xl py-2 px-3">Update Site Title and Description</h2>

                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $title  = $fm->validation($_POST['title']);
                    $slogan = $fm->validation($_POST['slogan']);

                    $title   = mysqli_real_escape_string($db->link, $title);
                    $slogan  = mysqli_real_escape_string($db->link, $slogan);

                    $permited  = array('png');
                    $file_name = $_FILES['logo']['name'];
                    $file_size = $_FILES['logo']['size'];
                    $file_temp = $_FILES['logo']['tmp_name'];

                    $div = explode('.', $file_name);
                    $file_ext = strtolower(end($div));
                    $same_image = 'logo'.'.'.$file_ext;
                    $uploaded_image = "upload/".$same_image;

                    if ($title == "" || $slogan == "") {
                        echo "<span style='color: red; font-size: 18px; font-weight: 600; margin-left: 10px;'>Field Must Not Be Empty !!.</span>";
                    } else {
                        if (!empty($file_name)) {
                            if ($file_size >1048567) {
                                echo "<span class='error'>Image Size should be less then 1MB! </span>";
                            } elseif (in_array($file_ext, $permited) === false) {
                                echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                            } else {
                                move_uploaded_file($file_temp, $uploaded_image);
                                $query = "UPDATE title_slogan
                                        SET
                                        title  = '$title',
                                        slogan   = '$slogan',
                                        logo  = '$uploaded_image'
                                        WHERE id = '1'";
                                $update_row = $db->update($query);
                                if ($update_row) {
                                    echo "<span style='color: green; font-size: 18px; font-weight: 600; margin-left: 10px;'>Data Updated Successfully !!.</span>";
                                } else {
                                    echo "<span style='color: red; font-size: 18px; font-weight: 600;'>Data Not Updated !!.</span>";
                                }
                            }
                        } else {
                            $query = "UPDATE title_slogan
                                        SET
                                        title  = '$title',
                                        slogan   = '$slogan'
                                        WHERE id = '1'";
                                $update_row = $db->update($query);
                                if ($update_row) {
                                    echo "<span style='color: green; font-size: 18px; font-weight: 600; margin-left: 10px;'>Data Updated Successfully !!.</span>";
                                } else {
                                    echo "<span style='color: red; font-size: 18px; font-weight: 600;'>Data Not Updated !!.</span>";
                                }
                            }
                        }
                    }
                ?>

                <?php
                    $query = "select * from title_slogan where id='1'";
                    $blog_title = $db->select($query);
                    if ($blog_title) {
                        while ($result = $blog_title->fetch_assoc()) {
                ?>
                <div class="block p-5">  
                    <div class="leftside">             
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form w-full">					
                            <tr>
                                <td>
                                    <label class="font-semibold">Website Title</label>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $result['title'] ?>"  name="title" style="width: 60%;" />
                                </td>
                            </tr>
                                <tr>
                                <td>
                                    <label class="font-semibold">Website Slogan</label>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $result['slogan'] ?>" name="slogan" style="width: 60%;" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="font-semibold">Upload Logo</label>
                                </td>
                                <td>
                                    <input type="file" name="logo" style="margin: 5px;" />
                                </td>
                            </tr>
                                <tr>
                                <td>
                                </td>
                                <td class="pt-3">
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table>
                        </form>
                    </div>
                    <div class="rightside">
                        <img src="<?php echo $result['logo'] ?>" alt="logo">
                    </div>
                </div>
                <?php } } ?>
            </div>
        </div>
    </div>    

<?php include 'inc/footer.php'; ?>