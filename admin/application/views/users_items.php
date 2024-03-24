<?php $this->load->view('common/header'); ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-12 mb-3 text-center">
        <h3>
            User's Posts
            <hr>
        </h3>
    </div>
  </div>
  <div class="row">

    <div class="col-12">
      <div class="form-floating mb-3">
        <input type="email" class="form-control" id="floatingInput" placeholder="Search" onkeyup="filter(this.value)">
        <label for="floatingInput">Search</label>
      </div>
    </div>
    <div class="col-12">
      <div class="row products_list">
      </div>
    </div> 

  </div>
</div>

<?php $this->load->view('common/footer'); ?>

<script type="text/javascript">
  function filter(product) {
    var url = "<?php echo base_url('user/filter_items/'.$uid) ?>";
    var postdata = {pname: product};
    $.ajax({
      type:'POST',
      url:url,
      data: postdata,
      success:function(msg){
        $(".products_list").html(msg);
      },
      error: function(result)
      {
        $(".products_list").html("Error"); 
      },
      fail:(function(status) {
        $(".products_list").html("Fail");
      }),
      beforeSend:function(d){
        $('.products_list').html("<center><strong style='color:#2b6777'><img height='128' width='128' src='<?php echo ASSETS_PATH ?>images/loader.gif'/><br>Please Wait...</strong></center>");
      }
    });
  }
  filter('');
</script>