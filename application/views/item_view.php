<?php $this->load->view('common/header'); ?>


<!-- Modal report-->
<div class="modal fade" id="report-product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">
        <?php echo $this->lang->line('Report_the_item');?>
        </h5>
      </div>
      <form action="<?php echo base_url('items/report_product'); ?>" method="post">
        <div class="modal-body">
          <label class="form-control border-0" for="reson for report">
          <?php echo $this->lang->line('Reason_for_report');?>
          </label><br>
          <input type="hidden" name="report_product_id" id="report_product">
          <textarea required class="form-control" name="report_reason" cols="30" rows="10"></textarea>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">
          <?php echo $this->lang->line('Cancel');?>
          </button>
          <button type="submit" class="btn btn-primary">
          <?php echo $this->lang->line('Report_product');?>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="report-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">
        <?php echo $this->lang->line('Report_the_user');?>
        </h5>
      </div>
      <form action="<?php echo base_url('items/report_user'); ?>" method="post">
        <div class="modal-body">
          <label class="form-control border-0" for="reson for report">
          <?php echo $this->lang->line('Reason_for_report');?>
          </label><br>
          <input type="hidden" name="report_user_id" id="report_user">
          <textarea required class="form-control" name="report_reason" cols="30" rows="10"></textarea>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">
          <?php echo $this->lang->line('Cancel');?>
          </button>
          <button type="submit" class="btn btn-primary">
          <?php echo $this->lang->line('Report_user');?>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal report-->

