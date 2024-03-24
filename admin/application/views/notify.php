<?php $this->load->view('common/header'); ?>

<div class="container-fluid">

  <div class="row">
    <div class="col-12 text-center">
        <h3>
            Notifications to Users
            <hr>
        </h3>
    </div>
  </div>
  <div class="row">
    <form class="col-lg-12 col-md-12 col-sm-12 mx-auto p-5" action="<?php echo base_url('notify/add_new'); ?>" method="post">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mx-auto text-center">
          <h4>New Notification</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 mx-auto">
          <label class="mt-2" for="user-name">Notification Tittle</label>
          <input class="form-control" type="text" name="title" required>
          <label class="mt-2" for="user-name">Description</label> <br>
          <textarea class="form-control" name="description" required></textarea>
          <label class="mt-2" for="user-name">Notification to</label> <br>
          <select class="form-control" name="sent_to">
            <option value="all">
              All users (except deleted & deactivated users)
            </option>
            <?php
              if(!empty($users)){
                foreach ($users as $u) {
            ?>
              <option value="<?=$u->id?>">
                <?=$u->username?>
              </option>
            <?php
                }
              }
            ?>
          </select>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 mx-auto text-center">
          <button type="submit" class="btn btn-success m-5">
            Submit
          </button>
          <hr>
        </div>
      </div>
    </form>
    <div class="col-lg-12 col-md-12 col-sm-12 mx-auto text-center pb-5">
      <h4>Notifications sent</h4>
    </div>
    <?php 
      if(!empty($notifications)){
        foreach ($notifications as $n) { $nid = $n->id;
    ?>
      <div class="col-lg-4 mx-auto col-md-6 col-sm-12 mt-2">
        <div class="card" >
          <div class="card-body">
            <h6>
              <b><?php echo $n->title; ?></b>
              <span class="card-text float-right"> <?php echo date('m/d/Y', strtotime($n->created_at)); ?></span>
            </h6>
            <p >
              <b>Sent to - </b>
              <?php
                $to = $n->type;
                if($to == 'all'){
                  echo "All (except deleted & deactivated users)";
                }else{
                  echo $this->db->get_where('tbl_users', array('id'=>$n->sent_to))->row('username');
                }
              ?>
            </p><hr>
            <textarea class="card-text form-control text-left p-0 mt-3" rows="3" style="border: none; resize: none; background: transparent;" disabled><?php echo $n->description; ?></textarea>
            <div class="mb-3 mt-3 text-center">
              <a href="<?=base_url('notify/delete/'.$nid)?>" onclick="return confirm('Are you sure to delete this notification?\nThis will not be restored again..!\nThis will not shown to any users..!')" class="btn btn-danger">
                <i class="far fa-trash-alt"></i> Delete
              </a>
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
</script>