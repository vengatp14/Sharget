<?php $this->load->view('common/header'); ?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?php echo base_url('category/add_cate') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            <label class="mt-2">Category Picture <small>(jpg, jpeg, png only)</small></label>
            <input class="form-control" type="file" name="cate_pic" required>
            <label class="mt-2" for="user-name">Category Name</label>
            <input class="form-control" placeholder="English" type="text" name="cate_name" required>
            <input class="form-control mt-3" placeholder="Hindi" type="text" name="cate_name_hindi" required>
            <label class="mt-2" for="user-name">Category of products validity <small>(days)</small></label>
            <input class="form-control" placeholder="Products validity (Eg: 31)" type="number" name="cate_validity" required>
            <hr>
            <label class="mt-2" for="user-name">Sub category 
                <a onclick="category()" class="btn btn-success ms-5 text-white"><i class="fas fa-plus-circle"></i> add</a>
            </label>
            <div id="alert-msg"></div>
            <input class="form-control" placeholder="English" type="text" name="sub_cate[]" required>
            <input class="form-control mt-3" placeholder="Hindi" type="text" name="sub_cate_hindi[]" required>
            <div id="img_append"></div>
            <input type="hidden" class="form-control" id="rowcount_img" value=1/>
        </div>
        <div class="modal-footer">
          <a type="button" class="btn btn-danger text-white" data-bs-dismiss="modal"><i class="far fa-times-circle"></i> Close</a>
          <button type="submit" class="btn btn-success"><i class="far fa-save"></i> Add data</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<!-- Modal -->

    <div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3 text-center">
            <h3>
                Categories
                <hr>
            </h3>
        </div>
    </div>
        <div class="row">

<!-- data category -->
<?php
    foreach ($categories as $c) { 
        $sub = explode(",", $c->sub_cate);
?>
<div class="col-lg-4 col-md-6 col-sm-12 text-center mb-5">
    <ul type="none">
        <li>
            <h4><?php echo $c->cate_name ?></h4>
        </li>
        <li>
            <img src="<?=UPLOADED_URL.'cate/'.$c->cate_pic;?>" class="img-fluid w-50 pt-2 pb-2">
        </li>
        <?php for ($i=0; $i < count($sub); $i++) { ?>
            <li>
                <?php echo $sub[$i]; ?>
            </li>
        <?php } ?>
        <li class="pt-2">
            <?php if($c->id == 1){ ?>
                <a href="javascript:void(0);" class="btn btn-success disabled">
                    Edit <i class="far fa-edit"></i>
                </a>
                <a href="javascript:void(0);" class="btn btn-danger text-white disabled">
                    Delete <i class="far fa-trash-alt"></i>
                </a>
            <?php }else{ ?>
                <a href="<?php echo base_url('category/edit/'.$c->id); ?>" class="btn btn-success">
                    Edit <i class="far fa-edit"></i>
                </a>
                <a href="<?php echo base_url('category/delete/'.$c->id) ?>" onclick="return confirm('Are you aure to delete this category?\nAfter delete, could not restore this...')" class="btn btn-danger text-white">
                    Delete <i class="far fa-trash-alt"></i>
                </a>
            <?php } ?>
        </li>
    </ul>
</div>
<?php } ?>
 
            <div class="col-12 text-center mt-5">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-plus-square"></i> Add new category</button>
            </div>
<!-- data category -->

            </div>
        </div>

<?php $this->load->view('common/footer'); ?>

<script type="text/javascript">
    // add category 
    function category()
    {
        const rowcount = parseInt(document.getElementById('rowcount_img').value.trim())
        // alert(rowcount)
        if (rowcount<30)
        {
          // alert(rowcount)
          $('#img_append').append('<input type="text" class="form-control mt-3" placeholder="English" name="sub_cate[]"><input class="form-control mt-3" placeholder="Hindi" type="text" name="sub_cate_hindi[]">');
          document.getElementById('rowcount_img').value=rowcount+1;
        }
        else
        {
          $('#alert-msg').html('<div class="text-danger">you cannot add more than 30 sub-category </div>')
        }
    }
</script>