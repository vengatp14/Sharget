<?php $this->load->view('common/header');?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" action="<?=base_url('home/update_profile/'.$uid)?>" method="post" enctype="multipart/form-data" id="edit-profile">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          <?php echo $this->session->userdata('sg_user_name'); ?>
        </h5>
        <p><?php echo $this->lang->line('Profile_details_edit');?></p>
      </div>
      <div class="modal-body">
        <?php
          foreach ($profile as $pro) {
            $profilePic = $pro->profile_pic;
            $opswd = $pro->password;
        ?>
          <label class="mt-2" for="profile pic"><?php echo $this->lang->line('Profile_picture');?> <small>(jpg, jpeg, png only)</small></label>
          <input class="form-control" type="file" name="profilepic" accept="image/png, image/jpeg, image/jpg">
          <label class="mt-2" for="user-name"><?php echo $this->lang->line('User_name');?></label>
          <input class="form-control" type="text" required value="<?=$pro->username?>" name="username">
          <label class="mt-2" for="Phone-number"><?php echo $this->lang->line('Phone_number');?></label>
          <input class="form-control" type="number" required value="<?=$pro->phone?>" name="phone" id="edit_phone">
          <p class="text-danger" id="edit_phone_error"></p>
          <label class="mt-2" for="E-mail"><?php echo $this->lang->line('E-mail');?></label>
          <input class="form-control" type="email" required value="<?=$pro->email?>" name="email" id="edit_email">
          <p class="text-danger" id="edit_email_error"></p>
          <label class="mt-2" for="Blood Group"><?php echo $this->lang->line('Blood_Group');?></label>
          <select class="form-control" required name="blood_group">
            <option value="" disabled selected><?php echo $this->lang->line('Choose_your_blood_group');?></option>
            <?php
              foreach ($bloods as $bl) {
                $sub = explode(",",$bl->sub_cate_id);
                $sub_cate = explode(",",$bl->sub_cate);
                for ($b=0; $b < count($sub); $b++) { 
            ?>
              <option <?php echo ($sub[$b] == $pro->blood_group) ? 'selected' : ''; ?> value="<?=$sub[$b]?>">
                <?=$sub_cate[$b]?>
              </option>
            <?php } } ?>
          </select>
          <label class="mt-2" for="Location"><?php echo $this->lang->line('Location');?></label>
          <input class="form-control" type="text" required value="<?=$pro->location?>" name="location">
        <?php } ?>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-danger" data-bs-dismiss="modal"><i class="far fa-times-circle"></i> <?php echo $this->lang->line('Close');?></button>
        <button type="submit" onclick="return check_auth()" class="btn btn-success"><i class="far fa-save"></i> <?php echo $this->lang->line('Save_changes');?></button>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="change_pswd" tabindex="-1" aria-labelledby="change_pswdLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" action="<?=base_url('home/update_password/'.$uid)?>" method="post" id="change_pswdfrm">
      <div class="modal-header">
        <h5 class="modal-title" id="change_pswdLabel">
          <?php echo $this->session->userdata('sg_user_name'); ?>
        </h5>
        <p><?php echo $this->lang->line('Change_password');?></p>
      </div>
      <div class="modal-body">
          <label class="mt-2" for="opass"><?php echo $this->lang->line('Old_password');?></label>
          <input class="form-control" type="password" required name="opass" id="opass">
          <p class="text-danger" id="opass_error"></p>
          <input class="form-control" type="hidden" required id="opswd" name="opswd" value="<?=$opswd?>">
          <label class="mt-2" for="npass"><?php echo $this->lang->line('New_password');?></label>
          <input class="form-control" type="password" required name="npass" id="npass">
          <p class="text-danger" id="npass_error"></p>
          <label class="mt-2" for="cpass"><?php echo $this->lang->line('Confirm_password');?></label>
          <input class="form-control" type="password" required name="cpass" id="cpass">
          <p class="text-danger" id="cpass_error"></p>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-danger" data-bs-dismiss="modal"><i class="far fa-times-circle"></i> <?php echo $this->lang->line('Cancel');?></button>
        <button type="submit" onclick="return check_pswd()" class="btn btn-success"><i class="far fa-save"></i> <?php echo $this->lang->line('Save_changes');?></button>
      </div>
    </form>
  </div>
</div>

<!-- Modal -->

<div class="modal fade" id="exampleModal-del" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $this->lang->line('Are_you_sure');?></h5>
      </div>
      <div class="modal-body">
        <p>
        <?php echo $this->lang->line('After_delete_your_account');?>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $this->lang->line('Cancel');?></button>
        <a href="<?php echo base_url('home/delete_user'); ?>" class="btn btn-primary">
        <?php echo $this->lang->line('Sure_Delete_my_account');?>
        </a>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal-dis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $this->lang->line('Are_you_sure');?></h5>
      </div>
      <div class="modal-body">
        <p>
        <?php echo $this->lang->line('After_deactivate_your_account');?>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $this->lang->line('Cancel');?></button>
        <a href="<?php echo base_url('home/deactivate'); ?>" class="btn btn-primary">
        <?php echo $this->lang->line('Sure_Deactivate_my_account');?>
        </a>
      </div>
    </div>
  </div>
