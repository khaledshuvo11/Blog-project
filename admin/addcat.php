<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="dboard background mt-2 float-end w-[82%]">
            <div class="box text-white h-[410px]">
                <h2 class="background font-semibold text-xl py-2 px-3">Add New Category</h2>
               <div class="block p-5 copyblock"> 
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $name = $_POST['name'];
                        $name = mysqli_real_escape_string($db->link, $name);
                        
                        if (empty($name)) {
                            echo "<span style='color: red; font-size: 18px; font-weight: 600;'>Field Must Not Be Empty !!.</span>";
                        } else {
                            $query = "INSERT INTO tbl_category(name) VALUES('$name')";
                            $catinsert = $db->insert($query);
                            if ($catinsert) {
                                echo "<span style='color: green; font-size: 18px; font-weight: 600;'>Category Inserted Successfully !!.</span>";
                            } else {
                                echo "<span style='color: red; font-size: 18px; font-weight: 600;'>Category Not Inserted !!.</span>";
                            }
                        }
                    }
                ?>
                    <form action="" method="post">
                        <table class="form w-full">					
                            <tr>
                                <td>
                                    <input type="text" name="name" placeholder="Enter Category Name..." style="width: 100%;" />
                                </td>
                            </tr>
                            <tr> 
                                <td class="pt-3">
                                    <input type="submit" name="submit" Value="Save" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include 'inc/footer.php'; ?>