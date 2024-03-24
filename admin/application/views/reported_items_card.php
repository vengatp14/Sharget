<?php
if(count($products) > 0){
  foreach ($products as $p) {
    $pid = $p->product_id;
    $uid = $p->user_id;
    $user = $this->shareget_model->get_user_by_id($uid);
    $profilepic = empty($p->user_pic) ? 'default.jpeg' : $p->user_pic;
?>
    <!-- data card -->
    <div class="col-lg-3 col-md-6 col-sm-12">
      <div class="card img-hover mt-2 mt-4">
        <div class="card-body d-flex flex-row">
          <img src="<?=UPLOADED_URL.'profile/'.$profilepic?>" class="rounded-circle me-3" height="50px" width="50px" alt="Free food" />
          <div>
            <h5 class="card-title font-weight-bold mb-2">
              <?php echo $p->product_name; ?>
            </h5>
            <p class="card-text"><i class="far fa-clock pe-2"></i>
              <?php echo date("m/d/Y", strtotime($p->reported_at)); ?>
            </p>
            <p><b>User id : </b><span> <?php echo $uid; ?></span></p>
            <p><b>Product id : </b><span> <?php echo $p->product_id; ?></span></p>
          </div>
        </div>
        <div class="bg-image hover-overlay ripple rounded-0" data-mdb-ripple-color="light">
          <img class="img-fluid" src="<?=UPLOADED_URL.'products/'.$p->product_pic;?>" alt="Free foodmage cap" />
          <a href="#">
            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
          </a>
        </div>
        <div class="card-body">
          <p class="card-text">
            <?php echo $p->description; ?>
            <hr>
          </p>
          <p class="text-black">
            <strong class="text-danger">Reported by :</strong>
            <?php echo $p->user_name; ?>
          </p>
          <p class="text-black">
            <strong class="text-danger">Reason for report: </strong><br>
            <?php echo $p->rep_reason; ?>
          </p>
       <div class="col-12 text-center">
          <a href="<?=base_url('report/delete_product/'.$pid)?>" class="btn btn-danger text-white" onclick="return confirm('Are you sure to remove this product?\nThis product will be moved to deleted list and will not shown to others...')">
            Delete this item <i class="far fa-trash-alt"></i>
          </a>
       </div>
         
        </div>
      </div>
    </div>
    <!-- data card -->

<?php } ?>

  <div class="col-sm-12">
    <nav class="mt-5">
      <?php echo $links; ?>
    </nav>
  </div>

<?php
  }else{
    echo '<h5 class="text-center">No posts yet...</h5>';
  }
?>