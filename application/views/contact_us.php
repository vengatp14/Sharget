<?php
$this->load->view('common/header');
?>

<div class="container-lg">
	<h2 class="text-center mb-5"><?php echo $this->lang->line('Contact_Us');?></h2>

	<form class="row g-3 needs-validation" novalidate action="<?=base_url('home/contactus')?>" method="post">
	  <div class="col-md-4 col-lg-4 col-sm-12">
	    <label for="validationCustomUsername" class="form-label"><?php echo $this->lang->line('Registered_Email');?></label>
	    <div class="input-group has-validation">
	      <span class="input-group-text" id="inputGroupPrepend">@</span>
	      <input type="email" name="email" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required onblur="get_username(this)" value="<?=$email?>">
	      <div class="invalid-feedback">
		  <?php echo $this->lang->line('Please_enter_your_registered_email');?>
	      </div>
	    </div>
	      <p class="text-danger hide" id="username_wrong" style="display: none;">
		  <?php echo $this->lang->line('Email_not_found_please_enter_your_registered_email_only');?>
	      </p>
	  </div>
	  <div class="col-md-4 col-lg-4 col-sm-12">
	    <label for="validationCustom03" class="form-label"><?php echo $this->lang->line('Mobile_Number');?></label>
	    <input type="number" name="phone" class="form-control" id="validationCustom03" required value="<?=$phone?>">
	    <div class="invalid-feedback">
		<?php echo $this->lang->line('Please_provide_a_valid_mobile_number');?>
	    </div>
	    <div id="phone-number-al"></div>
	  </div>
	  <div class="col-md-4 col-lg-4 col-sm-12">
	    <label for="validationCustom04" class="form-label"><?php echo $this->lang->line('Full_name');?></label>
	    <input type="text" name="name" class="form-control" id="validationCustom04" required value="<?=$name?>">
	    </input>
	    <div class="invalid-feedback">
		<?php echo $this->lang->line('Please_select_a_valid_Email_Id');?>
	    </div>
	  </div>
	  <div class="col-md-12 col-lg-12 col-sm-12">
	    <label for="validationCustom05" class="form-label"><?php echo $this->lang->line('Type_Your_Message');?></label>
	    <textarea type="text" name="msg" class="form-control" id="validationCustom05" required></textarea>
	    <div class="invalid-feedback">
		<?php echo $this->lang->line('Type_Your_Message');?>
	    </div>
	  </div>
	  <div class="col-12 text-end">
	  	<input type="hidden" id="user_id" name="user_id" value="<?=$user_id?>">
	    <button class="btn btn-success" disabled type="submit" id="submitbtn"><?php echo $this->lang->line('Submit');?></button>
	  </div>
	</form>

</div>

<?php $this->load->view('common/footer'); ?>
<script>
	function get_username(un) {
    $("#username_wrong").hide();
    $("#phone-number-al").text('');
    $("#submitbtn").attr('disabled', false);
		$.ajax({
			url : "<?=base_url('home/contact_username/')?>",
			data: {
        email : un.value
      },
      type: "post",
      success: function(data){
      	if(data==0){
        	$("#username_wrong").show();
        	$("#submitbtn").attr('disabled', true);
        }else{
        	var disp = JSON.parse(data);
					$("#validationCustom03").val(disp[0].phone);
					$("#validationCustom04").val(disp[0].username);
					$("#user_id").val(disp[0].id);
        }
      }
		});
	}

	function checInputs(){
		var email = $("#validationCustomUsername").val();
		var phone = $("#validationCustom03").val();
		var name = $("#validationCustom04").val();
		var user_id = $("#user_id").val();
		if(email!=""&&phone!=""&&name!=""&&user_id!=""){
			get_username(document.getElementById('validationCustomUsername'));
			console.log(email);
		}
	}

    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.prototype.slice.call(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }
            var phoneNumber = document.getElementById("validationCustom03").value.trim();
      			var phonenumberal = document.getElementById("phone-number-al");
      			if (phoneNumber.length != 10 ) {
			        phonenumberal.innerHTML="Pumber must be in 10 digits";
			        phonenumberal.style.color="red"
			        phonenumberal.style.fontSize="14px"
			      }
			      else{
			        phonenumberal.innerHTML=""
			      }
            form.classList.add('was-validated')
          }, false)
        })
    })();
  setTimeout(function(){
  	checInputs();
  }, 800);
</script>