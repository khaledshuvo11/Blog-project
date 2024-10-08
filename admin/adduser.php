<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 
if (!Session::get('userRole') == '0') { 
    echo "<script>window.location = 'index.php'; </script>";
}
?>
        <div class="dboard background mt-2 float-end w-[82%]">
            <div class="box text-white clear pb-8">
                <h2 class="background font-semibold text-xl py-2 px-3">Add New Category</h2>
               <div class="block p-5 copyblock"> 
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $username = $fm->validation($_POST['username']);
                        $password = $fm->validation(md5($_POST['password']));
                        $email     = $fm->validation($_POST['email']); 
                        $role     = $fm->validation($_POST['role']); 

                        $username = mysqli_real_escape_string($db->link, $username);
                        $password = mysqli_real_escape_string($db->link, $password);
                        $email    = mysqli_real_escape_string($db->link, $email);
                        $role     = mysqli_real_escape_string($db->link, $role);
                        if (empty($username) || empty($password) || empty($email) || empty($role)) {
                            echo "<span style='color: red; font-size: 18px; font-weight: 600;'>Field Must Not Be Empty !!.</span>";
                        } else {
                            $mailquery = "select * from tbl_user where email='$email' limit 1";
                            $mailcheck = $db->select($mailquery);
                        if ($mailcheck != false) {
                            echo "<span style='color: red; font-size: 18px; font-weight: 600;'>Email Already Exist !!.</span>";
                        } else {
                            $query = "INSERT INTO tbl_user(username, password, email, role) VALUES('$username', '$password','$email', '$role')";
                            $catinsert = $db->insert($query);
                            if ($catinsert) {
                                echo "<span style='color: green; font-size: 18px; font-weight: 600;'>User Created Successfully !!.</span>";
                            } else {
                                echo "<span style='color: red; font-size: 18px; font-weight: 600;'>User Not Created !!.</span>";
                            }
                        }   
                    }
                }
                ?>
                    <form action="" method="post">
                        <table class="form w-full">					
                            <tr>
                                <td>
                                    <label for="">Username</label>
                                </td>
                                <td>
                                    <input type="text" name="username" placeholder="Enter Username..." style="width: 100%;" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="">Password</label>
                                </td>
                                <td>
                                    <input type="text" name="password" placeholder="Enter Password..." style="width: 100%;" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="">Email</label>
                                </td>
                                <td>
                                    <input type="text" name="email" placeholder="Enter Valid Email Address..." style="width: 100%;" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="">User Role</label>
                                </td>
                                <td>
                                    <select name="role" id="select">
                                        <option>Select User Role</option>
                                        <option value="0">Admin</option>
                                        <option value="1">Author</option>
                                        <option value="2">Editor</option>
                                    </select>
                                </td>
                            </tr>
                            <tr> 
                                <td></td>
                                <td class="pt-3">
                                    <input type="submit" name="submit" Value="Create" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include 'inc/footer.php'; ?>