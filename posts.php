<?php include 'inc/header.php'; ?>

<?php
    if (!isset($_GET['category']) || $_GET['category'] == NULL) {
        header("Location: 404.php");
    } else {
        $id = $_GET['category'];
    }
?>
        
    <div class="background clear pb-5 relative text-[#B0B0B0]">
        <div class="maincontent p-4 ml-4 mt-4 border border-solid border-gray-500 w-[65%] float-start">
        <?php
            $query = "select * from tbl_post where cat='$id'";
            $post = $db->select($query);
            if ($post) {
                while ($result = $post->fetch_assoc()) {
        ?>
            <div class="samepost no-underline">
                <h2 class="text-2xl text-white hover:text-[#FEA10C] border-b-2 border-slate-400 mb-1 pb-2">
                    <a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a>
                </h2>
                <h4 class="text-[#FEA10C] py-2"><?php echo $fm->formatDate($result['date']); ?>, By 
                    <a href="#" class="text-sky-500 no-underline"><?php echo $result['author']; ?></a>
                </h4>
                    <a href="#"><img src="admin/<?php echo $result['image']?>" class="w-[200px] p-1 mr-2 border border-gray-400 border-solid float-start" alt="post image"/></a>
                    <p class="text-justify">
                        <?php echo $fm->textShorten($result['body']); ?>
                    </p>
                <div class="readmore float-end mr-2 p-2 text-white hover:text-gray-500 border border-white border-solid">
                    <a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
                </div>
            </div>
            <?php } } else { ?>
                <p>No Post Available In This Category !!.</p>
            <?php } ?>
        </div>
        <?php include 'inc/sidebar.php'; ?>
    </div>
    <?php include 'inc/footer.php'; ?>
</div>
            
</body>
</html>