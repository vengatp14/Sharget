
</div>
</div>
<!-- Page Content  -->
<div class="overlay"></div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="<?=ASSETS_PATH ?>jquery/jquery-3.3.1.slim.min.js"></script>
    
    <!-- Popper.JS -->
    <script src="<?=ASSETS_PATH ?>boostrap/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="<?=ASSETS_PATH ?>boostrap/js/popper.min.js"></script>
    <script src="<?=ASSETS_PATH ?>boostrap/js/bootstrap.min.js"></script>

    <!-- data table   -->
    <script src="<?=ASSETS_PATH ?>js/jquery-3.5.1.js"></script>
    <script src="<?=ASSETS_PATH ?>js/jquery.dataTables.min.js"></script>
    <script src="<?=ASSETS_PATH ?>datatable/dataTables.responsive.js"></script>
    
    <!-- jQuery Custom Scroller CDN -->
    <script src="<?=ASSETS_PATH ?>jquery/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- costom js  -->
   <script src="<?=ASSETS_PATH ?>js/app.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
        

        // data table 
        var dtable = null;
        $(document).ready(function () {
            dtable =$('#example').DataTable({
                "searching": true,
                "paging": true,
                "pageLength": 5,
                "lengthMenu": [5, 10, 15, 25],
                // "order": [[1, "desc"]],
                "ordering": true,
                responsive: true,

            });
        });

        // Mano Mahe
        $('.alert').delay(3600).fadeOut(300);
        function closeshownAlert(){
          $('.alert').hide();
        }

        function Auto_Delete(event){
          $.ajax({
            url: "<?=base_url('user/AutoDelete')?>",
            data: {AutoDelete:event.srcElement.checked},
            type: "post",
            success: function(data){
              
            }
          });
        }


        function Show_Expiry(event){
          $.ajax({
            url: "<?=base_url('user/ShowExpiry')?>",
            data: {ShowExpiry:event.srcElement.checked},
            type: "post",
            success: function(data){
            
            }
          });
        }

        function showBlogNotification(nid){
          $(".hide-notify").hide();
          $.ajax({
            url: "<?=base_url('user/notified')?>",
            data: {nid:nid},
            type: "post",
            success: function(data){
              location.href = "<?=base_url('user/blogs/')?>"+nid;
            }
          });
        }

        function showReportNotification(nid, type){
          $(".hide-notify").hide();
          $.ajax({
            url: "<?=base_url('user/notified')?>",
            data: {nid:nid},
            type: "post",
            success: function(data){
              location.href = "<?=base_url('report/')?>"+type;
            }
          });
        }

    </script>
</body>

</html>