<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="dboard background mt-2 float-end w-[82%]">
            <div class="box h-[540px] clear text-white">
                <h2 class="background font-semibold text-xl py-2 px-3" style="margin: 0;">Category List</h2>
                <?php
                    if (isset($_GET['deluser'])) {
                        $deluser = $_GET['deluser'];
                        $delquery = "delete from tbl_user where id='$deluser'";
                        $deldata  = $db->delete($delquery);

                        if ($deldata) {
                            echo "<span style='color: green; font-size: 18px; font-weight: 600; margin-left: 10px;'>User Deleted Successfully !!.</span>";
                        } else {
                            echo "<span style='color: red; font-size: 18px; font-weight: 600;'>User Not Deleted !!.</span>";
                        }
                    }
                ?>
                <div class="block p-3">        
                    <table class="data mx-auto clear-both w-full display data datatable" id="example">
                        <thead>
                            <tr>
                                <th>Serial No.</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Details</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = "select * from tbl_user order by id desc";
                                $alluser = $db->select($query);
                                if ($alluser) {
                                    $i=0;
                                    while ($result = $alluser->fetch_assoc()) {
                                        $i++;
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['name'] ?></td>
                                <td><?php echo $result['username'] ?></td>
                                <td><?php echo $result['email'] ?></td>
                                <td><?php echo $fm->textShorten($result['details'], 30) ?></td>
                                <td>
                                    <?php 
                                        if ($result['role'] == '0') {
                                            echo "Admin";
                                        }  elseif ($result['role'] == '1') {
                                            echo "Author";
                                        } elseif ($result['role'] == '2') {
                                            echo "Editor";
                                        }
                                    ?>
                                </td>
                                <td><a href="viewuser.php?userid=<?php echo $result['id'] ?>">View</a> 
                                <?php if (Session::get('userRole') == '0') { ?>
                                ||   <a onclick="return confirm('Are You Sure To Delete')" href="?deluser=<?php echo $result['id'] ?>">Delete</a></td>
                                <
                                <?php } ?>    
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