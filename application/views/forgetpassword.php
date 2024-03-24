<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
     <!-- boostrap 5 css -->
  <link rel="stylesheet" href="<?=ASSETS_PATH;?>/bootstrap-5.1.1-dist/css/bootstrap.min.css">
  <!-- font-awesome  -->
  <link rel="stylesheet" href="<?=ASSETS_PATH;?>/fontawesome-free-5.15.4-web/css/all.css">
  <!-- coustom css  -->
  <link rel="stylesheet" href="<?=ASSETS_PATH;?>/css/style.css">
   <!-- Using jQuery with a CDN -->
   <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>

  <!-- CSS file -->
  <link rel="stylesheet" href="<?= base_url('assets/EasyAutocomplete/easy-autocomplete.min.css')?>">
  <!-- JS file -->
  <script src="<?= base_url('assets/EasyAutocomplete/jquery.easy-autocomplete.min.js')?>"></script>

  <!-- Additional CSS Themes file - not required-->
  <link rel="stylesheet" href="<?= base_url('assets/EasyAutocomplete/easy-autocomplete.themes.min.css')?>">
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    
</head>
<body>
<?php $this->load->view('common/header'); ?>
<section class="container-fluid">
    <div class="row">
        <div class="col-6 offset-3">
            <h4 class="text-center">Forget Password</h4>
            <form action="<?=base_url('home/forget_Password_Update/')?><?php echo $email_id;?>" method="POST">
                        <div class="mb-3"><label><?php echo $this->lang->line('Please_Confirm_Your_Account');?></label> : <b><?php echo $email_id;?></b></div>
                        <label style="margin-right: 15px;align-self: end;" class="form-label"><?php echo $this->lang->line('New_password');?></label>
                        <div class="mb-3 input-group">
                          <input type="password" class="form-control" aria-describedby="New_password" required name="New_password" id="New_password">
                          <span class="input-group-text"><i class="far fa-eye-slash" id="Newpassword"></i></span>
                        </div>  
                        <label style="margin-right: 15px;align-self: end;" class="form-label"><?php echo $this->lang->line('Confirm_password');?></label>
                        <div class="mb-3 input-group">
                          <input type="password" class="form-control" aria-describedby="Confirm_password" required name="Confirm_password" id="Confirm_password" onkeyup="validate_password()">
                          <span class="input-group-text"><i class="far fa-eye-slash" id="Confirmpassword"></i></span>
                        </div>
                        <div class="mb-2">
                        <span id="wrong_pass_alert"></span>                     
                        </div>  
                        <button id="Change_password" type="submit" class="btn btn-primary"><?php echo $this->lang->line('Change_password');?></button>
                  </form>
        </div>
    </div>
</section>
    <?php $this->load->view('common/footer'); ?>
<script>
    const Newpassword = document.querySelector("#Newpassword");
    const New_password = document.querySelector("#New_password");
    const Confirmpassword = document.querySelector("#Confirmpassword");
    const Confirm_password = document.querySelector("#Confirm_password");
    const Change_password = document.querySelector("#Change_password");
    document.getElementById('Change_password').disabled = true;
    document.getElementById('Change_password').style.opacity = (0.4);
    Newpassword.addEventListener("click", function () {
const type = New_password.getAttribute("type") === "password" ? "text" : "password";
New_password.setAttribute("type", type);
if(type === "text"){
    $('#Newpassword').removeClass('far fa-eye-slash');
    $('#Newpassword').addClass('far fa-eye');
}
if(type === "password"){
    $('#Newpassword').removeClass('far fa-eye');
    $('#Newpassword').addClass('far fa-eye-slash');
}
});
Confirmpassword.addEventListener("click", function () {
const type = Confirm_password.getAttribute("type") === "password" ? "text" : "password";
Confirm_password.setAttribute("type", type);
if(type === "text"){
    $('#Confirmpassword').removeClass('far fa-eye-slash');
    $('#Confirmpassword').addClass('far fa-eye');
}
if(type === "password"){
    $('#Confirmpassword').removeClass('far fa-eye');
    $('#Confirmpassword').addClass('far fa-eye-slash');
}
});
function validate_password() {
 
 var pass = document.getElementById('New_password').value;
 var confirm_pass = document.getElementById('Confirm_password').value;
 if (pass != confirm_pass) {
     document.getElementById('wrong_pass_alert').style.color = 'red';
     document.getElementById('wrong_pass_alert').innerHTML
         = '☒ Use same password';
     document.getElementById('Change_password').disabled = true;
     document.getElementById('Change_password').style.opacity = (0.4);
     return false;
 } else {
     document.getElementById('wrong_pass_alert').style.color = 'green';
     document.getElementById('wrong_pass_alert').innerHTML =
         '🗹 Password Matched';
     document.getElementById('Change_password').disabled = false;
     document.getElementById('Change_password').style.opacity = (1);
 }
}

</script>
</body>
</html>