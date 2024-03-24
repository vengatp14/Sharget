<?php $this->load->view('common/header'); ?>

<style type="text/css">
  .card{
    box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
    -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
    -moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
  }
</style>

<div class="row">
  <div class="col-12 text-center">
    <h1 class="mt-2 mb-4"><?php echo $this->lang->line('Blog');?></h1>
  </div>

  <?php foreach ($blogs as $b) { $bid = $b->id; ?>
    <div class="col-lg-10 col-md-12 border-dark col-md-12 mx-auto">
      <div class="card mb-5">
        <img src="<?=UPLOADED_URL.'blogs/'.$b->blog_pic;?>" class="card-img-top img-fluid"  alt="Free food">
          <div class="card-body">
            <h5>
              <?php echo $b->title; ?>
            </h5>
            <p class="card-text">
              <?php echo $b->description; ?>
            </p>
            <div class="d-flex justify-content-evenly">
              <div onclick="get_likes('<?=$bid?>')" style="cursor: pointer;" class="text-black text-center">
                <i class="fas fa-heart"></i> <br> <?php echo $this->lang->line('Likes');?> 
                <span>
                  <?php
                    $this->db->where(array('blog_id'=>$bid, 'likes'=>1));
                    echo $this->db->count_all_results('tbl_blogs_likes');
                  ?>
                </span>
              </div>
              <div onclick="get_comments('<?=$bid?>')" style="cursor: pointer;" class="text-black text-center">
                <i class="fas fa-comment"></i> <br> <?php echo $this->lang->line('Comments');?> 
                <span>
                  <?php
                    $this->db->where(array('blog_id'=>$bid, 'comments !='=>''));
                    echo $this->db->count_all_results('tbl_blogs_comments');
                  ?>
                </span>
              </div>
            </div>
            <?php if($this->session->userdata('sgUser')){ ?>
            <form action="<?php echo base_url('blogs/blog_comment/'.$bid);?>" method="post">
              <div class="mb-3 mt-3">
                <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('Leave_your_comments');?>" name="comment" required>
              </div>
              <div class="mb-3 mt-3">
                <?php 
                  $check = $this->db->get_where('tbl_blogs_likes', array('blog_id'=>$bid, 'user_id'=>$this->session->userdata('sg_user_id'), 'likes'=>1));
                  if($check->num_rows() > 0){
                ?>
                  <a href="<?php echo base_url('blogs/blog_like/'.$bid.'/0'); ?>" class="btn btn-danger">
                  <?php echo $this->lang->line('Unlike');?>&nbsp; <i class="fa fa-thumbs-down"></i>
                  </a>
                <?php }else{ ?>
                  <a href="<?php echo base_url('blogs/blog_like/'.$bid.'/1'); ?>" class="btn btn-primary">
                  <?php echo $this->lang->line('Like');?>&nbsp; <i class="fa fa-thumbs-up"></i>
                  </a>
                <?php } ?>
                <button type="submit" class="btn btn-success float-end">
                  <i class="fa fa-comment"></i>&nbsp; <?php echo $this->lang->line('Leave_comment');?>
                </button>
              </div>
            </form>
            <?php }else{ ?>
              <div class="mb-3 mt-3 text-center text-danger">
                <p><?php echo $this->lang->line('Please_login_to_like_comments');?></p>
              </div>
            <?php } ?>
          </div>
      </div>
    </div>

    <!-- like Modal -->
    <div class="modal fade" id="exampleModallike_<?=$bid?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title pr-4">
              <?=$b->title?>
            </h5>
            <small><?php echo $this->lang->line('Liked');?></small>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
          </div>
          <div class="modal-body" id="likes_data_<?=$bid?>">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><?php echo $this->lang->line('Close');?></button>
          </div>
        </div>
      </div>
    </div>

    <!-- like Modal cmd-->
    <div class="modal fade" id="exampleModalcmt_<?=$bid?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title pr-4">
              <?=$b->title?>
            </h5>
            <small><?php echo $this->lang->line('Comments');?></small>
          </div>
          <div class="modal-body" id="comments_data_<?=$bid?>">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><?php echo $this->lang->line('Close');?></button>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
  function get_likes(blog_id){
    $.ajax({
      url: "<?=base_url('blogs/blog_likes/')?>"+blog_id,
      data: {},
      type: "post",
      success: function(data){
        $("#likes_data_"+blog_id).html(data);
        $("#exampleModallike_"+blog_id).modal("show");
      }
    });
  }

  function get_comments(blog_id){
    $.ajax({
      url: "<?=base_url('blogs/blog_comments/')?>"+blog_id,
      data: {},
      type: "post",
      success: function(data){
        $("#comments_data_"+blog_id).html(data);
        $("#exampleModalcmt_"+blog_id).modal("show");
      }
    });
  }
  <?php if (isset($cmnt_id)&&!empty($cmnt_id)) { ?>
    get_comments('<?=$cmnt_id?>');
  <?php } ?>
</script>