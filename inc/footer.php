<div class="footersection mx-auto">
    <div class="footermenu">
        <ul class="text-gray-400 mt-4">
            <li class="inline-block mx-1">
                <a href="#">Home</a>
            </li>
            <li class="inline-block mx-1">
                <a href="#">About</a>
            </li>
            <li class="inline-block mx-1">
                <a href="#">Contact</a>
            </li>
            <li class="inline-block mx-1">
                <a href="#">Privacy</a>
            </li>
        </ul>
    </div>
    <?php
        $query = "select * from tbl_footer where id='1'";
        $footernote = $db->select($query);
        if ($footernote) {
            while ($result = $footernote->fetch_assoc()) {
    ?> 
    <p class="mt-1 text-gray-300">&copy; <?php echo $result['note'] ?> <?php echo date('Y')?></p>
    <?php } } ?>
</div>