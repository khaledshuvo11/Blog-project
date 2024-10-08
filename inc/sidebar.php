<div class="sidebar float-end p-3 w-[340px] mr-4 mt-4">
    <div class="categories text-[#B0B0B0]">
        <h2 class="p-2 text-white text-xl bg-gradient-to-b from-gray-900 to-black mb-2">Categories</h2>
        <ul>
            <?php
                $query = "select * from tbl_category";
                $category = $db->select($query);
                if ($category) {
                    while ($result = $category->fetch_assoc()) {
            ?>
            <li class="py-1 border-b border-dashed">
                <a href="posts.php?category=<?php echo $result['id'] ?>"><?php echo $result['name'] ?></a>
            </li>
            <?php } } else { ?>
            <li class="py-1 border-b border-dashed">No category Created</li>
            <?php } ?>
        </ul>
    </div>
    <div class="categories text-[#B0B0B0]">
        <h2 class="p-2 text-white text-xl bg-gradient-to-b from-gray-900 to-black mt-4 mb-2">Latest Articles</h2>
        <?php
            $query = "select * from tbl_post limit 5";
            $post = $db->select($query);
            if ($post) {
                while ($result = $post->fetch_assoc()) {
        ?>
        <div class="popular clear">
            <h3 class="pb-2 text-xl border-b border-dashed">
                <a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a>
            </h3>
            <a href="#">
                <img src="admin/<?php echo $result['image']?>" class="w-[200px] p-1 mr-2 border border-gray-400 border-solid float-start" alt="post image"/>
            </a>
            <p class="text-justify">
                <?php echo $fm->textShorten($result['body'], 110); ?>
            </p>	
        </div>
        <?php } } else { header("Location:404.php "); } ?>
    </div>
</div>