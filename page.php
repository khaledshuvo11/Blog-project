<?php include 'inc/header.php'; ?>
<?php
    if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
        header("Location: 404.php");
    } else {
        $id = $_GET['pageid'];
    }
?>

    <?php
        $pagequery = "select * from tbl_page where id='$id'";
        $pagedetails = $db->select($pagequery);
        if ($pagedetails) {
            while ($result = $pagedetails->fetch_assoc()) {
    ?>  
    <div class="background clear mt-4 pb-5 relative">
        <div class="maincontent p-4 ml-4 mt-4 border border-solid border-gray-500 w-[65%] float-start">
            <div class="about text-[#B0B0B0]">
                <h2 class="text-3xl text-white border-b border-gray-400 pb-4"><?php echo $result['name'] ?></h2>
                <p class="mt-5"><?php echo $result['body'] ?></p>
            </div>
        </div>
        <?php } } else { header("Location:404.php "); } ?>
        <?php include 'inc/sidebar.php'; ?>
    </div>
    <?php include 'inc/footer.php'; ?>
</div>
            
</body>
</html>