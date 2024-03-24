<?php
    $this->load->view('common/header');
    foreach ($admin as $single) {
        $uname = $single->username;
        $email = $single->email;
        $mobile = $single->mobile;
        $profilepic = $single->profilepic;
    }
    foreach ($settings as $set) {
        $Auto_Delete = $set->Auto_Delete;
        $Show_Expiry = $set->Show_Expiry;
    }
?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Admin profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?php echo base_url('home/update_profile'); ?>" enctype="multipart/form-data" method="post">
            <div class="modal-body">
             <label class="mt-2" for="profile pic">profile pic</label>
             <input class="form-control" type="file" name="profilepic">
             <label class="mt-2" for="user-name">User name</label>
             <input class="form-control" type="text" value="<?=$uname?>" name="username" required>
             <label class="mt-2" for="E-mail">E-mail</label>
             <input class="form-control" type="email" value="<?=$email?>" name="email" required>
             <label class="mt-2" for="Phone-no">Phone-no</label>
             <input class="form-control" type="number" value="<?=$mobile?>" name="mobile" required>
            </div>
            <div class="modal-footer">
              <a type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="far fa-times-circle"></i> Close</a>
              <button type="submit" class="btn btn-success"><i class="far fa-save"></i> Save changes</button>
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
                    Profile
                    <hr>
                </h3>
            </div>
        </div>
        <div class="row">
            <!-- data profile edit -->
            <div class="col-12 text-center">
            <img class="img-fluid rounded w-25" src="<?=PROFILE_URL.$profilepic;?>" alt="">
            </div>
            <div class="col-12 text-center mt-2">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit <i class="fas fa-user-edit"></i></button>  
            </div>

            <div class="col-12 text-center">
                <div>Auto Product Delete :</div>
                <div>
                <label class="switch">
                    <input type="checkbox" name="auto" <?php if($Auto_Delete == 'true'){echo'checked';} ?> onchange="Auto_Delete(event)" />
                    <span class="slider round"></span>
                </label>
            </div>
            </div>
            <div class="col-12 text-center">
                <div>Hide Expiry Product :</div>
                <div>
                <label class="switch">
                    <input type="checkbox" name="expiry" <?php if($Show_Expiry == 'true'){echo'checked';} ?> onchange="Show_Expiry(event)" />
                    <span class="slider round"></span>
                </label>
            </div>
            </div>
            <div class="col-12 text-center mt-2">
               <p class="text-black"> User name : <?=$uname?></p>
            </div>
            <div class="col-12 text-center mt-2">
                <p class="text-black"> Email : <?=$email?></p>
             </div>
             <div class="col-12 text-center mt-2">
                 <p class="text-black"> Phone-no : <?=$mobile?></p>
             </div>
            <!-- data profile edit -->

        </div>
    </div>


<?php $this->load->view('common/footer'); ?>