</div>
<footer
class="text-center text-lg-start text-white mt-5 bg-white border-top"
>

<div class="container p-4 pb-0 ">

<section >
<!--Grid row-->
<div class="row ">
<!--Grid column-->
<div class="col-lg-4 col-md-6 mb-4 mb-md-0 pr-5" style="padding-right: 5%;">
  <h5 class="text-uppercase text-color pr-5">
    <img src="<?=ASSETS_PATH;?>/images/logo.png" class="w-100 pr-5">
  </h5>
  <p class="text-danger" style="text-align: justify;">
    <b>
    <?php echo $this->lang->line('Footer_About');?>
    </b>
  </p>
</div>
<!--Grid column-->

<!--Grid column-->
<div class="col-lg-4 col-md-6 mb-4 mb-md-0 mt-4">
  <h5 class="text-uppercase text-color"><?php echo $this->lang->line('Use_full_Links');?> </h5>
  <ul class="list-unstyled mb-0">
    <li>
      <a href="<?=base_url('/');?>" class="text-color"><?php echo $this->lang->line('Home');?> </a>
    </li>
    <li>
      <a href="<?=base_url('home/aboutus');?>" class="text-color"><?php echo $this->lang->line('About_Us');?> </a>
    </li>

    <li>
      <a href="<?=base_url('home/contactus');?>" class="text-color"><?php echo $this->lang->line('Contact_Us');?> </a>
    </li>

    <li>
      <a href="<?=base_url('Blogs/');?>" class="text-color"><?php echo $this->lang->line('Blog');?> </a>
    </li>

    <li>
      <a href="<?=base_url('home/referral');?>" class="text-color"><?php echo $this->lang->line('Referral_Friends');?> </a>
    </li>
  </ul>
</div>
<!--Grid column-->

<!--Grid column-->
<div class="col-lg-4 col-md-6 mb-4 mb-md-0 mt-4">
  <h5 class="text-uppercase text-color"><?php echo $this->lang->line('Legal');?></h5>

  <ul class="list-unstyled mb-0">
    <li>
      <a href="<?=base_url('home/teams_conditions');?>" class="text-color"><?php echo $this->lang->line('TERMS_AND_CONDITIONS');?></a>
    </li>
    <li>
      <a href="<?=base_url('home/privacy_policy');?>" class="text-color"><?php echo $this->lang->line('PRIVACY_POLICY');?> </a>
    </li>
  
  </ul>
</div>
<!--Grid column-->

<!--Grid column-->
<!-- <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
  <h5 class="text-uppercase text-color"><?php echo $this->lang->line('Links');?></h5>

  <ul class="list-unstyled mb-0">
    <li>
      <a href="#" class="text-color"><?php echo $this->lang->line('Link');?> 1</a>
    </li>
    <li>
      <a href="#" class="text-color"><?php echo $this->lang->line('Link');?> 2</a>
    </li>
    <li>
      <a href="#" class="text-color"><?php echo $this->lang->line('Link');?> 3</a>
    </li>
    <li>
      <a href="#" class="text-color"><?php echo $this->lang->line('Link');?> 4</a>
    </li>
  </ul>
</div> -->
<!--Grid column-->

<!--Grid column-->
<!-- <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
  <h5 class="text-uppercase text-color"><?php echo $this->lang->line('Links');?></h5>

  <ul class="list-unstyled mb-0">
    <li>
      <a href="#" class="text-color"><?php echo $this->lang->line('Link');?> 1</a>
    </li>
    <li>
      <a href="#" class="text-color"><?php echo $this->lang->line('Link');?> 2</a>
    </li>
    <li>
      <a href="#" class="text-color"><?php echo $this->lang->line('Link');?> 3</a>
    </li>
    <li>
      <a href="#" class="text-color"><?php echo $this->lang->line('Link');?> 4</a>
    </li>
  </ul>
</div> -->
<!--Grid column-->
</div>
<!--Grid row-->
</section>
<!-- Section: Links -->

