<?php
  if(count($products) > 0){
    foreach ($products as $p) {
      $pid = $p->product_id;
      $cid = $p->cate_id;
      $sid = $p->subcate_id;
?>
  <!-- card  -->
  <div class="col-lg-3 col-6 sm-6 col-md-4">
    <a class="text-decoration-none text-black" href="<?=base_url('items/view/'.$pid)?>">
      <div class="card img-hover mt-2 mt-4">
        <div class="card-body d-flex flex-row">
          <?php if(!empty($p->user_pic)){ ?>
            <img src="<?=UPLOADED_URL.'profile/'.$p->user_pic;?>" class="rounded-circle me-3 img-all" height="50px" width="50px" alt="Profile" />
          <?php }else{ ?>
            <img src="<?=ASSETS_PATH.'/images/logo.png';?>" class="rounded-circle me-3 img-all" height="50px" width="50px" alt="Profile default" />
          <?php } ?>
          <div style="width: 80%;">
            <h5 class="card-title font-weight-bold mb-2 font-size product_title">
              <?php echo $p->product_name; ?>
            </h5>
            <p class="card-text font-size">
              <i class="far fa-clock pe-2 font-size font-size"></i>
              <?php echo date('d/m/Y', strtotime($p->created_at)); ?>
            </p>
          </div>
        </div>
        <div class="bg-image hover-overlay ripple rounded-0" data-mdb-ripple-color="light">
          <img class="img-fluid product_img" src="<?=UPLOADED_URL.'products/'.$p->product_pic;?>" alt="Free foodmage cap" />
          <a href="#">
            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
          </a>
        </div>
        <div class="card-body">
          <p class="card-text" >
            <?php
              $from = date_create(date('Y-m-d', strtotime($p->created_at)));
              $to = date_create(date('Y-m-d'));
              $diff = date_diff($to, $from);
              $days = $diff->format('%a days');
              echo ($days==0) ? 'Recently...' : $days . ' ago...';
            ?> 
          </p>
          <p class="card-text" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
            <?php echo $p->description; ?>
          </p>
          <?php
          if(!empty($this->session->userdata('sgUser'))):
            if(current_url() != base_url('items/get_all_products')){
          ?>
            <div class="font-size d-flex justify-content-between">
              <p>
              <?php echo $this->lang->line('Product_Id');?>: <?php echo $p->product_id; ?>
              </p>
              <p>
              <?php echo $this->lang->line('User_Id');?>: <?php echo $p->user_id; ?>
              </p>
            </div>
          <?php } ?>
            <div class="d-flex justify-content-between">
              <?php
                $uid = $this->session->userdata('sg_user_id');
                $wish = $this->db->get_where('tbl_wishlists', array('user_id'=>$uid, 'product_id'=>$pid));
                if($wish->num_rows() > 0){
              ?>
                <a href="<?php echo base_url('home/remove_wishlist/'.$pid); ?>" data-mdb-toggle="tooltip" data-mdb-placement="top" title="<?php echo $this->lang->line('Added_in_wishlist_already_Unlike_it');?>">
                  <i class="fas fa-heart text-danger my-1 me-0"></i>
                </a>
              <?php }else{ ?>
                <a href="<?php echo base_url('home/add_wishlist/'.$pid); ?>" data-mdb-toggle="tooltip" data-mdb-placement="top" title="<?php echo $this->lang->line('I_like_it');?>">
                  <i class="fas fa-heart text-muted my-1 me-0"></i>
                </a>
              <?php } ?>
              <div>
                <button style="border: none; background-color: white;" onclick="copyPostlink('<?=$pid?>')">
                  <i class="fas fa-share-alt tFree foodted my-1 me-2" value="Copy Url" data-mdb-toggle="tooltip" data-mdb-placement="top" title="<?php echo $this->lang->line('Share_this_post');?>"></i>
                </button>
                <input type="text" style="display: none;" value="<?=base_url('items/view/'.$pid)?>" id="plink_<?=$pid?>">
              </div>
            </div>
          <?php endif; ?>
          <hr>
          <p class="card-text" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
            <i class="fas fa-map-marker-alt"></i>
            <?php echo $p->location; ?>
          </p>
          <?php if((current_url()==base_url('items/get_user_products'))&&(!empty($this->session->userdata('sgUser')))): ?>
          <div class="d-flex justify-content-between">
            <a href="<?=base_url('items/delete_this_product/'.$pid)?>" class="btn btn-danger" onclick="return confirm(<?php echo $this->lang->line('Delete_confirm');?>)">
            <?php echo $this->lang->line('Delete');?>
            </a>
            <a data-bs-toggle="modal" data-bs-target="#edit-post_<?=$pid?>" class="btn btn-primary">
            <?php echo $this->lang->line('Edit');?>
            </a>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </a>
  </div>
  <!-- card  -->

  <?php if((current_url()==base_url('items/get_user_products'))&&(!empty($this->session->userdata('sgUser')))): ?>
  <!-- Modal post-->
  <div class="modal fade" id="edit-post_<?=$pid?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form class="modal-content" action="<?=base_url('items/edit/'.$pid)?>" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?php echo $this->lang->line('Edit_post');?></h5>
        </div>
        <div class="modal-body">
       
          <div class="mb-3">
            <label for="select category"><?php echo $this->lang->line('Choose_category');?></label>
            <select class="form-select" aria-label="Default select example" required onchange="edit_get_subcategories(this)" name="category" required>
              <option value="" disabled selected><?php echo $this->lang->line('Choose_an_option');?></option>
              <?php
                $allCate = $this->db->get('tbl_cate')->result();
                foreach ($allCate as $c):
              ?>
                <option <?php echo ($cid == $c->id) ? 'selected' : '' ?> value="<?=$c->id?>"><?=$c->cate_name?></option>
              <?php 
                endforeach;
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="select category"><?php echo $this->lang->line('Choose_sub_category');?></label>
            <select class="form-select" aria-label="Default select example" id="edit_sub_category" name="sub_category" required>
              <option value="" disabled selected><?php echo $this->lang->line('Choose_a_category_to_get_sub_category');?></option>
              <?php
                $this->db->where('cate_id', $cid);
                $allsubCate = $this->db->get('tbl_sub_cate')->result();
                foreach ($allsubCate as $s):
              ?>
                <option <?php echo ($sid == $s->id) ? 'selected' : '' ?> value="<?=$s->id?>"><?=$s->sub_cate_name?></option>
              <?php 
                endforeach;
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="name of the product"> <?php echo $this->lang->line('Product_name');?></label>
            <input type="text" class="form-control" required name="pname" value="<?=$p->product_name;?>">
          </div>
          <div class="mb-3">
            <label for="name of the product"> <?php echo $this->lang->line('Product_description');?></label>
            <textarea type="text" class="form-control" name="description" required><?=$p->description;?></textarea>
          </div>
          <div class="mb-3 row">
            <label class="col-12 mb-2" for="name of the product"> <?php echo $this->lang->line('Products_first_image');?> <small>(<?php echo $this->lang->line('uploading_new_image_will_replace_this');?>)</small>
            </label>
            <div class="col-lg-2 text-center">
              <img src="<?=UPLOADED_URL.'products/'.$p->product_pic;?>" alt="Post picture" width="58px" height="58px">
            </div>
            <div class="col-lg-10"></div>
            <?php
              $images = $p->images;
              if(!empty($images)){
            ?>
            <label class="col-12 mt-2 mb-2"> <?php echo $this->lang->line('Products_detailed_images');?>
            </label>
            <?php
                $imgs = explode(',', $images);
                for ($m=0; $m < count($imgs); $m++) {
            ?>
            <div class="col-lg-2 text-center">
              <img src="<?=UPLOADED_URL.'products/'.$imgs[$m];?>" alt="Post picture" width="58px" height="58px"><br>
              <a href="<?=base_url('items/delete_product_pic/'.$pid.'/'.$m)?>" class="mt-0" title="Remove post picture">
                <i class="fa fa-times-circle text-danger"></i>
              </a>
            </div>
            <?php
                }
              }
            ?>
            <input type="hidden" class="form-control" id="rowcount_img_<?=$pid?>" value="<?php echo (!empty($images)) ? $m : '1'?>"/>
          </div>
          <div class="mb-3"><hr>
            <label class="form-label">
            <?php echo $this->lang->line('Change_products_first_image');?>
            </label>
            <input type="file" class="form-control mt-1" id="exampleInputEmail1" aria-describedby="emailHelp" name="product_image">
            <label class="form-label mt-3">
            <?php echo $this->lang->line('Products_detailed_images');?>
              <a class="btn btn-secondary p-0" onclick="edit_addimg('<?=$pid?>')">
                &nbsp;<i class="fa fa-plus fa-sm"></i> <?php echo $this->lang->line('Add_new_image');?>&nbsp;
              </a>
            </label>
            <div id="edit_alert-msg_<?=$pid?>"></div>
            <div id="edit_img_append_<?=$pid?>"></div>
          </div>
        </div>
        <div class="modal-footer">
          <a class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $this->lang->line('Close');?></a>
          <button type="submit" class="btn btn-primary">
          <?php echo $this->lang->line('Submit');?>
          </button>
        </div>
      </form>
    </div>
  </div>
  <!-- Modal post-->
  <?php endif; ?>

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