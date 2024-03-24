<?php $this->load->view('common/header'); ?>

<div class="container-lg">
	<h2 class="text-center mb-5"><?php echo $this->lang->line('About_Us');?></h2>
	<div class="row">
		<div class="col-12">
		  <!-- <h1><?php echo $this->lang->line('title');?></h1>
		  <p><?php echo $this->lang->line('lorem');?></p>
		  <h1><?php echo $this->lang->line('title');?></h1>
		  <p><?php echo $this->lang->line('lorem');?></p>
		  <h1><?php echo $this->lang->line('title');?></h1>
		  <p><?php echo $this->lang->line('lorem');?></p> -->

	<p>
	<b>
	<?php echo $this->lang->line('platform_developed');?>
	</b> 
	</p>
	<h3>
	<?php echo $this->lang->line('motivation_behind');?>
	</h3>
	<p>
	<?php echo $this->lang->line('motivation_behind_sub');?>
	</p>
	<h3>
	<?php echo $this->lang->line('platform_work');?>
	</h3>
	<p>
	<?php echo $this->lang->line('platform_work_sub');?>

	</p>
		</div>
	</div>
</div>

<?php $this->load->view('common/footer'); ?>