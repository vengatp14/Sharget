<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  $this->load->view('common/header');
?>


<div class="row ">
  <?php
    for ($c = 0; $c < count($all_cates); $c++) {
      $all_sub = $all_cates[$c]['subcate'];
  ?>
    <div class="col-lg-3 col-md-6 col-sm-12 text-center">
      <h5>
        <img src="<?=$all_cates[$c]['cate_pic']?>" height="40px" alt=""><br>
        <a href="<?php echo base_url('items/cate/'.$all_cates[$c]['cate_id']); ?>" style="text-decoration: none;">
          <h5><?php echo $all_cates[$c]['cate_name']; ?></h5>
        </a>
      </h5>
      <ul class="list-unstyled">
        <?php foreach ($all_sub as $sc): ?>
          <li>
            <a href="<?php echo base_url('items/sub/'.$sc->id); ?>" class="btn p-1">
              <?php echo $sc->sub_cate_name; ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php } ?>
 </div>

<?php $this->load->view('common/footer'); ?>