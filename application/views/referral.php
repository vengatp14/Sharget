<?php $this->load->view('common/header'); ?>

  <h2 class="text-center mb-5"><?php echo $this->lang->line('Share_this_application_with_ur_friends');?></h2>
  <p class="text-center mb-5"><?php echo $this->lang->line('Click_this_input_box');?></p>

  <div class="text-center d-flex justify-content-center">
    <input id="copy-text" type="text" class="form-control w-75 text-center" value="<?=base_url()?>">
  </div>

<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
  document.getElementById("copy-text").onclick = function() {
  this.select();
  document.execCommand('copy');
  alert('Link copied,\nNow you can share this with you friends..!');
}
</script>