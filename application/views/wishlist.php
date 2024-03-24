<?php $this->load->view('common/header'); ?>

<div class="row">
  <div class="mb-5">
    <h1 class="text-center"><?php echo $this->session->userdata('sg_user_name') ?>'s <?php echo $this->lang->line('Wish_list');?></h1>
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
      url: "<?=base_url('items/get_wished_products/')?>",
      data: {},
      type: "post",
      success: function(data){
        $('.products_list').html(data);
      }
    });
  }
  get_products();
</script>