<div class="row p-5">
  <?php
    $pics = array();
    foreach ($product as $p) {
      $pid = $p->product_id;
      $pics[] = $p->product_pic;
      if($p->images != ''){
        $images = explode(',', $p->images);
        for ($i=0; $i < count($images); $i++) {
          $pics[] = $images[$i];
        }
      }
  ?>
	<div class="col-lg-8 col-md-12 col-sm-12">
    <!-- <h1 class="text-center mb-3">Item images</h1> -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <?php for ($i=0; $i < count($pics); $i++) { ?>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?=$i?>" class="<?php echo ($i==0)?'active':''; ?>" aria-current="true" aria-label="Slide <?=$i?>"></button>
        <?php } ?>
      </div>
      <div class="carousel-inner">
        <?php for ($i=0; $i < count($pics); $i++) { ?>
          <div class="carousel-item <?php echo ($i==0)?'active':''; ?>">
            <img src="<?=UPLOADED_URL.'products/'.$pics[$i];?>" class="d-block w-100" alt="Product image">
          </div>
        <?php } ?>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden"><?php echo $this->lang->line('Previous');?></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden"><?php echo $this->lang->line('Next');?></span>
      </button>
    </div>
  </div>

  <div class="col-lg-4 col-md-12 col-sm-12">
    <h5 class="text-center mb-4 pb-3" style="border-bottom: 1px dashed #4a72b84d;">
    <?php echo $this->lang->line('Item_Details');?>
    </h5>
    <h3 class="mb-3">
      <?php echo $p->product_name; ?>
    </h3>
    <b><?php echo $this->lang->line('Product_description');?> : </b>
    <p>
      <?php echo $p->description; ?>
    </p>
    <p>
      <b><?php echo $this->lang->line('Category');?> : </b>
      <span>
        <?php
          $user_id = $p->user_id;
          $cate_id = $p->cate_id;
          $subcate_id = $p->subcate_id;
          $uid = $this->session->userdata('sg_user_id');
          $cate = $this->db->get_where('tbl_cate', array('id'=>$cate_id))->row('cate_name');
          $subcate = $this->db->get_where('tbl_sub_cate', array('id'=>$subcate_id))->row('sub_cate_name');
          $u_status = $this->db->get_where('tbl_users', array('id'=>$user_id))->row('status');
        ?>
        <a href="<?php echo base_url('items/cate/'.$cate_id); ?>" style="text-decoration: none;">
          <?php echo $cate; ?>
        </a>
        <i class="fa fa-angle-right"></i>
        <a href="<?php echo base_url('items/sub/'.$subcate_id); ?>" style="text-decoration: none;">
          <?php echo $subcate; ?>
        </a>
      </span>
    </p>
    <div class="row">
      <?php if(!empty($this->session->userdata('sgUser'))){ ?>
      <div class="font-size d-flex justify-content-between">
        <p>
        <?php echo $this->lang->line('Product_Id');?> : <?php echo $p->product_id; ?>
        </p>
        <p>
          User Id : <?php echo $p->user_id; ?>
        </p>
      </div>
        <div class="d-flex pb-3 justify-content-between" style="border-bottom: 1px dashed #4a72b84d;">
          <?php
            $wish = $this->db->get_where('tbl_wishlists', array('user_id'=>$uid, 'product_id'=>$pid));
            if($wish->num_rows() > 0){
          ?>
            <i class="btn fas fa-heart text-danger my-1 me-0" title="Added in wishlist already"></i>
          <?php }else{ ?>
            <a class="btn" href="<?php echo base_url('home/add_wishlist/'.$pid); ?>" data-mdb-toggle="tooltip" data-mdb-placement="top" title="<?php echo $this->lang->line('I_like_it');?>">
              <i class="fas fa-heart text-muted my-1 me-0"></i>
            </a>
          <?php } ?>
          <div>
            <button class="btn" onclick="copyPostlink('<?=$pid?>')">
              <i class="fas fa-share-alt tFree foodted my-1 me-2" data-mdb-toggle="tooltip" data-mdb-placement="top" title="<?php echo $this->lang->line('Share_this_post');?>"></i>
            </button>
            <input type="text" style="display: none;" value="<?=base_url('items/view/'.$pid)?>" id="plink_<?=$pid?>">
          </div>
        </div>

        <div class="col-12 mt-4 d-flex justify-content-between">
          <?php
          if($user_id == $uid){
        ?>
            <button class="btn btn-danger disabled btn-sm">
              <i class="fa fa-ban"></i> <?php echo $this->lang->line('Report_Product');?>
            </button>
            <button class="btn btn-warning disabled btn-sm">
              <i class="fa fa-ban"></i> <?php echo $this->lang->line('Report_User');?>
            </button>
            <button class="btn btn-secondary text-white disabled btn-sm">
              <i class="fa fa-ban"></i> <?php echo $this->lang->line('Your_product');?>
            </button>
          <?php
          }else{
            $p_report = $this->db->get_where('tbl_report_product', array('user_id'=>$uid, 'product_id'=>$pid));
            $u_report = $this->db->get_where('tbl_report_user', array('user_id'=>$uid, 'reported_id'=>$user_id));
            if($p_report->num_rows() > 0){
          ?>
            <button class="btn btn-danger disabled btn-sm">
              <i class="fa fa-ban"></i> <?php echo $this->lang->line('Product_Reported');?>
            </button>
          <?php }else{ ?>
            <button data-bs-toggle="modal" data-bs-target="#report-product" class="btn btn-danger btn-sm" onclick="return reportproduct('<?=$pid?>')">
            <?php echo $this->lang->line('Report_Product');?>
            </button>
          <?php 
            }
            if($u_report->num_rows() > 0){
          ?>
            <button class="btn btn-warning disabled btn-sm">
              <i class="fa fa-ban"></i> <?php echo $this->lang->line('User_Reported');?>
            </button>
          <?php }else{ ?>
            <button data-bs-toggle="modal" data-bs-target="#report-user" class="btn btn-warning btn-sm" onclick="return reportuser('<?=$user_id?>')">
            <?php echo $this->lang->line('Report_User');?>
            </button>
          <?php 
            }
            if($u_status == 1){
          ?>
            <a class="disabled">
              <button class="btn btn-secondary btn-outline-danger text-white btn-sm">
               <i class="fa fa-ban"></i> <?php echo $this->lang->line('Chat_Not_Active');?>
              </button>
            </a>
          <?php }else{ ?>
            <a href="<?=base_url('chat/'.$user_id)?>">
              <!-- <?//=base_url('chat/message/'.$user_id)?> -->
              <button class="btn btn-info text-white btn-sm">
              <?php echo $this->lang->line('Start_Chat');?>
              </button>
            </a>
          <?php
              }
            }
          ?>

        <?php }else{ ?>
          <p class="text-danger text-center w-100">
          <?php echo $this->lang->line('Please_login_to_proceed_further');?> 
            <a data-bs-toggle="modal" data-bs-target="#exampleModal" href="#" class="btn btn-secondary">
              <i class="fas fa-sign-in-alt"></i> <?php echo $this->lang->line('Login');?>
            </a>
          </p>
        </div>
      <?php } ?>
    </div>
  </div>
  <?php } ?>
</div>

<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
  function reportuser(uid) {
    $("#report_user").val(uid);
    return true;
  }
  function reportproduct(pid) {
    $("#report_product").val(pid);
    return true;
  }
</script>