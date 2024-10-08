<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>
        
    <div class="background clear pb-5 relative text-[#B0B0B0]">
        <div class="maincontent p-4 ml-4 mt-4 border border-solid border-gray-500 w-[65%] float-start">
            <!-- Pagination -->
             <?php
                $per_page = 3;
                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                } else {
                    $page = 1;
                }
                $start_form = ($page-1) * $per_page;
             ?>
            <!-- Pagination -->
            <?php
                $query = "select * from tbl_post limit $start_form, $per_page";
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
                        <a href="#"><img src="admin/<?php echo $result['image']?>" class="w-[175px] p-1 mr-2 border border-gray-400 border-solid float-start" alt="post image"/></a>
                        <p class="text-justify">
                            <?php echo $fm->textShorten($result['body']); ?>
                        </p>
                    <div class="readmore float-end mr-2 p-2 text-white hover:text-gray-500 border border-white border-solid">
                        <a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
                    </div>
                </div>
                <?php } ?><!--End While Loop-->
                <!-- Pagination -->
                <?php 
                $query = "select * from tbl_post";
                $result = $db->select($query);
                $total_rows = mysqli_num_rows($result);
                $total_pages = ceil($total_rows/$per_page);

                echo "<span class='pagination'><a href='index.php?page=1'>".'First Page'."</a>"; 
                    for ($i=1; $i <= $total_pages; $i++) { 
                        echo "<a href='index.php?page=".$i."'>".$i."</a>";
                    }
                echo "<a href='index.php?page=$total_pages'>".'Last Page'."</a></span>" ?>
                <!-- Pagination -->
            <?php } else { header("Location:404.php "); } ?>
            </div>
        <?php include 'inc/sidebar.php'; ?>
    </div>
    <?php include 'inc/footer.php'; ?>
</div>
            
</body>
</html>