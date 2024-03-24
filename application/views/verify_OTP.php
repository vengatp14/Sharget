<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>OTP Verification</title>
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
   <style>
    /* Import Google font - Poppins */
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
body {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #4a72b8;
}
:where(.container, form, .input-field, header) {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
.otp-card {
  text-align: center;
  background: #fff;
  padding: 30px 65px;
  border-radius: 12px;
  row-gap: 20px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}
.otp-card header {
  height: 65px;
  width: 65px;
  background: #4070f4;
  color: #fff;
  font-size: 2.5rem;
  border-radius: 50%;
}
.otp-card h4 {
  font-size: 1.25rem;
  color: #333;
  font-weight: 500;
}
form .input-field {
  flex-direction: row;
  column-gap: 10px;
}
.input-field input {
  height: 45px;
  width: 42px;
  border-radius: 6px;
  outline: none;
  font-size: 1.125rem;
  text-align: center;
  border: 1px solid #ddd;
}
.input-field input:focus {
  box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
}
.input-field input::-webkit-inner-spin-button,
.input-field input::-webkit-outer-spin-button {
  display: none;
}
form button {
  margin-top: 25px;
  width: 100%;
  color: #fff;
  font-size: 1rem;
  border: none;
  padding: 9px 0;
  cursor: pointer;
  border-radius: 6px;
  transition: all 0.2s ease;
}
.verify{
     background: #4070f4;
     pointer-events: auto;
}
.resend{
     background: #f44040;
     pointer-events: auto;
}

.verify:hover {
  background: #0e4bf1;
}

.resend:hover {
  background: #dd1616;
}
   </style>
  </head>
  <body>
    <div class="otp-card">
      <img style=" width: 200px;" src="<?=ASSETS_PATH;?>/images/logo.png" class="img-fluid" alt="free food">
      <h4>Enter OTP Code</h4>
      <form action="<?=base_url('home/validate_otp/')?><?php echo $email_id;?>" method="POST">
        <div class="input-field">
          <input type="number" name="a"/>
          <input type="number" disabled name="b"/>
          <input type="number" disabled name="c"/>
          <input type="number" disabled name="d"/>
          <input type="number" disabled name="e"/>
          <input type="number" disabled name="f"/>
        </div>
        <button type="submit" id="verify" class="btn btn-primary my-3">Verify OTP</button>
        <a href="<?= base_url(); ?>home/resend_otp/<?php echo $email_id;?>" id="resend" class="btn btn-success">Resend OTP</a>
      </form>
      <!-- <p style="text-align: center;"><?php echo $email_id;?></p> -->
      
      
    </div>
    <script>
        const inputs = document.querySelectorAll("input"),
  button = document.getElementById("verify");
  button.classList.add("disabled");
  
inputs.forEach((input, index1) => {
  input.addEventListener("keyup", (e) => {
    // This code gets the current input element and stores it in the currentInput variable
    // This code gets the next sibling element of the current input element and stores it in the nextInput variable
    // This code gets the previous sibling element of the current input element and stores it in the prevInput variable
    const currentInput = input,
      nextInput = input.nextElementSibling,
      prevInput = input.previousElementSibling;
    // if the value has more than one character then clear it
    if (currentInput.value.length > 1) {
      currentInput.value = "";
      return;
    }
    // if the next input is disabled and the current value is not empty
    //  enable the next input and focus on it
    if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
      nextInput.removeAttribute("disabled");
      nextInput.focus();
    }
    // if the backspace key is pressed
    if (e.key === "Backspace") {
      // iterate over all inputs again
      inputs.forEach((input, index2) => {
        // if the index1 of the current input is less than or equal to the index2 of the input in the outer loop
        // and the previous element exists, set the disabled attribute on the input and focus on the previous element
        if (index1 <= index2 && prevInput) {
          input.setAttribute("disabled", true);
          input.value = "";
          prevInput.focus();
        }
      });
    }
    //if the fourth input( which index number is 3) is not empty and has not disable attribute then
    //add active class if not then remove the active class.
    if (!inputs[5].disabled && inputs[5].value !== "") {
      
      button.classList.remove("disabled");
      return;
    }
    button.classList.add("disabled");
  });
});
//focus the first input which index is 0 on window load
window.addEventListener("load", () => inputs[0].focus());
console.log(inputs.values);
    </script>
  </body>
</html>