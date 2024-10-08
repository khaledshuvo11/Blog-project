<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="dboard background mt-2 float-end w-[82%]">
            <div class="box text-white h-[410px]">
                <h2 class="background font-semibold text-xl py-2 px-3">Update Social Media</h2>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $fb = $fm->validation($_POST['fb']);
                    $tw = $fm->validation($_POST['tw']);
                    $ln = $fm->validation($_POST['ln']);
                    $gp = $fm->validation($_POST['gp']);

                    $fb = mysqli_real_escape_string($db->link, $fb);
                    $tw = mysqli_real_escape_string($db->link, $tw);
                    $ln = mysqli_real_escape_string($db->link, $ln);
                    $gp = mysqli_real_escape_string($db->link, $gp);

                    if ($fb == "" || $tw == "" || $ln == "" || $gp == "") {
                        echo "<span style='color: red; font-size: 18px; font-weight: 600; margin-left: 10px;'>Field Must Not Be Empty !!.</span>";
                    } else {
                        $query = "UPDATE tbl_social
                                SET
                                fb = '$fb',
                                tw = '$tw',
                                ln = '$ln',
                                gp = '$gp'
                                WHERE id = '1'";
                        $update_row = $db->update($query);
                        if ($update_row) {
                            echo "<span style='color: green; font-size: 18px; font-weight: 600; margin-left: 10px;'>Data Updated Successfully !!.</span>";
                        } else {
                            echo "<span style='color: red; font-size: 18px; font-weight: 600;'>Data Not Updated !!.</span>";
                        }
                    }
                }    
                ?>
                <div class="block p-5">         
                <?php
                    $query = "select * from tbl_social where id='1'";
                    $social = $db->select($query);
                    if ($social) {
                        while ($result = $social->fetch_assoc()) {
                ?>      
                    <form action="social.php" method="post">
                        <table class="form w-full">					
                            <tr>
                                <td>
                                    <label class="font-semibold">Facebook</label>
                                </td>
                                <td>
                                    <input type="text" name="fb" value="<?php echo $result['fb'] ?>" style="width: 60%;" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="font-semibold">Twitter</label>
                                </td>
                                <td>
                                    <input type="text" name="tw" value="<?php echo $result['tw'] ?>" style="width: 60%;" />
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <label class="font-semibold">LinkedIn</label>
                                </td>
                                <td>
                                    <input type="text" name="ln" value="<?php echo $result['ln'] ?>" style="width: 60%;" />
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <label class="font-semibold">Google Plus</label>
                                </td>
                                <td>
                                    <input type="text" name="gp" value="<?php echo $result['gp'] ?>" style="width: 60%;" />
                                </td>
                            </tr>
                            
                            <tr>
                                <td></td>
                                <td class="pt-3">
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table>
                    </form>
                    <?php } } ?>
                </div>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>