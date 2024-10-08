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
    <title>Login</title>
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
                    $username = $fm->validation($_POST['username']);
                    $password = $fm->validation(md5($_POST['password']));

                    $username = mysqli_real_escape_string($db->link, $username);
                    $password = mysqli_real_escape_string($db->link, $password);

                    $query = "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password'";
                    $result = $db->select($query);

                    if ($result != false) {
                        // $value = mysqli_fetch_array($result);
                        $value = $result->fetch_assoc();
                        Session::set("login", true);
                        Session::set("username", $value['username']);
                        Session::set("userId", $value['id']);
                        Session::set("userRole", $value['role']);
                        header("Location: index.php");
                    } else {
                        echo "<span style='color: red; font-size: 18px; font-weight: 600; position: absolute; top: 15%;'>Username Or Password Not Matched !!.</span>";
                    }
                }
            ?>
            <form action="login.php" method="post">
                <div class="login">
                    <h2>Login</h2>
                <div class="inputBx">
                    <input type="text" placeholder="Username" name="username">
                </div>
                <div class="inputBx">
                    <input type="password" placeholder="Password" name="password">
                </div>
                <div class="inputBx">
                    <input type="submit" value="Sign in">
                </div>
                <div class="links flex justify-center">
                    <a href="forgetpass.php">Forget Password !</a>
                    <!-- <a href="#">Signup</a> -->
                </div>
                </div>
            </form>
        </div>
    <!--ring div ends here-->
    
</body>
</html>