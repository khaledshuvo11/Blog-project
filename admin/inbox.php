<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="dboard background mt-2 float-end w-[82%]">
            <div class="box clear text-white">
                <h2 class="background font-semibold text-xl py-2 px-3" style="margin: 0;">Inbox</h2>
                <?php
                    if (isset($_GET['seenid'])) {
                        $seenid = $_GET['seenid'];
                        $query = "UPDATE tbl_contact
                                SET
                                status = '1'
                                WHERE id = '$seenid'";

                        $updated_row = $db->update($query);
                        if ($updated_row) {
                            echo "<span style='color: green; font-size: 18px; font-weight: 600; margin-left: 10px;'>Message Sent In The Seen Box !!.</span>";
                        } else {
                            echo "<span style='color: red; font-size: 18px; font-weight: 600;'>Something Went Wrong !!.</span>";
                        }
                    }
                ?>
                <div class="block p-3">        
                    <table class="data mx-auto clear-both w-full display datatable" id="example">
                        <thead>
                            <tr>
                                <th>Serial No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = "select * from tbl_contact where status='0' order by id desc";
                            $msg = $db->select($query);
                            if ($msg) {
                                $i=0;
                                while ($result = $msg->fetch_assoc()) {
                                    $i++;
                        ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i ?></td>
                                <td><?php echo $result['firstname'].' '.$result['lastname'] ?></td>
                                <td><?php echo $result['email'] ?></td>
                                <td><?php echo $fm->textShorten($result['body'], 50) ?></td>
                                <td><?php echo $fm->formatDate($result['date']) ?></td>
                                <td>
                                    <a href="viewmsg.php?msgid=<?php echo $result['id'] ?>">View</a> || 
                                    <a href="replymsg.php?msgid=<?php echo $result['id'] ?>">Reply</a> ||
                                    <a onclick="return confirm('Are You Sure To Move This Message')" href="?seenid=<?php echo $result['id'] ?>">Seen</a>
                                </td>
                            </tr>
                            <?php } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box clear text-white">
                <h2 class="background font-semibold text-xl py-2 px-3" style="margin: 0;">Seen Message</h2>
                <?php
                    if (isset($_GET['delid'])) {
                        $delid = $_GET['delid'];
                        $delquery = "delete from tbl_contact where id='$delid'";
                        $deldata  = $db->delete($delquery);

                        if ($deldata) {
                            echo "<span style='color: green; font-size: 18px; font-weight: 600; margin-left: 10px;'>Message Deleted Successfully !!.</span>";
                        } else {
                            echo "<span style='color: red; font-size: 18px; font-weight: 600;'>Message Not Deleted !!.</span>";
                        }
                    }
                ?>
                <div class="block p-3">        
                <table class="data mx-auto clear-both w-full display datatable" id="example">
                        <thead>
                            <tr>
                                <th>Serial No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = "select * from tbl_contact where status='1' order by id desc";
                            $msg = $db->select($query);
                            if ($msg) {
                                $i=0;
                                while ($result = $msg->fetch_assoc()) {
                                    $i++;
                        ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i ?></td>
                                <td><?php echo $result['firstname'].' '.$result['lastname'] ?></td>
                                <td><?php echo $result['email'] ?></td>
                                <td><?php echo $fm->textShorten($result['body'], 50) ?></td>
                                <td><?php echo $fm->formatDate($result['date']) ?></td>
                                <td>
                                <a href="viewmsg.php?msgid=<?php echo $result['id'] ?>">View</a> || 
                                    <a onclick="return confirm('Are You Sure To Delete')" href="?delid=<?php echo $result['id'] ?>">Delete</a>
                                </td>
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