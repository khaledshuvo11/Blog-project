<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
    if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
        echo "<script>window.location = 'catlist.php'; </script>";
    } else {
        $id = $_GET['catid'];
    }
?>

        <div class="dboard background mt-2 float-end w-[82%]">
            <div class="box text-white h-[410px]">
                <h2 class="background font-semibold text-xl py-2 px-3">Update Category</h2>
               <div class="block p-5 copyblock"> 
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $name = $_POST['name'];
                        $name = mysqli_real_escape_string($db->link, $name);
                        
                        if (empty($name)) {
                            echo "<span style='color: red; font-size: 18px; font-weight: 600;'>Field Must Not Be Empty !!.</span>";
                        } else {
                            $query = "UPDATE tbl_category
                                    SET
                                    name = '$name'
                                    WHERE id = '$id'";

                            $updated_row = $db->update($query);
                            if ($updated_row) {
                                echo "<span style='color: green; font-size: 18px; font-weight: 600;'>Category Updated Successfully !!.</span>";
                            } else {
                                echo "<span style='color: red; font-size: 18px; font-weight: 600;'>Category Not Updated !!.</span>";
                            }
                        }
                    }
                ?>
                <?php
                    $query = "select * from tbl_category where id='$id' order by id desc";
                    $category = $db->select($query);
                    while ($result = $category->fetch_assoc()) {
                ?>
                    <form action="" method="post">
                        <table class="form w-full">					
                            <tr>
                                <td>
                                    <input type="text" name="name" value="<?php echo $result['name'] ?>" style="width: 100%;" />
                                </td>
                            </tr>
                            <tr> 
                                <td class="pt-3">
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

<?php include 'inc/footer.php'; ?>