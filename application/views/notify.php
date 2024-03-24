<?php $this->load->view('common/header'); ?>

<div class="container-lg">
	<h2 class="text-center mb-5"><?php echo $this->lang->line('Notifications');?></h2>
	<div class="row">
		<div class="col-12">
		  
		<?php
			if(count($notify)>0){
				foreach ($notify as $n) {
		?>
			<div class="card mb-2">
				<div class="card-body">
					<h5>
						<?=$n->title;?>
						<small class="float-end">
							<?=date('m/d/Y', strtotime($n->created_at));?>
						</small>
					</h5>
					<p>
						<?=$n->description;?>
					</p>
					<?php
						if ($n->sent_for=='blog'):
							$res = $this->db->get_where('tbl_blogs_comments', array('blog_id'=>$n->blog_id, 'reply'=>$n->description))->result();
							if (count($res)>0){
					?>
		                <a href="<?=base_url('blogs/'.$n->blog_id)?>" class="btn btn-sm btn-primary">
						<?php echo $this->lang->line('View_in_Blog');?>
		                </a>
		            <?php }else{ ?>
		                <small class="text-secondary">
						<?php echo $this->lang->line('Blog_comments_updated');?>
		                </small>
		            <?php }
		        		endif;
		        	?>
				</div>
			</div>
		<?php
				}
			}else{
				echo '<div class="text-center">No notifications..!</div>';
			}
		?>

		</div>
	</div>
</div>

<?php $this->load->view('common/footer'); ?>