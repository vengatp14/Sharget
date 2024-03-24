<?php $this->load->view('common/header'); ?>

<div class="container-fluid">

  <div class="row">
    <div class="col-12 mb-3 text-center">
        <h3>
            Blog
            <hr>
        </h3>
    </div>
  </div>
  <div class="row">
    <form class="col-lg-12 col-md-12 col-sm-12 mx-auto p-5" action="<?php echo base_url('user/add_blog'); ?>" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mx-auto text-center">
          <h4>New Blog</h4>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 mx-auto">
          <label class="mt-2" for="user-name">Image <small>(jpg, jpeg, png only)</small></label>
          <input class="form-control" type="file" name="blog_pic" required>
          <label class="mt-2" for="user-name">Tittle</label>
          <input class="form-control" type="text" name="title" required>
          <label class="mt-2" for="user-name">Description</label> <br>
          <textarea class="form-control mb-5" name="description" rows="5" required></textarea>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 mx-auto text-center">
          <button type="submit" class="btn btn-success mb-3">
            Publish &nbsp; <i class="far fa-save"></i>
          </button>
          <hr>
        </div>
      </div>
    </form>
    <div class="col-lg-12 col-md-12 col-sm-12 mx-auto text-center pb-5">
      <h4>Published Blog's</h4>
    </div>
    <?php 
      if(!empty($blogs)){
        foreach ($blogs as $b) { $bid = $b->id;
    ?>
      <div class="col-lg-4 mx-auto col-md-6 col-sm-12 mt-2">
        <div class="card" >
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
                <!--  data-bs-toggle="modal" data-bs-target="#exampleModallike" -->
                <i class="fas fa-heart"></i> <br> Likes 
                <span>
                  <?php
                    $this->db->where('blog_id', $bid);
                    echo $this->db->count_all_results('tbl_blogs_likes');
                  ?>
                </span>
              </div>
              <div onclick="get_comments('<?=$bid?>')" style="cursor: pointer;" class="text-black text-center">
                <!--  data-bs-toggle="modal" data-bs-target="#exampleModalcmt" -->
                <i class="fas fa-comment"></i> <br> Comments 
                <span>
                  <?php
                    $this->db->where('blog_id', $bid);
                    echo $this->db->count_all_results('tbl_blogs_comments');
                  ?>
                </span>
              </div>
            </div>
            <div class="mb-3 mt-3 text-center">
              <a href="<?=base_url('user/blog_delete/'.$bid)?>" onclick="return confirm('Are you sure to delete this blog?\nThis will not be restored again..!')" class="btn btn-danger">
                <i class="far fa-trash-alt"></i> Delete
              </a>
            </div>
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
              <small>Liked&nbsp;by</small>
            </div>
            <div class="modal-body" id="likes_data_<?=$bid?>">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                Close
              </button>
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
              <small>Comments</small>
            </div>
            <div class="modal-body" id="comments_data_<?=$bid?>">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                Close
              </button>
            </div>
          </div>
        </div>
      </div>

    <?php }
        }else{
    ?>
      <div class="col-lg-12 col-md-12 col-sm-12 mx-auto text-center p-5">
        <p>No blog's published...</p>
      </div>
    <?php } ?>
    <!-- data blog -->

  </div>
</div>

<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
  function get_likes(blog_id){
    $.ajax({
      url: "<?=base_url('user/blog_likes/')?>"+blog_id,
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
      url: "<?=base_url('user/blog_comments/')?>"+blog_id,
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