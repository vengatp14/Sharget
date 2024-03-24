<?php $this->load->view('common/header'); ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-12 mb-3 text-center">
        <h3>
            User Messages
            <hr>
        </h3>
    </div>
  </div>
	<div class="row">


	<!-- body of page -->
	<?php
	if (count($messages)) {
		foreach ($messages as $m) {
	?>
	<!-- card  -->
	<div class="col-lg-3 col-md-6 col-sm-12 ">
	    <div class="card img-hover mt-2 mt-4">
	      <div class="card-body d-flex flex-row pb-0">
	        <img src="<?=UPLOADED_URL.'profile/'.$m->profile_pic?>" class="rounded-circle me-3" height="50px"
	          width="50px" alt="Free food" />
	        <div>
	          <h5 class="card-title font-weight-bold mb-2">
	          	<?=$m->name?>
	          </h5>
	          <p class="card-text">
	          	<i class="far fa-clock pe-2"></i>
	          	<?=date('m/d/Y', strtotime($m->created_at));?>
	          </p>
	          <p><b>User id : </b><span> <?=$m->user_id?></span></p>
	        </div>
	      </div>
	      <div class="card-body pt-0">
	        <p><span>Mobile</span>: <?=$m->phone?></p>
	        <p><span>Email-id</span>: <?=$m->email?></p>
	        <p class="card-text" >
	          <?=$m->msg?>
	        </p>
	        <div class="d-flex justify-content-center">
	          <a href="<?=base_url('user/message_delete/'.$m->id)?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this message?')">Delete <i class="far fa-trash-alt"></i></a>
	        </div>
	      </div>
	    </div>
	  </div>
	  <!-- card  -->
	<?php }
	}else{
	?>
		<div class="col-lg-12 col-md-12 col-sm-12 text-center p-5">
	      	<h4>
	      		No messages yet...
	      	</h4>
		</div>
	<?php
	}
	?>
	   
	<!-- body of page -->

    </div>
</div>


<?php $this->load->view('common/footer'); ?>