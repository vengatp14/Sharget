<?php $this->load->view('common/header'); ?>

	<section class="row p-5">

		<div class="col-lg-8 col-md-8 mx-auto col-sm-12">
		  	<h1 class="bg-info p-2 text-white text-center rounded"><?php echo $this->lang->line('users');?></h1>
		  	<div class="input-group mb-3">
		    	<input type="text" class="form-control" placeholder="<?php echo $this->lang->line('search');?>" aria-label="Username" aria-describedby="basic-addon1">
		    	<span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>

		  	</div>
		  	<main class="main-scroll" style="height: 400px; overflow-x: hidden; overflow-y: scroll;">
		    <ul class="list-unstyled mb-0">
		      <li class="p-2 border-bottom">
		        <a href="<?=base_url('chat/message')?>" class="d-flex justify-content-between">
		          <div class="d-flex flex-row">
		            <div>
		              <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-chat/ava1-bg.png"
		                alt="avatar" class="d-flex align-self-center me-3" width="60">
		              <span class="badge bg-success badge-dot"></span>
		            </div>
		            <div class="pt-1">
		              <p class="fw-bold mb-0">Marie Horwitz</p>
		              <p class="small text-muted">Hello, Are you there?</p>
		            </div>
		          </div>
		          <div class="pt-1">
		            <p class="small text-muted mb-1">Just now</p>
		            <span class="badge bg-danger rounded-pill float-end">3</span>
		          </div>
		        </a>
		      </li>
		      <li class="p-2 border-bottom">
		        <a href="<?=base_url('chat/message')?>" class="d-flex justify-content-between">
		          <div class="d-flex flex-row">
		            <div>
		              <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-chat/ava2-bg.png"
		                alt="avatar" class="d-flex align-self-center me-3" width="60">
		              <span class="badge bg-warning badge-dot"></span>
		            </div>
		            <div class="pt-1">
		              <p class="fw-bold mb-0">Alexa Chung</p>
		              <p class="small text-muted">Lorem ipsum dolor sit.</p>
		            </div>
		          </div>
		          <div class="pt-1">
		            <p class="small text-muted mb-1">5 mins ago</p>
		            <span class="badge bg-danger rounded-pill float-end">2</span>
		          </div>
		        </a>
		      </li>
		      <li class="p-2 border-bottom">
		        <a href="<?=base_url('chat/message')?>" class="d-flex justify-content-between">
		          <div class="d-flex flex-row">
		            <div>
		              <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-chat/ava3-bg.png"
		                alt="avatar" class="d-flex align-self-center me-3" width="60">
		              <span class="badge bg-success badge-dot"></span>
		            </div>
		            <div class="pt-1">
		              <p class="fw-bold mb-0">Danny McChain</p>
		              <p class="small text-muted">Lorem ipsum dolor sit.</p>
		            </div>
		          </div>
		          <div class="pt-1">
		            <p class="small text-muted mb-1">Yesterday</p>
		          </div>
		        </a>
		      </li>
		      <li class="p-2 border-bottom">
		        <a href="<?=base_url('chat/message')?>" class="d-flex justify-content-between">
		          <div class="d-flex flex-row">
		            <div>
		              <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-chat/ava4-bg.png"
		                alt="avatar" class="d-flex align-self-center me-3" width="60">
		              <span class="badge bg-danger badge-dot"></span>
		            </div>
		            <div class="pt-1">
		              <p class="fw-bold mb-0">Ashley Olsen</p>
		              <p class="small text-muted">Lorem ipsum dolor sit.</p>
		            </div>
		          </div>
		          <div class="pt-1">
		            <p class="small text-muted mb-1">Yesterday</p>
		          </div>
		        </a>
		      </li>
		      <li class="p-2 border-bottom">
		        <a href="<?=base_url('chat/message')?>" class="d-flex justify-content-between">
		          <div class="d-flex flex-row">
		            <div>
		              <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-chat/ava5-bg.png"
		                alt="avatar" class="d-flex align-self-center me-3" width="60">
		              <span class="badge bg-warning badge-dot"></span>
		            </div>
		            <div class="pt-1">
		              <p class="fw-bold mb-0">Kate Moss</p>
		              <p class="small text-muted">Lorem ipsum dolor sit.</p>
		            </div>
		          </div>
		          <div class="pt-1">
		            <p class="small text-muted mb-1">Yesterday</p>
		          </div>
		        </a>
		      </li>
		      <li class="p-2">
		        <a href="<?=base_url('chat/message')?>" class="d-flex justify-content-between">
		          <div class="d-flex flex-row">
		            <div>
		              <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-chat/ava6-bg.png"
		                alt="avatar" class="d-flex align-self-center me-3" width="60">
		              <span class="badge bg-success badge-dot"></span>
		            </div>
		            <div class="pt-1">
		              <p class="fw-bold mb-0">Ben Smith</p>
		              <p class="small text-muted">Lorem ipsum dolor sit.</p>
		            </div>
		          </div>
		          <div class="pt-1">
		            <p class="small text-muted mb-1">Yesterday</p>
		          </div>
		        </a>
		      </li>
		    </ul>
		  	</main>
		</div>

	</section>


<?php $this->load->view('common/footer'); ?>