<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="dboard background mt-2 float-end w-[82%]">
            <div class="box text-white h-[410px]">
                <h2 class="background font-semibold text-xl py-2 px-3">Update Copyright Text</h2>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $note = $fm->validation($_POST['note']);
                    $note = mysqli_real_escape_string($db->link, $note);
                    if ($note == "") {
                        echo "<span style='color: red; font-size: 18px; font-weight: 600; margin-left: 10px;'>Field Must Not Be Empty !!.</span>";
                    } else {
                        $query = "UPDATE tbl_footer
                                SET
                                note = '$note'
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
                <div class="block p-5 copyblock"> 
                <?php
                    $query = "select * from tbl_footer where id='1'";
                    $footernote = $db->select($query);
                    if ($footernote) {
                        while ($result = $footernote->fetch_assoc()) {
                ?> 
                 <form action="copyright.php" method="post">
                    <table class="form w-full">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['note'] ?>" name="note" style="width: 100%;" />
                            </td>
                        </tr>
						
						 <tr> 
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