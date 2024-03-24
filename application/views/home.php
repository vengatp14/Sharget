<?php $this->load->view('common/header'); ?>

<div class="row">
  <div class="col-12 text-center">
    <h1 class="mt-2 mb-4 text-color"><?php echo $this->lang->line('Fresh_recommendations');?></h1>
  </div>
  

  <div class="col-12">
    <div class="row products_list">
    </div>
  </div>
</div>

<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
  function get_products(){
    $.ajax({
      url: "<?=base_url('items/get_all_products/')?>",
      data: {},
      type: "post",
      success: function(data){
        $('.products_list').html(data);
      }
    });
  }
  get_products();
</script>