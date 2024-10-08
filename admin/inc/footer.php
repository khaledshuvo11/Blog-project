<div class="background mt-1">
        <p class="text-white text-[15px] py-2 px-5">
         &copy; Copyright <a href="#">Blog Website With PHP OOP</a>. All Rights Reserved.
        </p>
    </div>
    
    <script>
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;
        
        for (i = 0; i < dropdown.length; i++) {
          dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
              dropdownContent.style.display = "none";
            } else {
              dropdownContent.style.display = "block";
            }
          });
        }
    </script>

</body>
</html>