</div>
<!-- Modal post-->

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-6 text-center mt-3 mb-5">
    <h1>
      <?php
        echo $this->session->userdata('sg_user_name');
        $profilePic = empty($profilePic) ? 'default.jpeg' : $profilePic;
      ?>
    </h1>
    <h5><?php echo $this->lang->line('Profile_Details');?></h5>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-12 text-center">
    <img class="rounded" src="<?=UPLOADED_URL.'profile/'.$profilePic; ?>" alt="" height="288px">
  </div>
  <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
    <?php foreach ($profile as $pro) { ?>
      <table class="table">
        <tr>
          <td style="width: 20%;">
            <p>
              <b><?php echo $this->lang->line('User_name');?></b>
            </p>
          </td>
          <td class="text-center">
            <p><b>:</b></p>
          </td>
          <td>
            <?php echo $pro->username; ?>
          </td>
        </tr>
        <tr>
          <td>
            <p>
              <b><?php echo $this->lang->line('Email');?></b>
            </p>
          </td>
          <td class="text-center">
            <p><b>:</b></p>
          </td>
          <td>
            <?php echo $pro->email; ?>
          </td>
        </tr>
        <tr>
          <td>
            <p>
              <b><?php echo $this->lang->line('Phone_no');?></b>
            </p>
          </td>
          <td class="text-center">
            <p><b>:</b></p>
          </td>
          <td>
            <?php echo $pro->phone; ?>
          </td>
        </tr>
        <tr>
          <td>
            <p>
              <b><?php echo $this->lang->line('Blood_group');?></b>
            </p>
          </td>
          <td class="text-center">
            <p><b>:</b></p>
          </td>
          <td>
            <?php
              if (!empty($pro->blood_group)) {
                echo $this->db->get_where('tbl_sub_cate', array('id'=>$pro->blood_group))->row('sub_cate_name');
              }
            ?>
          </td>
        </tr>
        <tr>
          <td>
            <p>
              <b><?php echo $this->lang->line('Location');?></b>
            </p>
          </td>
          <td class="text-center">
            <p><b>:</b></p>
          </td>
          <td>
            <?php echo $pro->location; ?>
          </td>
        </tr>
        <tr>
          <td>
            <p>
              <b><?php echo $this->lang->line('No_of_Products');?></b>
            </p>
          </td>
          <td class="text-center">
            <p><b>:</b></p>
          </td>
          <td>
            <a class="text-decoration-none" href="<?=base_url('home/posts')?>">
              <?php
                echo $this->db->where('user_id',$uid)->from("tbl_products")->count_all_results();
              ?>
            </a>
          </td>
        </tr>
        </tr>
      </table>
      
    <?php } ?>
    <div class="row">
      <div class="col-12 d-flex mt-4">
        <button class="btn btn-success m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <?php echo $this->lang->line('Edit');?> <i class="fas fa-user-edit"></i>
        </button>
        <button class="btn btn-info m-1" data-bs-toggle="modal" data-bs-target="#change_pswd">
        <?php echo $this->lang->line('Change_password');?> <i class="fas fa-key"></i>
        </button>
        <button class="btn btn-warning m-1" data-bs-toggle="modal" data-bs-target="#exampleModal-dis">
        <?php echo $this->lang->line('Deactivate_Account');?> <i class="fas fa-user-slash"></i>
        </button>
        <button class="btn btn-danger m-1" data-bs-toggle="modal" data-bs-target="#exampleModal-del">
        <?php echo $this->lang->line('Delete_Account');?> <i class="fas fa-user-times"></i>
        </button>
      </div>
    </div>
  </div>
</div>


<?php $this->load->view('common/footer');?>
<script type="text/javascript">

  function check_auth() {
    var uid = '<?=$uid?>';
    var email = $("#edit_email").val();
    var phone = $("#edit_phone").val();
    $("#edit_phone_error").text('');
    $("#edit_email_error").text('');
    $.ajax({
      url: "<?=base_url('home/edit_auth_check/')?>"+uid,
      data: {
        email: email,
        phone: phone
      },
      type: "post",
      success: function(data){
        var check = JSON.parse(data);
        if(check.phone==true && check.email==true){
          console.log(check.phone);
          console.log(check.email);
          $("#edit-profile").submit();
          return true;
        }else{
          if(check.phone!=true){
            $("#edit_phone_error").text(check.phone);
          }
          if(check.email!=true){
            $("#edit_email_error").text(check.email);
          }
        }
      },
      error: function(){
        return false;
      }
    });
    // if($("#edit_phone_error").text()==""&&$("#edit_email_error").text()==""){
    //   return true;
    // }else{
      return false;
    // }
  }

  function check_pswd() {
    var opass = $('#opass').val();
    var opswd = $('#opswd').val();
    var npass = $('#npass').val();
    var cpass = $('#cpass').val();

    var md51 = '';

    $('#opass_error').text('');
    $('#npass_error').text('');
    $('#cpass_error').text('');

    if(opass == '' || npass == '' || cpass == ''){
      if(opass == ''){
        $('#opass_error').text('Old password required..!');
      }
      if(npass == ''){
        $('#npass_error').text('Password required..!');
      }
      if(cpass == ''){
        $('#cpass_error').text('Confirm password required..!');
      }
      return false;
    }else{

      $.ajax({
        url: "<?=base_url('home/getmd5/')?>"+opass,
        data: {},
        type: "post",
        success: function(data){
          md51 = data;

          if(npass != cpass){
            $('#cpass_error').text('Password and confirm password missmath..!');
          }
          if(npass == opass){
            $('#npass_error').text('Password should not be old password..!');
          }
          if(md51 != opswd){
            $('#opass_error').text('Old password missmath..!');
          }
          var opass_error = $('#opass_error').text();
          var npass_error = $('#npass_error').text();
          var cpass_error = $('#cpass_error').text();
          if(opass_error == '' && npass_error == '' && cpass_error == ''){
            return true;
          }else{
            return false;
          }
        }
      });
    }
  }
</script>