<?php $this->load->view('common/header'); ?>

<div class="row">
  <div class="col-12 text-center">
    <h1 class="mt-2 text-color">
      <?php echo $catename; ?>
    </h1>
    <p class="mb-4"><?php echo $this->lang->line('Products');?></p>
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
      url: "<?=base_url('items/get_type_products/')?>",
      data: {
        type : '<?=$type?>',
        type_id : '<?=$type_id?>'
      },
      type: "post",
      success: function(data){
        $('.products_list').html(data);
      }
    });
  }
  get_products();
</script>

