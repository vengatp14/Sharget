<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="robots" content="noindex,nofollow">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- SEO  -->
  <meta name="keywords" 
       content="freefood, freeclothes, freedress, getshare, getfree, withoutmoney, nomoney, donatepoor, wastethings, donateall, blooddonation ">
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.js" integrity="sha512-OrFi/o1Q/S2pE3BW4onymzI8UXBwYLwaM64Dsp9Oe1LzC23Nh4pC8c8cJ1M8SmjErNEgMBrK5z5PNyIPxSiirg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.jquery.min.js" integrity="sha512-AnBkpfpJIa1dhcAiiNTK3JzC3yrbox4pRdrpw+HAI3+rIcfNGFbVXWNJI0Oo7kGPb8/FG+CMSG8oADnfIbYLHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- boostrap 5 css -->
  <link rel="stylesheet" href="<?=ASSETS_PATH;?>/bootstrap-5.1.1-dist/css/bootstrap.min.css">
  <title>Share Get</title>
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
  <style>
 
    div.scrollmenu {
      overflow: auto;
      white-space: nowrap;
    }
    
    div.scrollmenu a {
      display: inline-block;
      color: white;
      text-align: center;
      padding: 14px;
      text-decoration: none;
    }
    
    div.scrollmenu a:hover {
      background-color: #4a72b850;
    }

    .main-scroll::-webkit-scrollbar {
      width: 10px;
    }
    
    /* Track */
    .main-scroll::-webkit-scrollbar-track {
      box-shadow: inset 0 0 5px #4a72b8; 
      border-radius: 10px;
    }
     
    /* Handle */
    .main-scroll::-webkit-scrollbar-thumb {
      background: #4a72b8; 
      border-radius: 10px;
    }
    
    /* Handle on hover */
    .main-scroll::-webkit-scrollbar-thumb:hover {
      background: #6d84ac; 
    }
    .labbel-hidden{
      background-color:#0275d8;
      color: white;
      padding: 0.5rem;
      font-family: sans-serif;
      border-radius:0em 0.3em  0.3rem 0em;
      cursor: pointer;
      height: 100%;
    }
    .w80{
      overflow-x: hidden;
      text-overflow: ellipsis;
      margin-bottom: 0;
    }
    .hide-notify{
      display: none;
    }
    .notify-desc{
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
    }
    /* venkatesh  */
        .navbar-light .navbar-nav .nav-link {
      color:#4a72b8;
    }
    .text-color{
      color:#4a72b8;
    }
    .placeholder::placeholder{
      color: #4a72b8;
      background-color:transparent;
    }
    .form-control {
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #4a72b8;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px
     solid #ced4da;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border-radius: 0.25rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    .border-line{
      border-bottom:1px solid #4a72b8;
    }
    .border-line-tandb{
      border-bottom:1px solid #4a72b8;
      border-top:1px solid #4a72b8;
    }
    .box-shad, .comments_blog{
      box-shadow: 0px 7px 10px 3px rgba(74,114,184,0.3);
      -webkit-box-shadow: 0px 7px 10px 3px rgba(74,114,184,0.3);
      -moz-box-shadow: 0px 7px 10px 3px rgba(74,114,184,0.3);
    }
    .text-color{
      color:#4a72b8;
    }
    div.scrollmenu a {
        display: inline-block;
        color: #4a72b8;
        text-align: center;
        padding: 14px;
        text-decoration: none;
    }
    /* venkatesh  */
    .product_title{
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .easy-autocomplete {
    position: relative;
    width: 100% !important;
}
  </style>
</head>
<body>
  <!-- <button onclick="topFunction()" id="myBtn" title="Go to top"> <i class="fas fa-plus"></i>  Donate </button> -->
  
 
   <!-- nav bar  -->
   <div class="sticky-top">
   <nav class="navbar navbar-expand-lg navbar-light bg-white ">
    <div class="container-fluid">
      <a href="<?=base_url();?>"> <img style=" width: 170px;padding-right: 20px; " src="<?=ASSETS_PATH;?>/images/logo.png" class="img-fluid" alt="free food"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll " >
      </ul>
        <div class="d-flex">
          <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll w-100" >

          <?php
            if(current_url() != base_url('home') && current_url() != base_url()){
          ?>
            <li class="nav-item">
              <a class="nav-link text-color mt-2" href="<?=base_url()?>">
                <i class="fas fa-home"></i> <?php echo $this->lang->line('Home');?>
              </a>
            </li>
        <?php } 
        	if(!empty($this->session->userdata('sgUser'))){
        ?>
          <button data-bs-toggle="modal" data-bs-target="#exampleModal-post" id="myBtn" title="Go to top"> <i class="fas fa-plus"></i>  <?php echo $this->lang->line('Donate');?> </button>
          <!-- onclick="topFunction()" -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-color mt-2 " href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="far fa-user"></i><?php echo $this->lang->line('Profile');?>
            </a>
            <ul class="dropdown-menu " aria-labelledby="navbarScrollingDropdown">
              <li>
                <a class="dropdown-item text-color" href="<?=base_url('home/profile')?>">
                  <i class="fas fa-user-edit fa-sm"></i><?php echo $this->lang->line('Edit_Profile');?>
                </a>
              </li>
              <li>
                <a class="dropdown-item text-color" href="<?=base_url('home/posts')?>">
                  <i class="fas fa-book-open fa-sm"></i>&nbsp; <?php echo $this->lang->line('Posts');?>
                </a>
              </li>
              <li>
                <a class="dropdown-item text-color" href="<?=base_url('home/wishlist')?>">
                  <i class="fas fa-bookmark fa-sm"></i> &nbsp; <?php echo $this->lang->line('Wish_lists');?>
                </a>
              </li>
              <li>
                <a class="dropdown-item text-color" href="<?=base_url('home/referral');?>">
                  <i class="fas fa-users" style="font-size: .75rem;"></i>&nbsp; <?php echo $this->lang->line('Referral_Friends');?> </a>
              </li>
              <li>
                <a class="dropdown-item text-danger fw-bold" href="<?=base_url('home/logout')?>">
                  <i class="far fa-times-circle text-danger fw-bold"></i>&nbsp; <?php echo $this->lang->line('Logout');?>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item" id="notifyAlter">
            <!-- <a class="nav-link dropdown-toggle text-color" href="javascript:void(0);"role="button" data-bs-toggle="dropdown" aria-expanded="false"> -->
            <a class="nav-link text-color" href="<?php echo base_url('home/notifications'); ?>" role="button" aria-expanded="false">
              <button type="button" class="btn btn-white position-relative">
                <i class="far fa-bell text-color"></i>
                <?php
                  $uid = $this->session->userdata('sg_user_id');
                  $notify = $this->db->where(array('is_seen'=>1, 'sent_to'=>$uid))->group_by('token')->order_by('id', 'desc')->get('tbl_notifications');
                  if($notify->num_rows() > 0){
                ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <?php echo $this->lang->line('New');?>
                  <span class="visually-hidden"><?php echo $this->lang->line('unread_messages');?></span>
                </span>
                <?php } ?>
              </button>
            </a>

        </li>
  			<li class="nav-item">
  				<a class="nav-link text-color mt-2" href="<?=base_url('chat')?>"><i class="fas fa-envelope"></i> <?php echo $this->lang->line('Chat');?></a>
  			</li>
  			<li data-bs-toggle="modal" data-bs-target="#exampleModal-post" class="nav-item ">
  				<a class="nav-link text-color mt-2 "  href="#"><i class="fas fa-hand-holding-usd"></i> <?php echo $this->lang->line('Donate');?></a>
  			</li>
        <!--<li data-bs-toggle="modal" data-bs-target="#blood_req" class="nav-item">-->
        <!--  <a class="nav-link mt-2" href="javascript:void(0);"><i class="fas fa-id-card"></i> <?php echo $this->lang->line('Blood_Request');?></a>-->
        <!--</li>-->
        <?php }else{ ?>

            <a onclick="topFunction()"  data-bs-toggle="modal" data-bs-target="#exampleModal" id="myBtn" title="Go to top"> <i class="fas fa-plus"></i>  <?php echo $this->lang->line('Donate');?> </a>

            <li class="nav-item ">
              <a class="nav-link nav-footer-text mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#"><i class="fas fa-sign-in-alt"></i> <?php echo $this->lang->line('Login');?></a>
            </li>
            <li class="nav-item ">
              <a class="nav-link mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal"  href="#"><i class="fas fa-hand-holding-usd"></i> <?php echo $this->lang->line('Donate');?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link mt-2" href="<?=base_url('home/referral');?>"><i class="fas fa-users"></i> <?php echo $this->lang->line('Referral_Friends');?> </a>
            </li>
        <?php } ?>
            <li class="nav-item">
                <a class="nav-link mt-2" data-bs-toggle="modal" data-bs-target="#exampleModalcategory" href="#"><i class="fas fa-clipboard-list"></i> <?php echo $this->lang->line('Category');?></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle mt-2" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-language"></i> <?php echo $this->lang->line('Language');?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                  <li><a class="dropdown-item text-color" href="<?=base_url('LanguageSwitcher/switchLang/hindi');?>"><?php echo $this->lang->line('Hindi');?></a></li>
                  <li><a class="dropdown-item text-color" href="<?=base_url('LanguageSwitcher/switchLang/english');?>"><?php echo $this->lang->line('English');?></a></li>
                </ul>
            </li>

            <li class="nav-item">
              <a class="nav-link mt-2" href="<?=base_url('blogs');?>"><i class="fas fa-blog"></i> <?php echo $this->lang->line('Blog');?></a>
            </li>
            <li class="nav-item ">
              <a class="nav-link mt-2" href="<?=base_url('home/contactus');?>"><i class="fas fa-id-card"></i> <?php echo $this->lang->line('Contact_Us');?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link mt-2" href="<?=base_url('home/aboutus');?>"><i class="fas fa-handshake"></i> <?php echo $this->lang->line('About_Us');?></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div>
      
    </div>
  </nav>
  <?php
            if(current_url() == base_url('home') || current_url() == base_url()){
          ?>
    <nav class="d-flex bg-white border-line box-shad ">
      <div class="col-6 p-1 mb-2">
        <input type="text" id="Location" class="form-control me-2 navbar-brand placeholder" placeholder="<?php echo $this->lang->line('Location');?>" aria-label="Location" onkeyup="locationValue()" onchange="locationValue()"/>
        <!-- <input name="location" id="location" class="form-control me-2 navbar-brand placeholder" type="search" placeholder="<?php echo $this->lang->line('Location');?>" aria-label="Search" onkeyup="filter_locat(this)" onfocus="$('#locat-filter').show()" onblur="$('#locat-filter').hide()">
        <div class="filter hideit" id="locat-filter"></div> -->
      </div>
      <div class="col-6 p-1 mb-2">
      <input type="text" id="Find" class="form-control me-2 navbar-brand placeholder" placeholder="<?php echo $this->lang->line('Find_food_clothes_and_more');?>" aria-label="find" onchange="locationValue()"/>
          <!-- <input name="find" id="find" class="form-control me-2 navbar-brand placeholder" type="search" placeholder="<?php echo $this->lang->line('Find_food_clothes_and_more');?>" aria-label="Search" onkeyup="filter(this)" onfocus="$('#search-filter').show()" onblur="$('#search-filter').hide()">
        <div class="filter hideit" id="search-filter"></div> -->
      </div>
    </nav>
    <?php } 
        ?>
  </div>
<!-- nav bar end -->
<script>
    var loc = {
      url: function(locat){
        return "home/get_locations/"+locat
      }
    };
   $("#Location").easyAutocomplete(loc);


   var category = {
    url: function(category){
        return "home/search_products/"+category
      }
    };
   $("#Find").easyAutocomplete(category);

  </script>
 
<!-- Modal  category-->
<div class="modal fade" id="exampleModalcategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $this->lang->line('Categories');?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <?php
            $all_cates = $this->common_model->get_all_cate();
            for ($c = 0; $c < count($all_cates); $c++) {
              $all_sub = $all_cates[$c]['subcate'];
          ?>
            <div class="col-lg-3 col-md-6 col-sm-12">
              <a href="<?php echo base_url('items/cate/'.$all_cates[$c]['cate_id']); ?>" style="text-decoration: none;">
                <h5><?php echo $all_cates[$c]['cate_name']; ?></h5>
              </a>
              <ul class="list-unstyled">
                <?php foreach ($all_sub as $sc): ?>
                  <li>
                    <a href="<?php echo base_url('items/sub/'.$sc->id); ?>" class="btn p-1">
                      <?php echo $sc->sub_cate_name; ?>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal  category-->

<?php 
  if(empty($this->session->userdata('sgUser'))){
?>
<!-- Modal login $ register-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?php echo $this->lang->line('Welcome');?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><?php echo $this->lang->line('Login');?></button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><?php echo $this->lang->line('Register');?></button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-forget" type="button" role="tab" aria-controls="pills-forget" aria-selected="false"><?php echo $this->lang->line('Forget_password');?></button>
                </li>
              </ul>
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                  <form action="<?=base_url('home/login')?>" method="POST">
                        <div class="mb-3">
                          <label class="form-label"><?php echo $this->lang->line('Email_address_or_Mobile_number');?></label>
                          <input type="text" class="form-control" aria-describedby="emailHelp" required name="mailPhone">
                          <div id="emailHelp" class="form-text"><?php echo $this->lang->line('We_never_share_your_email_with_anyone_else');?></div>
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label"><?php echo $this->lang->line('Password');?></label>
                          <input type="password" class="form-control" id="exampleInputPassword1" required name="password">
                        </div>
                      
                        <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('Login');?></button>
                  </form>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                  <form action="<?=base_url('home/signup')?>" method="POST" id="register_form">
                        <div class="mb-3">
                          <label class="form-label"><?php echo $this->lang->line('User_Name');?></label>
                          <input type="text" class="form-control" id="User-Id" name="username" required>
                          <div id="User-Id-al"></div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label"><?php echo $this->lang->line('Mobile_number');?> </label>
                          <input type="text" class="form-control" id="phone-Number" name="phone" required>
                          <div id="phone-number-al"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="G-Mail"><?php echo $this->lang->line('Email_address');?></label>
                            <input class="form-control" id="E-mail" type="mail" name="email" required>
                            <div id="E-mail-al"></div>
                        </div>
                        <!-- <div class="mb-3 d-flex justify-content-between">
                         <div>
                          <label class="form-label" for="otp"><?php echo $this->lang->line('OTP');?></label>
                          <input class="form-control" id="otp" type="text" name="otp" required disabled>
                          <div id="otp-al"></div>
                        </div>
                        <div style="margin-top: 8px;">
                          <a href="javascript:void(0);" class="btn btn-success mt-4" id="get_otp" onclick="sendOTP()"><?php echo $this->lang->line('Get_otp');?></a>
                          <a href="javascript:void(0);" class="btn btn-success mt-4" style="
                          display: none;" id="resend_otp" onclick="resendOTP()"><?php echo $this->lang->line('Resend_otp');?></a>
                         </div>
                        </div> -->
                        <div class="mb-3">
                          <label class="form-label" for="Blood">
                          <?php echo $this->lang->line('Blood_group');?> 
                            <small style="font-size: 11px; color: #f94444;">
                              ( <?php echo $this->lang->line('YOUR_BLOOD_GROUP_WILL_BE_SHOWN_IN_PUBLIC_IF_ANY_ONE_NEAR_TO_YOU_NEED_URGENTLY_BLOOD');?> )
                            </small>
                          </label>
                          <?php $bloods = $this->shareget_model->get_bloods(); ?>
                          <select class="form-control" id="Blood" required name="blood_group">
                            <option value="" disabled selected><?php echo $this->lang->line('Choose_your_blood_group');?></option>
                            <?php
                              foreach ($bloods as $bl) {
                                $sub = explode(",",$bl->sub_cate_id);
                                $sub_cate = explode(",",$bl->sub_cate);
                                for ($b=0; $b < count($sub); $b++) { 
                            ?>
                              <option value="<?=$sub[$b]?>">
                                <?=$sub_cate[$b]?>
                              </option>
                            <?php } } ?>
                          </select>
                          <div id="Blood-al"></div>
                        </div>
                       
                        <div class="mb-3">
                            <label class="form-label" for="State"><?php echo $this->lang->line('States');?></label>
                            <div class="form-group">
                                <select class="form-control" name="State" id="State" required onchange="get_city(this)">
                                    <option value="">Select State</option>
                                    <?php foreach($state as $row):?>
                                    <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                                    <?php endforeach;?>
                                </select>
                              </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="Cities"><?php echo $this->lang->line('Cities');?></label>
                            <div class="form-group">
                                <select class="form-control" name="Cities" id="Cities" required >
                                <option value="">Select Cities</option>
                                </select>
                              </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="G-Mail"><?php echo $this->lang->line('Password');?></label>
                            <input type="password" class="form-control" id="Password" name="password" required value="Aa@12345">
                            <div id="Password-al"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="Confirm-Password"><?php echo $this->lang->line('Re-enter_Password');?></label>
                            <input type="password" class="form-control" id="Confirm-Password" required value="Aa@12345">
                            <div id="Confirm-Password-al"></div>
                        </div>
                        <div class="mb-3 form-check">
                          <input type="checkbox" value="" id="check" class="form-check-input" required>
                          <label class="form-check-label" for="exampleCheck1"><a class="text-decoration-none" target="_blank" href="<?=base_url('home/teams_conditions');?>"><?php echo $this->lang->line('Terms_&_condition');?></a></label>
                          <div id="check-al"></div>
                        </div>
                        <?php $this->session->flashdata('email_send') ?>
                        <button type="submit" onclick="return validationform()" class="btn btn-primary"><?php echo $this->lang->line('Register');?></button>
                    </form>
                    </div>
                    <div class="tab-pane fade" id="pills-forget" role="tabpanel" aria-labelledby="pills-forget-tab">
                      <form action="<?=base_url('home/forgetPassword')?>" method="POST">
                        <div class="mb-3">
                          <label class="form-label"><?php echo $this->lang->line('Email_address');?></label>
                          <input type="text" class="form-control" aria-describedby="emailHelp" required name="email">
                          <div id="emailHelp" class="form-text"><?php echo $this->lang->line('We_never_share_your_email_with_anyone_else');?></div>
                        </div>                      
                        <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('Send');?></button>
                  </form>
                </div>
                </div>
              </div>
        </div>
      </div>
    </div>
  </div>
<!-- Modal login & register-->
<?php } ?>

<!-- Modal post-->
<div class="modal fade" id="exampleModal-post" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" action="<?=base_url('items/add')?>" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $this->lang->line('Add_your_product');?></h5>
      </div>
      <div class="modal-body">
     
        <div class="mb-3">
          <label for="select category"><?php echo $this->lang->line('Choose_category');?></label>
          <select class="form-select" aria-label="Default select example" required onchange="get_subcategories(this)" name="category" required>
            <option value="" disabled selected><?php echo $this->lang->line('Choose_an_option');?></option>
            <?php
              $allCate = $this->db->get('tbl_cate')->result();
              foreach ($allCate as $c):
            ?>
              <option value="<?=$c->id?>">
                <?=$c->cate_name?>
                <small> - [validity <?=$c->cate_validity?> days]</small>
              </option>
            <?php 
              endforeach;
            ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="select category"><?php echo $this->lang->line('Choose_sub_category');?></label>
          <select class="form-select" aria-label="Default select example" id="sub_category" name="sub_category" required>
            <option value="" disabled selected><?php echo $this->lang->line('Choose_a_category_to_get_sub_category');?></option>
          </select>
        </div>
        <div class="mb-3">
          <label for="name of the product"> <?php echo $this->lang->line('Product_name');?></label>
          <input type="text" class="f orm-control" required name="pname">
        </div>
        <div class="mb-3">
          <label for="name of the product"> <?php echo $this->lang->line('Product_description');?></label>
          <textarea type="text" class="form-control" name="description" required></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">
          <?php echo $this->lang->line('Product_image');?>
            <a class="btn btn-secondary p-0 ms-2" onclick="addimg()">
              &nbsp;<i class="fa fa-plus fa-sm"></i> <?php echo $this->lang->line('Add_image');?>&nbsp;
            </a>
          </label>
          <div id="alert-msg"></div>
          <input type="file" class="form-control mt-3" id="exampleInputEmail1" aria-describedby="emailHelp" required name="product_image" accept="image/*">
          <div id="img_append"></div>
          <input type="hidden" class="form-control" id="rowcount_img" value=1/>
        </div>
      </div>
      <p class="text-danger" id="expiry_date" style="text-align: end; padding-right: 18px;"></p>
      <div class="modal-footer">
        <a class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $this->lang->line('Cancel');?></a>
        <button type="submit" class="btn btn-primary">
        <?php echo $this->lang->line('Submit');?>
        </button>
      </div>
    </form>
  </div>
</div>
<!-- Modal post-->

<!-- Modal notification-->
<div class="modal fade" id="notifications" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id=""><?php echo $this->lang->line('Notifications');?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <?php
            if(isset($notify) && $notify->num_rows() > 0){
            foreach ($notify->result() as $n) {
          ?>
            <div class="col-sm-12 hide-notify show_notify_<?=$n->id?>">
              <h6>
                <b><?php echo $n->title; ?></b>
                <small class="card-text float-end"> <?php echo date('m/d/Y', strtotime($n->created_at)); ?></small>
              </h6>
              <p class="notify-desc">
                <?php echo $n->description; ?>
              </p>
              <?php if ($n->sent_for=='blog'): ?>
                <a href="<?=base_url('blogs/'.$n->blog_id)?>" class="btn btn-sm btn-primary">
                <?php echo $this->lang->line('View_in_Blog');?>
                </a>
              <?php endif; ?>
              <hr>
            </div>
          <?php } } ?>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div> -->
    </div>
  </div>
</div>
<!-- Modal notification-->


<!-- Modal blood request-->
<div class="modal fade" id="blood_req" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id=""><?php echo $this->lang->line('Blood_Request');?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- <div class="row"> -->

          <div class="form-group mb-2">
            <label>
            <?php echo $this->lang->line('Name');?>
            </label>
            <input type="text" name="" class="form-control" required value="<?=$this->session->userdata('sg_user_name')?>">
          </div>

          <div class="form-group mb-2">
            <label>
            <?php echo $this->lang->line('Email');?>
            </label>
            <input type="email" name="" class="form-control" required value="<?=$this->session->userdata('sg_user_email')?>">
          </div>

          <div class="form-group mb-2">
            <label>
            <?php echo $this->lang->line('Mobile');?>
            </label>
            <input type="number" name="" class="form-control" required value="<?=$this->session->userdata('sg_user_phone')?>">
          </div>

          <div class="form-group mb-2">
            <label>
            <?php echo $this->lang->line('Location');?>
            </label>
            <input type="text" name="" class="form-control" required value="">
          </div>

          <div class="form-group mb-2">
            <label>
            <?php echo $this->lang->line('Needed_blood_group_type');?>
            </label>
            <input type="text" name="" class="form-control" required value="">
          </div>

        <!-- </div> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><?php echo $this->lang->line('Cancel');?></button>
        <button type="submit" class="btn btn-success" data-bs-dismiss="modal"><?php echo $this->lang->line('Send_Request');?></button>
      </div>
    </div>
  </div>
</div>
<!-- Modal blood request-->

<?php
if(current_url() == base_url('home') || current_url() == base_url()){
?>
<div class="d-flex justify-content-between">
  <h2 class=" text-color m-2"><?php echo $this->lang->line('Categories');?></h2>
  <a href="<?=base_url('home/categories');?>" class="text-decoration-none"><h2 class="m-2 text-color"><?php echo $this->lang->line('See_all');?></h2></a>
</div>

<div class="scrollmenu border-line-tandb main-scroll">
  <?php for($c = 0; $c < count($all_cates); $c++){ ?>
    <a class="text-color" href="<?php echo base_url('items/cate/'.$all_cates[$c]['cate_id']); ?>">
      <img src="<?=$all_cates[$c]['cate_pic']?>" height="40px" alt="">
      <br> <?=$all_cates[$c]['cate_name'];?>
    </a>
  <?php } ?>
  
</div>

<?php } ?>

<?php echo $this->session->flashdata('message'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 text-center">
     		<img src="<?=ASSETS_PATH;?>/images/01Sept_21-SBILife-eShield-DBM-Options_970x250.jpg" class="img-fluid mt-3 mb-5" alt="Free food">
     	</div>
    </div> 