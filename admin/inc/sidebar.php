<div class="leftmenu mt-2 float-start">
    <div class="sidenav">
        <ul class="menu">
            <li><button class="menuitem active font-semibold dropdown-btn">Site Option
            <i class="fa fa-caret-down"></i>
            </button>
                <ul class="activesubmenu">
                    <li><a href="titleslogan.php">Title & Slogan</a></li>
                    <li><a href="social.php">Social Media</a></li>
                    <li><a href="copyright.php">Copyright</a></li>
                </ul>
            </li>
            <button class="dropdown-btn">Pages 
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">   
            <a href="addpage.php">Add New Page</a>
                <?php
                    $query = "select * from tbl_page";
                    $pages = $db->select($query);
                    if ($pages) {
                        while ($result = $pages->fetch_assoc()) {
                ?>
                <a href="page.php?pageid=<?php echo $result['id'] ?>"><?php echo $result['name'] ?></a>
                <?php } } ?>
            </div>

            <button class="dropdown-btn">Category Option
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
                <a href="addcat.php">Add Category</a>
                <a href="catlist.php">Category List</a>
            </div>
            <button class="dropdown-btn">Post Option
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
                <a href="addpost.php">Add Post</a>
                <a href="postlist.php">Post List</a>
            </div>
        </ul>
    </div>
</div>