<hr class="mb-4" />
<?php 
  if(empty($this->session->userdata('sgUser'))){
?>
<!-- Section: CTA -->
<section class="">
<p class="d-flex justify-content-center align-items-center">
<span class="me-3 text-color"><?php echo $this->lang->line('Register_for_free');?></span>
<button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-outline-light btn-rounded text-color">
<?php echo $this->lang->line('Sign_up');?>!
</button>
</p>
</section>
<!-- Section: CTA -->

<hr class="mb-4" />
<?php } ?>
<!-- Section: Social media -->
<section class="mb-4 text-center">
<!-- Facebook -->
<a
 class="btn btn-outline-light btn-floating m-1"
 href="#"
 role="button"
 ><i class="fab fa-facebook-f text-color"></i
></a>

<!-- Twitter -->
<a
 class="btn btn-outline-light btn-floating m-1"
 href="#"
 role="button"
 ><i class="fab fa-twitter text-color"></i
></a>

<!-- Google -->
<a
 class="btn btn-outline-light btn-floating m-1"
 href="#"
 role="button"
 ><i class="fab fa-google text-color"></i
></a>

<!-- Instagram -->
<a
 class="btn btn-outline-light btn-floating m-1"
 href="#"
 role="button"
 ><i class="fab fa-instagram text-color"></i
></a>

<!-- Linkedin -->
<a
 class="btn btn-outline-light btn-floating m-1"
 href="#"
 role="button"
 ><i class="fab fa-linkedin-in text-color"></i
></a>


</section>
<!-- Section: Social media -->
</div>
<!-- Grid container -->

