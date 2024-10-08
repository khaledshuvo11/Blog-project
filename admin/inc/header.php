<?php
    include '../lib/Session.php';
    Session::checkSession();
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
    <title>Admin</title>
    <link rel="stylesheet" href="css/styleindex.css">
    <link rel="stylesheet" href="../output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script type="text/javascript" src="js/table/table.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
	<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
		    setSidebarHeight();
        });
    </script>
</head>
<body>

    <div class="bgimage clear mx-auto">
        <div class="header relative">
            <div class="logo absolute">
                <img class="w-[120px]" src="img/logo.png" alt="Logo">
            </div>
            <div class="float-start ml-5 text-gray-400 absolute top-[18%] left-[5%]">
                <h1 class="text-4xl font-semibold">Blog Website</h1>
                <p class="text-gray-400 font-semibold">Blog Website With PHP OOP</p>
            </div>
            <div class="float-end flex items-center w-[12%] h-full">
                <div class="float-start">
                    <img src="img/img-profile.jpg" alt="Profile Pic" /></div>
                    <?php
                        if (isset($_GET['action']) && $_GET['action'] == "logout") {
                            Session::destroy();
                        }
                    ?>
                <div class="ml-3 text-gray-400">
                    <ul class="inline-ul">
                        <li class="float-start pr-3 border-r border-solid">Hello <?php echo Session::get('username')?></li>
                        <li class="float-end ml-3"><a href="?action=logout">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="navbar mt-2">
            <ul class="nav main flex items-center h-12 font-semibold">
                <li class="ic-dashboard"><a href="index.php"><span>Dashboard</span></a> </li>
                <li class="ic-form-style"><a href="profile.php"><span>User Profile</span></a></li>
				<li class="ic-typography"><a href="changepassword.php"><span>Change Password</span></a></li>
				<li class="ic-grid-tables"><a href="inbox.php"><span>Inbox
                    <?php
                        $query = "select * from tbl_contact where status='0' order by id desc";
                        $msg = $db->select($query);
                        if ($msg) {
                            $count = mysqli_num_rows($msg);
                            echo "(".$count.")";
                        } else {
                            echo "(0)";
                        }
                    ?>
                </span></a></li>
                <?php if (Session::get('userRole') == '0') { ?>
                    <li class="ic-charts"><a href="adduser.php"><span>Add User</span></a></li>
                <?php } ?>
                <li class="ic-charts"><a href="userlist.php"><span>Userlist</span></a></li>
            </ul>
        </div>