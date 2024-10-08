<?php include 'config/config.php'; ?>
<?php include 'lib/Database.php'; ?>
<?php include 'helpers/Format.php'; ?>

<?php
    $db = new Database();
    $fm = new Format();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        if (isset($_GET['pageid'])) {
            $posttitleid = $_GET['pageid'];
            $query = "select * from tbl_page where id='$posttitleid'";
            $pages = $db->select($query);
        if ($pages) {
            while ($result = $pages->fetch_assoc()) { ?>
                <title><?php echo $result['name'] ?> - <?php echo TITLE ?></title>
        <?php } } } elseif (isset($_GET['id'])) {
            $postid = $_GET['id'];
            $query = "select * from tbl_post where id='$postid'";
            $posts = $db->select($query);
        if ($posts) {
            while ($result = $posts->fetch_assoc()) { ?>
                <title><?php echo $result['title'] ?> - <?php echo TITLE ?></title>
        <?php } } } else { ?>
            <title><?php echo $fm->title() ?> - <?php echo TITLE ?></title>
        <?php } ?>
    <link rel="stylesheet" href="output.css">
    <link rel="stylesheet" href="loginbtn.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    
    <div class="header w-3/5 mx-auto">
        <section class="container grid grid-cols-1 md:grid-cols-2">
            <div class="logo text-white">
                <?php
                    $query = "select * from title_slogan where id='1'";
                    $blog_title = $db->select($query);
                    if ($blog_title) {
                        while ($result = $blog_title->fetch_assoc()) {
                ?>
                    <img src="admin/<?php echo $result['logo'] ?>" alt="Logo">
                    <h2 class="text-4xl mb-2 mt-6 font-semibold"><?php echo $result['title'] ?></h2>
                    <p class="text-xs font-semibold"><?php echo $result['slogan'] ?></p>
                <?php } } ?>
            </div>
            <div class="social clear text-end mt-3">
                <div class="icon clear">
                <?php
                    $query = "select * from tbl_social where id='1'";
                    $social = $db->select($query);
                    if ($social) {
                        while ($result = $social->fetch_assoc()) {
                ?>   
                    <a href="<?php echo $result['fb'] ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a href="<?php echo $result['tw'] ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                    <a href="<?php echo $result['ln'] ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                    <a href="<?php echo $result['gp'] ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
                <?php } } ?>    
                </div>
			<div class="searchbtn clear">
                <form action="search.php" method="get">
                    <input type="text" name="search" placeholder="Search keyword..."/>
                    <input type="submit" name="submit" value="Search"/>
                </form>
			</div>
		</div>
        </section>
        <div class="container text-white text-[13px]">
        <?php
            $path = $_SERVER['SCRIPT_FILENAME'];
            $currentpage = basename($path, '.php');
        ?>
            <ul class="bg-gradient-to-b from-gray-900 to-black uppercase p-[2px] flex">
                <li>
                    <a 
                    <?php
                        if ($currentpage == 'index') {
                            echo 'id="active"';
                        }
                    ?>
                    href="index.php">Home</a>
                </li>
                    <?php
                        $query = "select * from tbl_page";
                        $pages = $db->select($query);
                        if ($pages) {
                            while ($result = $pages->fetch_assoc()) {
                    ?>
                <li>
                    <a 
                    <?php 
                        if (isset($_GET['pageid']) && $_GET['pageid'] == $result['id']) {
                            echo 'id="active"';
                        }
                    ?>
                    href="page.php?pageid=<?php echo $result['id'] ?>"><?php echo $result['name'] ?></a>
                </li>
                    <?php } } ?>
                <li>
                    <a
                    <?php
                        if ($currentpage == 'contact') {
                            echo 'id="active"';
                        }
                    ?>
                    href="contact.php">Contact</a>
                </li>
            </ul>
        </div>