<!-- Copyright -->
<div
class="text-center p-3 text-color "
>
© 2021 <?php echo $this->lang->line('Copyright');?> :
<a class="text-color text-decoration-none" href="#"
><?php echo $this->lang->line('Share_Get');?></a
>
<br>
<span class="text-color "><?php echo $this->lang->line('Developed_by');?> <a  class=" text-color" href="www.venkateshponraj.tech">venkatesh ponraj</a></span>
</div>
<!-- Copyright -->
</footer>


  <!-- boostrap 5 js links -->
  <script src="<?=ASSETS_PATH;?>/bootstrap-5.1.1-dist/js/popper.min.js"></script>
  <script src="<?=ASSETS_PATH;?>/bootstrap-5.1.1-dist/js/bootstrap.min.js"></script>
  <!-- coustom js  -->
  <script src="<?=ASSETS_PATH;?>/js/app.js"></script>
  <script src="<?=ASSETS_PATH;?>/js/jquery-3.3.1.min.js"></script>

  <script>
            
    function validationform(){
      var userId = document.getElementById("User-Id").value.trim();
      var userId_er = document.getElementById("User-Id-al");
      var phoneNumber = document.getElementById("phone-Number").value.trim();
      var phonenumberal = document.getElementById("phone-number-al");
      var Email = document.getElementById("E-mail").value;
      var Emailal = document.getElementById("E-mail-al");
      var Password = document.getElementById("Password").value.trim();
      var Password_er =  document.getElementById("Password-al");
      var ConfirmPassword = document.getElementById("Confirm-Password").value.trim();
      var Confirmpasswordal = document.getElementById("Confirm-Password-al");
      var check = document.getElementById("check");
      var checkal = document.getElementById("check-al");
      var otp = document.getElementById("otp").value.trim();
      var otpal= document.getElementById("otp-al");
      var valid1 = valid2 = valid3 = valid4 = valid5 = valid6 = valid7 = valid8 = 0;
      // user-id
      if (userId.length < 6){    
        userId_er.innerHTML = "Need atleast 6 chracter";
        userId_er.style.color="red"
        userId_er.style.fontSize="14px"
      }
      else {
        userId_er.innerHTML = "";
        valid1 = 1;
      }

      // otp 
      if (otp==''|| otp=='undefined' || otp.length < 6 || otp.length > 6){    
        otpal.innerHTML = "OTP need to enter with 6 chracters";
        otpal.style.color="red"
        otpal.style.fontSize="14px"
      }
      else {
        otpal.innerHTML = "";
        valid2 = 1;
      }

      //  phoneNumber
      if (phoneNumber.length != 10 ) {
        phonenumberal.innerHTML="number must be in 10 digits";
        phonenumberal.style.color="red"
        phonenumberal.style.fontSize="14px"
      }
      else{
        phonenumberal.innerHTML=""
        valid3 = 1;
      }
      if (Email.match(/^([a-z0-9]+)@([a-zA-Z]+).([a-z]{2,8})$/)){
        Emailal.innerHTML="";
        valid4 = 1;
      }
      else{
        Emailal.innerHTML="Email is invalid"
        Emailal.style.color="red"
        Emailal.style.fontSize="14px"
      }
      // Password
      if (Password.length < 8){
        Password_er.innerHTML = "Password should be minimum 8 chracters";
        Password_er.style.color="red"
        Password_er.style.fontSize="14px"
      }
      else{
        Password_er.innerHTML = "";
        valid5 = 1;
        // Password
        if (!Password.match(/[a-z]/g) || !Password.match(/[A-Z]/g) || !Password.match(/[0-9]/g) || !Password.match(/[^a-zA-Z\d]/g) || !Password.length >= 8 ){
          Password_er.innerHTML = 'Need atleast one number, special, upper and lower character';
          Password_er.style.color="red"
          Password_er.style.fontSize="14px"
        }
        else{
          Password_er.innerHTML = "";
          valid6 = 1;
        }
      }
      
      // ConfirmPassword
      if (Password != ConfirmPassword) {
        Confirmpasswordal.innerHTML = "password not matched";
        Confirmpasswordal.style.color="red"
        Confirmpasswordal.style.fontSize="14px"
      }
      else{
        Confirmpasswordal.innerHTML="";
        valid7 = 1;
      }
      // cheakbox
      if (check.checked == false){
        checkal.innerHTML="check the checkbox"
        checkal.style.color="red"
        checkal.style.fontSize="14px"
      }
      else{
        checkal.innerHTML="";
        valid8 = 1;
      }
      
      if(valid1 == 1 && valid2 == 1 && valid3 == 1 && valid4 == 1 && valid5 == 1 && valid6 == 1 && valid7 == 1 && valid8 == 1){
        // $('#register_check').hide();
        // $('#register_btn').show();
        // $('#register_btn').click();
        return true;
      }else{
        $('#register_btn').show();
        return false;
      }

    }

    // Mano Mahe
    $('.alert').delay(6800).fadeOut(300);
    function closeshownAlert(){
      $('.alert').hide();
    }

    function sendOTP(){
      var phonenumberal = document.getElementById("phone-number-al");
      var Emailal = document.getElementById("E-mail-al");
      var phone = document.getElementById("phone-Number").value;
      var email = document.getElementById("E-mail").value;
      var otpal = document.getElementById("otp-al");
      
      if (phone.length != 10 ) {
        phonenumberal.innerHTML="Phone number must be in 10 digits";
        phonenumberal.style.color="red"
        phonenumberal.style.fontSize="14px"
      }
      else{
        phonenumberal.innerHTML=""
      }
      if (email.match(/^([a-z0-9]+)@([a-zA-Z]+).([a-z]{2,8})$/)){
        Emailal.innerHTML="";
      }
      else{
        Emailal.innerHTML="Email is invalid"
        Emailal.style.color="red"
        Emailal.style.fontSize="14px"
      }
      
      if(phone==""|| email=="" || phonenumberal.innerHTML!="" || Emailal.innerHTML!="" || phonenumberal.innerHTML=="undefined" || Emailal.innerHTML=="undefined"){
        otpal.innerHTML = "Mobile/Email need to be fill properly..!";
        otpal.style.color="red";
        otpal.style.fontSize="14px";
        $("#get_otp").show();
        $("#resend_otp").hide();
      }else{
        otpal.innerHTML = "OTP sent please check your mobile/email..!";
        otpal.style.color="green";
        otpal.style.fontSize="14px";
        $("#resend_otp").show();
        $("#get_otp").hide();
        $("#otp").attr('disabled', false);
      }
    }

    function resendOTP(){
      var phonenumberal = document.getElementById("phone-number-al");
      var Emailal = document.getElementById("E-mail-al");
      var phone = document.getElementById("phone-Number").value;
      var email = document.getElementById("E-mail").value;
      var otpal= document.getElementById("otp-al");
      
      if (phone.length != 10 ) {
        phonenumberal.innerHTML="Phone number must be in 10 digits";
        phonenumberal.style.color="red"
        phonenumberal.style.fontSize="14px"
      }
      else{
        phonenumberal.innerHTML=""
      }
      if (email.match(/^([a-z0-9]+)@([a-zA-Z]+).([a-z]{2,8})$/)){
        Emailal.innerHTML="";
      }
      else{
        Emailal.innerHTML="Email is invalid"
        Emailal.style.color="red"
        Emailal.style.fontSize="14px"
      }
      
      if(phone==""|| email=="" || phonenumberal.innerHTML!="" || Emailal.innerHTML!="" || phonenumberal.innerHTML=="undefined" || Emailal.innerHTML=="undefined"){
        otpal.innerHTML = "Mobile/Email need to be fill properly..!";
        otpal.style.color="red";
        otpal.style.fontSize="14px";
        $("#get_otp").show();
        $("#resend_otp").hide();
      }else{
        otpal.innerHTML = "OTP sent again, please check your mobile/email..!";
        otpal.style.color="green";
        otpal.style.fontSize="14px";
        $("#resend_otp").show();
        $("#get_otp").hide();
      }
    }

   

    function get_subcategories(c) {
      var cate = c.value;
      $("#expiry_date").text('');
      $.ajax({
        url: "<?=base_url('home/get_subcategory/')?>"+cate,
        data: {},
        type: "post",
        success: function(data){
          var data = JSON.parse(data);
          $("#expiry_date").text('Product will be expired at - '+data.expiry);
          data = data.data;
          var html = '<option value="" disabled selected>Choose an option</option>';
          var i;
          for(i=0; i<data.length; i++){
            html += '<option value='+data[i].id+'>'+data[i].sub_cate_name+'</option>';
          }
          $('#sub_category').html(html);
        }
      });
    }

    function edit_get_subcategories(c) {
      var cate = c.value;
      $.ajax({
        url: "<?=base_url('home/get_subcategory/')?>"+cate,
        data: {},
        type: "post",
        success: function(data){
          var data = JSON.parse(data);
          var html = '<option value="" disabled selected>Choose an option</option>';
          var i;
          for(i=0; i<data.length; i++){
            html += '<option value='+data[i].id+'>'+data[i].sub_cate_name+'</option>';
          }
          $('#edit_sub_category').html(html);
        }
      });
    }



    function showNotification(nid){
      $(".hide-notify").hide();
      $.ajax({
        url: "<?=base_url('home/notified')?>",
        data: {nid:nid},
        type: "post",
        success: function(data){
          $("#notifyAlter").load(location.href + " #notifyAlter");
          $('#notifications').modal('show');
          $(".show_notify_"+nid).slideDown();
        }
      });
    }

    function get_city(c) {
      var city = c.value;
      $("#Cities").text('');
      $.ajax({
        url: "<?=base_url('home/city/')?>"+city,
        data: {},
        type: "post",
        success: function(datavalue){
          var data_temp = JSON.parse(datavalue);
          var data = data_temp.city;
          var html = '<option value="" disabled selected>Choose an option</option>';
          var i;
          for(i=0; i<data.length; i++){
            html += '<option value='+data[i].name+'>'+data[i].name+'</option>';
          }
          $('#Cities').html(html);
        }
      });
    }
    
  </script>
<script type="text/javascript">
  function locationValue(){
    setTimeout(() => {
    var $location = $("#Location").val();
    var $category = $("#Find").val();
    if($location != "" || $category != ''){
    $.ajax({
      url: "<?=base_url('items/search_location')?>",
      data: {
        location:$location,
        category:$category
      },
      type: "post",
      success: function(data){
        $('.products_list').html(data);
      }
    });}else{
      get_products();
    }
    
    }, 500);
   
  }
</script>

</body>
</html>