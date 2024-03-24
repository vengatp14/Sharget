<?php

if (isset($_SESSION)) {
	$image = $_SESSION['chat_image'];
	$name = $data[0]['user_fname']." ".$data[0]['user_lname'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=ASSETS_PATH;?>/css/message/messagestyle.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
    <link rel="stylesheet" href="<?=ASSETS_PATH;?>/css/message/loading-bar.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	
	<title>Shareget Chat Application CI</title>
	<script>
		var base_url = '<?php echo base_url() ?>';
		var init_func = '<?php echo $chat_user_id ?>';
	</script>
</head>
<body>
	<section id="main" class="bg-dark">
		<div id="chat_user_list">
			<div id="owner_profile_details">
				<?php
				if(empty($image)){
					$image = 'default.jpeg';
				}
				$image = UPLOADED_URL.'profile/'.$image;
				?>
				<div id="owner_avtar" style="background-image: url('<?=$image;?>'); background-size: 100% 100%">
					<div>
						<div id="online"></div>
					</div>
				</div>
				<div id="owner_profile_text" class="border-bottom">
					<h6 id="owner_profile_name" class="m-0 p-0">
						<b><?php echo $name;?></b>
					</h6>
					<div id="bio">
						<p id="owner_profile_bio" class="m-0 p-0"></p>
						<i class="fas fa-edit" id="edit_icon"></i>
					</div>
					<a class="text-decoration-none" href="<?=base_url('home')?>" id="logout" style="color:#e86663;">
						<small>
							<i class="fa fa-home"></i> <?php echo $this->lang->line('Back_to_home');?>
						</small>
					</a>
				</div>
			</div>
			<div id="search_box_container" class="py-3">
				<input type="text" name="txt_search" class="form-control" autocomplete="off" placeholder="<?php echo $this->lang->line('Search_User');?>" id="search">
			</div>
			<hr/>
			<div id="user_list" class="py-3">
			</div>
		</div>
		<div id="chatbox">
			<!-- <div id="data_container" class="">
				<div id="bg_image"></div>
				<h2 class="mt-0">Hi There! Welcome To</h2>
				<h2>Shareget Chat Application</h2>
				<p class="text-center my-2">Connect to your device via Internet. Remember that you <br> must have a stable Internet Connection for a<br> greater experience.</p>
			</div> -->
			<div class="chatting_section" id="chat_area" style="display: none">
				<div id="header" class="py-2">
					<div id="name_details" class="pt-2">
						<div id="chat_profile_image" class="mx-2" style="background-size: 100% 100%">
							<div id="online"></div>
						</div>
						<div id="name_last_seen">
							<h6 class="m-0 pt-2"></h6>
							<p class="m-0 py-1"></p>
						</div>
					</div>
					<div id="icons" class="px-4 pt-2">
						<!-- <div id="send_mail">
							<a href="" id="mail_link"><i class="fas fa-envelope text-dark"></i></a>
						</div> -->
						<div id="goto_chat">
							<a href="" id="mail_link">
								<i class="fas fa-comments text-dark"></i>
							</a>
						</div>
						<div id="details_btn" class="ml-3">
							<i class="fas fa-info-circle text-dark"></i>
						</div>
					</div>
				</div>
				<div id="chat_message_area">

				</div>
				<div id="messageBar" class="py-4 px-4">
					<div id="textBox_attachment_emoji_container">
						<div id="text_box_message">
							<input type="text" maxlength = "200" name="txt_message" id="messageText" class="form-control" placeholder="<?php echo $this->lang->line('Type_your_message');?>">
						</div>
						<div id="text_counter">
							<p id="count_text" class="m-0 p-0"></p>
						</div>
					</div>
					<div id="sendButtonContainer">
						<button class="btn" id="send_message">
							<span class="material-icons"><?php echo $this->lang->line('send');?></span>
						</button>
					</div>
				</div>
			</div>
		</div>
		<div id="details_of_user">
			<div id="user_details_container_avtar" style="background-size: 100% 100%"></div>
			<h5 class="text-justify" id="details_of_name"></h5>
			<p class="text-justify" id="details_of_bio"></p>
			<div id="user_details_container_details">
				<hr>
				<p class="text-justify" id="details_of_location"><span></p>
				<p class="text-justify" id="details_of_birthday"></p>
				<p class="text-justify" id="details_of_mobile"><span></p>
				<p class="text-justify" id="details_of_email"><span></p>
				<hr>
				<p class="text-center w-100" id="details_of_created"></p>
				
			</div>
			<div id="icons" class="px-4 pt-2">
				<p id="details_btn_close" class="ml-3">
					<i class="fas fa-arrow-circle-left text-dark"></i>
					<?php echo $this->lang->line('Back_to_chat');?>
				</p>
			</div><br><br>
			<button class="btn btn-danger" id="btn_block"><?php echo $this->lang->line('Block_User');?></button>
		</div>
	</section>
	<div id="update_container">
		<div style="background-color:#F5F6FA;" class="p-3 d-flex justify-content-between align-items-center">
			<!-- <h5 id="update_container_title" class="m-0 p-0">Update Profile</h5> -->
			<h5 id="update_container_title" class="m-0 p-0"><?php echo $this->lang->line('Update_Status');?></h5>
			<i class="fas fa-times"></i>
		</div>
		<form class="" id="form_details" autocomplete="off">
			<!-- <div class="form-group">
				<label>Date Of Birth</label>
				<input type="text" name="txt_dob" id="dob" class="form-control" placeholder="dd-mm-yyyy">
			</div>
			<div class="form-group">
				<label>Contact Number</label>
				<input type="text" maxlength="10" name="txt_phone" placeholder="Write your mobile number" id="phone_num" class="form-control">
			</div>
			<div class="form-group">
				<label>Address</label>
				<input type="text" name="txt_addr" id="address" placeholder="Write your address" class="form-control">
			</div> -->
			<div class="form-group">
				<input type="hidden" name="txt_dob" id="dob" class="form-control" placeholder="dd-mm-yyyy" value="">
				<input type="hidden" maxlength="10" name="txt_phone" placeholder="Write your mobile number" id="phone_num" value="" class="form-control">
				<input type="hidden" name="txt_addr" id="address" placeholder="Write your address" class="form-control" value="">
				<label><?php echo $this->lang->line('Bio');?></label>
				<textarea name="bio" class="" id="update_bio" placeholder="<?php echo $this->lang->line('Write_your_bio_here');?>"></textarea>
			</div>
			<button class="btn btn-block" id="update_btn" style="border-radius:0px;">
				<span><?php echo $this->lang->line('Save_Changes');?></span>
			</button>
		</form>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"></script>
	<script type="text/javascript" src="<?=ASSETS_PATH;?>/js/message/main.js"></script>
</body>
</html>