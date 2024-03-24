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
					<div class="d-flex justify-content-between">
		          	<h5 class="card-title font-weight-bold mb-2" style="min-height: 60px;max-height: 60px;width: 100%;">
		          		<?php echo $p->product_name; ?>
		          	</h5>
					  <?php if($p->expiry < date('Y-m-d')){ ?>
						<p><span class="text-white bg-danger p-1">Expiry</span></p>
						<?php  } ?>
					</div>
		          	<p class="card-text"><i class="far fa-clock pe-2"></i>
		          		<?php echo date('d/m/Y', strtotime($p->created_at)); ?>
		          	</p>
		        		<p><b>User id : </b><span> <?=$uid;?></span></p>
		          	<p><b>Product id : </b><span> <?=$p->product_id;?></span></p>
		        </div>
		      </div>
		      <div class="bg-image hover-overlay ripple rounded-0" data-mdb-ripple-color="light">
		        <img class="img-fluid" src="<?=UPLOADED_URL.'products/'.$p->product_pic;?>" alt="Free foodmage cap" style="min-height: 200px;max-height: 200px;width: 100%;"/>
		        <a href="#">
		          <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
		        </a>
		      </div>
		      <div class="card-body">
		        <p class="card-text" style="min-height: 100px;max-height: 100px;width: 100%;">
		          <?php echo $p->description; ?>
		        </p>
						<div class="col-12 text-center d-grid">
						 <a href="<?=base_url('items/delete_this_product/'.$pid.'/'.$uid)?>" class="btn btn-danger text-white mb-3" onclick="return confirm('Are you sure to move this product to deleted list?')">
						 Delete <i class="far fa-trash-alt"></i>
						 	</a>
							 <!-- <a href="<?=base_url('report/remove_item/'.$pid)?>" onclick="return confirm('Are you sure to delete this user & user\'s posts forever?\nAfter delete, this account can not be recover back but same user can able to register again..!')" class="btn btn-danger text-white" title="Delete forever">
	                		Disable <i class="fas fa-lock"></i>
	                	</a> -->
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