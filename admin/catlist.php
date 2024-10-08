<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="dboard background mt-2 float-end w-[82%]">
            <div class="box h-[540px] clear text-white">
                <h2 class="background font-semibold text-xl py-2 px-3" style="margin: 0;">Category List</h2>
                <?php
                    if (isset($_GET['delcat'])) {
                        $delid = $_GET['delcat'];
                        $delquery = "delete from tbl_category where id='$delid'";
                        $deldata  = $db->delete($delquery);

                        if ($deldata) {
                            echo "<span style='color: green; font-size: 18px; font-weight: 600; margin-left: 10px;'>Category Deleted Successfully !!.</span>";
                        } else {
                            echo "<span style='color: red; font-size: 18px; font-weight: 600;'>Category Not Deleted !!.</span>";
                        }
                    }
                ?>
                <div class="block p-3">        
                    <table class="data mx-auto clear-both w-full display data datatable" id="example">
                        <thead>
                            <tr>
                                <th>Serial No.</th>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = "select * from tbl_category order by id desc";
                                $category = $db->select($query);
                                if ($category) {
                                    $i=0;
                                    while ($result = $category->fetch_assoc()) {
                                        $i++;
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['name'] ?></td>
                                <td><a href="editcat.php?catid=<?php echo $result['id'] ?>">Edit</a> || <a onclick="return confirm('Are You Sure To Delete')" href="?delcat=<?php echo $result['id'] ?>">Delete</a></td>
                            </tr>
                            <?php } } ?>
                        </tbody>
				    </table>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();

    });
</script>

<?php include 'inc/footer.php'; ?>