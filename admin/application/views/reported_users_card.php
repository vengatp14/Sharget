<?php
if(count($users) > 0){
  foreach ($users as $u) {
    $uid = $u->id;
    $profilepic = empty($u->profile_pic) ? 'default.jpeg' : $u->profile_pic;
?>

    <!-- data card -->
    <div class="col-lg-3 col-md-6 col-sm-12">
      <div class="card img-hover mt-2 mt-4">
        <div class="card-body d-flex flex-row pb-0">
          <img src="<?=UPLOADED_URL.'profile/'.$profilepic?>" class="rounded-circle me-3" height="50px" width="50px" alt="Free food" />
          <div>
            <h5 class="card-title font-weight-bold mb-2">
              <?php echo $u->username; ?>
            </h5>
            <p class="card-text"><i class="far fa-clock pe-2"></i>
              <?php echo date('m/d/Y', strtotime($u->reported_at)); ?>
            </p>
            <p><b>User id : </b><span> <?php echo $u->id; ?></span></p>
          </div>
        </div>
        <div class="card-body pt-0">
          <hr>
          <p class="text-black">
            <strong class="text-danger">Reported by : </strong>
            <?php echo $u->reported_by; ?>
          </p>
          <p class="text-black">
            <strong class="text-danger">Reason for report: </strong><br>
            <?php echo $u->rep_reason; ?>
          </p>
        <div class="col-12 text-center">
          <a href="<?=base_url('report/delete_user/'.$uid)?>" class="btn btn-danger text-white" onclick="return confirm('Are you sure to remove this user?\nThis user will be moved to deleted list and products of this user will not shown to others...')">
            Delete this user <i class="far fa-trash-alt"></i>
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
    echo '<h5 class="text-center">No users reported...</h5>';
  }
?>