<?php
    include '../lib/Session.php';
    Session::checkLogin();
?>
<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/Format.php'; ?>

<?php
    $db = new Database();
    $fm = new Format();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery</title>
    <link rel="stylesheet" href="css/stylelogin.css">
</head>
<body>

    <!--ring div starts here-->
        <div class="ring">
            <i style="--clr:#00ff0a;"></i>
            <i style="--clr:#ff0057;"></i>
            <i style="--clr:#fffd44;"></i>
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $email = $fm->validation($_POST['email']);
                    $email = mysqli_real_escape_string($db->link, $email);

                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        echo "<span style='color: red; font-size: 18px; font-weight: 600; position: absolute; top: 15%;'>Invalid Email Address !!.</span>";
                    } else {
                    $mailquery = "select * from tbl_user where email='$email' limit 1";
                    $mailcheck = $db->select($mailquery);

                    if ($mailcheck != false) {
                       while ($value = $mailcheck->fetch_assoc()) {
                            $userid   = $value['id'];
                            $username = $value['username'];
                       }
                    $text = substr($email, 0, 3);
                    $rand = rand(10000, 99999);
                    $newpass = "$text$rand";
                    $password = md5($newpass);
                    $updatequery = "UPDATE tbl_user
                            SET
                            password = '$password'
                            WHERE id = '$userid'";
                    $updated_row = $db->update($updatequery);   

                    $to = "$email";
                    $from = "shuvovai641@gmail.com";
                    $headers = "From: $from\n";
                    $headers .= 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $subject = "Your Password";
                    $message = "Your Password Is ".$username." And Password Is ".$newpass." Please Visit Website To Login";

                    $sendmail = mail($to, $subject, $message, $headers);
                    if ($sendmail) {
                        echo "<span style='color: green; font-size: 18px; font-weight: 600; position: absolute; top: 15%;'>Please Check Your Email For New Password !!.</span>";
                    } else {
                        echo "<span style='color: red; font-size: 18px; font-weight: 600; position: absolute; top: 15%;'>Email Not Sent !!.</span>";
                    } 
                    
                    } else {
                        echo "<span style='color: red; font-size: 18px; font-weight: 600; position: absolute; top: 15%;'>Email Not Exist !!.</span>";
                    }
                }
            }
            ?>
            <form action="" method="post">
                <div class="login">
                    <h2>Password Recovery</h2>
                <div class="inputBx">
                    <input type="text" placeholder="Enter Valid Email..." name="email">
                </div>
                <div class="inputBx">
                    <input type="submit" value="Send Mail">
                </div>
                <div class="links flex justify-center">
                    <a href="login.php">Login !</a>
                    <!-- <a href="#">Signup</a> -->
                </div>
                </div>
            </form>
        </div>
    <!--ring div ends here-->
    
</body>
</html>