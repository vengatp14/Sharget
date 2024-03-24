<?php $this->load->view('common/header'); ?>

<div class="container-fluid">

  <div class="row">
    <div class="col-12 mb-3 text-center">
        <h3>
            Edit Category
            <hr>
        </h3>
    </div>
  </div>

<!-- category-edit -->
<form  class="row" action="<?php echo base_url('category/edit/'.$cid); ?>" method="post" enctype="multipart/form-data">
    <?php 
        $rowCounts = 1;
        foreach ($category as $c):
            $rowCounts++;
            $sub = explode(",", $c->sub_cate);
            $sub_id = explode(",", $c->sub_cate_id);
            $subhindi = explode(",", $c->sub_cate_hindi);
    ?>
    <div class="col-lg-4 col-md-4 col-sm-12  mx-auto ">
        <h5 class="pb-4" for="category">Category details</h5>
        <label for="category">Category name</label>
        <input class="form-control" placeholder="English" type="text" name="cate_name" value="<?=$c->cate_name?>" required>
        <input class="form-control mt-3" placeholder="Hindi" type="text" name="cate_name_hindi" value="<?=$c->cate_name_hindi?>" required>
        <input class="form-control mt-3" placeholder="Number of days for expiry" type="number" name="cate_validity" value="<?=$c->cate_validity?>" required>

        <label for="category" class="mt-3">Category picture <small>(jpg, jpeg, png only) [optional]</small></label>
        <input class="form-control" type="file" name="cate_pic">
        <label for="category" class="mt-3">Current category picture</label><br>
        <img src="<?=UPLOADED_URL.'cate/'.$c->cate_pic;?>" class="img-fluid w-25 pb-2">
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12  mx-auto ">
        <h5 class="pb-4" for="category">Added sub categories details</h5>
        <?php for ($i=0; $i < count($sub); $i++) { ?>
            <label for="category">Sub category</label>
            <a href="<?=base_url('category/delete_sub/'.$sub_id[$i].'/'.$cid)?>" class="btn btn-danger btn-sm ml-2 mb-2">
                Delete
            </a>
            <input class="form-control" placeholder="English" type="text" name="sub_cate[]" value="<?=$sub[$i]?>" required>
            <input class="form-control mt-3 mb-3" placeholder="Hindi" type="text" name="sub_cate_hindi[]" value="<?=$subhindi[$i]?>" required>
        <?php } ?>
    </div>
    <?php endforeach ?>
    <div class="col-lg-4 col-md-4 col-sm-12  mx-auto ">
        <label class="pb-4">Add more sub category? 
            <a onclick="category()" class="btn btn-success text-white"><i class="fas fa-plus-circle"></i> add</a>
        </label>
        <div id="alert-msg"></div>
        <div id="img_append"></div>
        <input type="hidden" class="form-control" id="rowcount_img" value="<?=$rowCounts?>"/>
    </div>
    <div class=" col-12  mx-auto text-center mt-5">
       <a href="<?php echo base_url('category'); ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back</a>
       <button type="submit" class="btn btn-success"><i class="far fa-save"></i> Save changes</button>
    </div>
</form>
<!-- category-edit -->

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
          $('#img_append').append('<input type="text" class="form-control mt-3" placeholder="English" name="sub_cate[]" required><input class="form-control mt-3" placeholder="Hindi" type="text" name="sub_cate_hindi[]" required>');
          document.getElementById('rowcount_img').value=rowcount+1;
        }
        else
        {
          $('#alert-msg').html('<div class="text-danger">you cannot add more than 30 sub-category </div>')
        }
    }
</script>