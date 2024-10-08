<?php include 'inc/header.php'; ?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fname = $fm->validation($_POST['firstname']);
        $lname = $fm->validation($_POST['lastname']);
        $email = $fm->validation($_POST['email']);
        $body  = $fm->validation($_POST['body']);

        $fname = mysqli_real_escape_string($db->link, $fname);
        $lname = mysqli_real_escape_string($db->link, $lname);
        $email = mysqli_real_escape_string($db->link, $email);
        $body  = mysqli_real_escape_string($db->link, $body);

        $errorf = "";
        $errorl = "";
        $errore = "";
        $errorb = "";
        if (empty($fname)) {
            $errorf = "First Name Must Not Be Empty !!.";
        }
        if (empty($lname)) {
            $errorl = "Last Name Must Not Be Empty !!.";
        }
        if (empty($email)) {
            $errore = "Email Field Must Not Be Empty !!.";
        }
        if (empty($body)) {
            $errorb = "Body Must Not Be Empty !!.";
        

        // if (empty($fname)) {
        //     $error = "First Name Must Not Be Empty !!.";
        // } elseif (empty($lname)) {
        //     $error = "Last Name Must Not Be Empty !!.";
        // } elseif (empty($email)) {
        //     $error = "Email Field Must Not Be Empty !!.";
        // } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //     $error = "Invalid Email Address !!.";
        // } elseif (empty($body)) {
        //     $error = "Message Field Must Not Be Empty !!.";
        } else {
            $query = "INSERT INTO tbl_contact(firstname, lastname, email, body) VALUES('$fname', '$lname', '$email', '$body')";
            $inserted_rows = $db->insert($query);
            if ($inserted_rows) {
                $msg = "Message Sent Successfully !!.";
            } else {
                $error = "Message Not Sent !!.";
            }
        }
    }
?>
<style>
    .cuserror {
        display: block;
        color: red;
}
</style>
    <div class="background clear mt-4 pb-5 relative">
        <div class="maincontent w-[65%] float-start p-4 ml-4 mt-4 border border-solid border-gray-500 clear">
            <div class="contact text-[#B0B0B0]">
                <h2 class="text-3xl text-white border-b border-gray-400 pb-4">Contact Us</h2>
                <?php
                    // if (isset($error)) {
                    //     echo "<span style='color: red;'>$error</span>";
                    // }
                    // if (isset($msg)) {
                    //     echo "<span style='color: green;'>$msg</span>";
                    // }
                ?>
                <form action="" method="post" style="margin-top: 35px;">
                    <table>
                        <tr>
                            <td>Your First Name:</td>
                            <td>
                            <?php  
                            if (isset($errorf)) {
                                echo "<span class='cuserror'>$errorf</span>";
                            }
                            ?>
                                <input type="text" name="firstname" placeholder="Enter Your First Name..."/>
                            </td>
                        </tr>
                        <tr>
                            <td>Your Last Name:</td>
                            <td>
                            <?php  
                            if (isset($errorl)) {
                                echo "<span class='cuserror'>$errorl</span>";
                            }
                            ?>
                                <input type="text" name="lastname" placeholder="Enter Your Last Name..."/>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Your Email Address:</td>
                            <td>
                            <?php  
                            if (isset($errore)) {
                                echo "<span class='cuserror'>$errore</span>";
                            }
                            ?>
                                <input type="text" name="email" placeholder="Enter Your Email Address..."/>
                            </td>
                        </tr>
                        <tr>
                            <td>Your Message:</td>
                            <td>
                            <?php  
                            if (isset($errorb)) {
                                echo "<span class='cuserror'>$errorb</span>";
                            }
                            ?>
                                <textarea name="body"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" value="Send"/>
                            </td>
                        </tr>
                    </table>
                <form>				
            </div>
        </div>
        <?php include 'inc/sidebar.php'; ?>
    </div>
    <?php include 'inc/footer.php'; ?>
             
</body>
</html>