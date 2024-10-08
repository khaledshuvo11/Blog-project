<?php include 'inc/header.php'; ?>

<?php
    if (!isset($_GET['id']) || $_GET['id'] == NULL) {
        header("Location: 404.php");
    } else {
        $id = $_GET['id'];
    }
?>

    <div class="background clear mt-4 pb-5 relative">
        <div class="maincontent clear p-4 ml-4 mt-4 border border-solid border-gray-500 w-[65%] float-start">
            <div class="post text-[#B0B0B0] text-justify">
                <?php
                    $query = "select * from tbl_post where id=$id";
                    $post = $db->select($query);
                    if ($post) {
                        while ($result = $post->fetch_assoc()) {
                ?>
                    <h2 class="text-2xl text-white hover:text-[#FEA10C] border-b-2 border-slate-400 mb-1 pb-2">
                        <a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a>
                    </h2>
                    <h4 class="text-[#FEA10C] py-2"><?php echo $fm->formatDate($result['date']); ?>, By 
                        <a href="#" class="text-sky-500 no-underline"><?php echo $result['author']; ?></a>
                    </h4>
                    <img src="admin/<?php echo $result['image']?>" class="w-[200px] p-1 mr-2 border border-gray-400 border-solid float-start" alt="post image"/>
                    <p class="text-justify">
                        <?php echo $result['body']; ?>
                    </p>
                
                <div class="relatedpost clear">
                    <h2 class="text-white text-2xl bg-gradient-to-b from-gray-900 to-black mb-3 mt-7 p-2">Related articles</h2>
                    <?php
                        $catid = $result['cat'];
                        $queryrelated = "select * from tbl_post where cat='$catid' order by rand() limit 6";
                        $relatedpost = $db->select($queryrelated);
                        if ($relatedpost) {
                            while ($rresult = $relatedpost->fetch_assoc()) {
                    ?>
                    <a href="post.php?id=<?php echo $rresult['id']; ?>"><img src="admin/<?php echo $rresult['image']?>" alt="post image"/></a>
                    <?php } } else { echo "No Related Post Available !!";} ?>
                </div>
                <?php } } else { header("Location:404.php "); } ?>
            </div>
        </div>
        <?php include 'inc/sidebar.php'; ?>
    </div>
    <?php include 'inc/footer.php'; ?>
            
</body>
</html>