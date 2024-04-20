	<footer class="sticky-footer bg-primary">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; ~Furni 2024</span>
          </div>
        </div>
     </footer>
<!--- Script Source Files -->
<script type="text/javascript">
    
         
        function chid(){
            var icon = document.getElementsByClassName("pass");
                        
            $(icon).toggleClass("fa-eye fa-eye-slash");
              var input = $($(icon).attr("toggle"));
              if (input.attr("type") == "password") {
                input.attr("type", "text");
              } else {
                input.attr("type", "password");
              }
        } 
        
        function shid(){
            var icon = document.getElementById("pass");
                        
            $(icon).toggleClass("fa-eye fa-eye-slash");
              var input = $($(icon).attr("toggle"));
              if (input.attr("type") == "password") {
                input.attr("type", "text");
              } else {
                input.attr("type", "password");
              }
        }
        
        // $(".toggle-password").on("click", function() {
        //     alert(10);
        //   $(this).toggleClass("fa-eye fa-eye-slash");
        //   var input = $($(this).attr("toggle"));
        //   if (input.attr("type") == "password") {
        //     input.attr("type", "text");
        //   } else {
        //     input.attr("type", "password");
        //   }
        // });
        
        // $('.toggle-password').on('click', function() {
        //   $(this).toggleClass('fa-eye fa-eye-slash');
        //   let input = $($(this).attr('toggle'));
        //   if (input.attr('type') == 'password') {
        //     input.attr('type', 'text');
        //   }
        //   else {
        //     input.attr('type', 'password');
        //   }
        // });
        
</script>
<script src="bootstrap-4.1.3-dist/js/jquery.min.js"></script>
<script src="bootstrap-4.1.3-dist/js/popper.min.js"></script>
<script src="bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
<script src="bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"></script>
<!--- End of Script Source Files -->

</body>
</html>