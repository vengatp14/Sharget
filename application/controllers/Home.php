<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$language="";
		$this->lang->load('information',$language);
		$this->load->helper('url');
		$this->load->model('Common_model','Common_model');
		$this->db->query("SET time_zone='+05:30'");
		$this->ret = 0;
		$this->common_model->auto_session();
		$this->output->delete_cache('home');
		$this->output->delete_cache('chat');
		$this->output->delete_cache('blogs');
		$this->output->delete_cache('items');
    }

	public function index()
	{
		$data['state'] = $this->Common_model->get_States()->result();
		$this->load->view('home', $data);
		
	}

	public function city($id)
	{
		$data['city'] = $this->Common_model->get_Cities($id)->result();
		echo json_encode($data);
	}

	public function notifications()
	{
		$uid = $this->session->userdata('sg_user_id');
		$this->db->where('sent_to', $uid)->order_by('id', 'desc');
		$data['notify'] = $this->db->get('tbl_notifications')->result();
		$this->load->view('notify', $data);
	}

	public function notified()
	{
		$nid = $this->input->post('nid');
		$this->db->where('id', $nid);
		echo $this->db->update('tbl_notifications', array('is_seen'=>0));
	}

	public function categories()
	{
		$data['all_cates'] = $this->common_model->get_all_cate();
		$this->load->view('categories', $data);
	}

	public function get_subcategory($cid)
	{
		$cate = $this->db->get_where('tbl_cate', array('id'=>$cid))->row('cate_validity');
		$data = $this->db->get_where('tbl_sub_cate', array('cate_id'=>$cid))->result();
		$res = array('expiry'=>date('d M Y', strtotime(" + $cate days")), 'data'=>$data);
		echo json_encode($res);
	}

	public function referral()
	{
		$this->load->view('referral');
	}

	public function aboutus()
	{
		$this->load->view('about_us');
	}

	public function teams_conditions()
	{
		$this->load->view('terms_and_conditions');
	}

	public function privacy_policy()
	{
		$this->load->view('privacy_policy');
	}

	public function get_locations($locat)
	{
		$locat = urldecode($locat);
		$this->db->group_by('name');
		$this->db->like('name', $locat, "after");
		$this->db->where(array('country_id'=>101));
		// $res = $this->db->get('tbl_users');
		$this->db->from('cities');
		$res = $this->db->get();
		$locations = array();
		if ($res->num_rows() > 0) {
			foreach ($res->result() as $loc) {
				$locations[] = $loc->name;
			}
		}
		echo json_encode($locations);
	}

	public function search_products($search)
	{
		$search = urldecode($search);
		$this->db->group_by('product_name');
		$this->db->like('product_name', $search, "after");
		$this->db->where('is_deleted',0);
		$res = $this->db->get('tbl_products');
		$products = array();
		if ($res->num_rows() > 0) {
			foreach ($res->result() as $pro) {
				$products[] = $pro->product_name;
			}
		}
		echo json_encode($products);
	}

	public function contactus()
	{
		$data['user_id']= empty($this->session->userdata('sg_user_id')) ? '' : $this->session->userdata('sg_user_id');
		$data['email']	= empty($this->session->userdata('sg_user_email')) ? '' : $this->session->userdata('sg_user_email');
		$data['name']	= empty($this->session->userdata('sg_user_name')) ? '' : $this->session->userdata('sg_user_name');
		$data['phone']	= empty($this->session->userdata('sg_user_phone')) ? '' : $this->session->userdata('sg_user_phone');
		if($this->input->post('user_id')){
			$insert['user_id'] = $this->input->post('user_id');
			$insert['name'] = $this->input->post('name');
			$insert['email'] = $this->input->post('email');
			$insert['phone'] = $this->input->post('phone');
			$insert['msg'] = $this->input->post('msg');
			$res = $this->db->insert('tbl_contact_msg', $insert);
			if($res){
				$this->db->update('tbl_admin', ['is_contacted'=>1]);
				$this->ret = 1;
				$msg = "Your message sent to admin,<br>Admin will contact you soon..!";
			}else{
				$msg = "Something went wrong..!";
			}
			$this->common_model->showAlert($this->ret, $msg);
			redirect($_SERVER["HTTP_REFERER"]);
		}
		$this->load->view('contact_us', $data);
	}

	public function contact_username()
	{
		$mail = $this->input->post('email');
		$res = $this->db->get_where('tbl_users', ['email'=>$mail]);
		if ($res->num_rows() > 0) {
			echo json_encode($res->result());
		}else{
			echo "0";
		}
	}

	public function profile()
	{
		$uid = $this->session->userdata('sg_user_id');
		$data['uid'] = $uid;
		$data['bloods'] = $this->shareget_model->get_bloods();
		$data['profile'] = $this->shareget_model->get_user_by_id($uid);
		$this->load->view('profile', $data);
	}

	public function getmd5($pswd)
	{
		echo md5($pswd);
	}

	public function edit_auth_check($uid)
	{
		$email 	= $this->input->post("email");
		$phone	= $this->input->post("phone");

		$this->db->where(array("phone" => $phone, "id !=" => $uid));
		$phone_check = $this->db->get('tbl_users');
		$msg = array("phone"=>true, "email"=>true);
		if ($phone_check->num_rows() > 0) {
			$msg["phone"] = "User phone number already exist..!";
		}

		$this->db->where(array("email" => $email, "id !=" => $uid));
		$email_check = $this->db->get('tbl_users');
		if($email_check->num_rows() > 0){
			$msg["email"] = "User email already exist..!";
		}
		echo json_encode($msg);
	}

	public function update_profile($uid)
	{
		extract($_POST);
		$update['username'] = $username;
		$update['phone'] 	= $phone;
		$update['user_token'] 	= md5($phone);
		$update['email'] 	= $email;
		$update['blood_group'] = $blood_group;
		$update['location'] = $location;
		$msg = '';
		$this->db->where(array('phone'=>$phone, 'id !='=>$uid));
		$user_check = $this->db->get('tbl_users');
		if ($user_check->num_rows() > 0) {
			$msg = "User phone number already exist..!";
		}else{
			$this->db->where(array('email'=>$email, 'id !='=>$uid));
			$user_check = $this->db->get('tbl_users');
			if ($user_check->num_rows() > 0) {
				$msg = "User email already exist..!";
			}else{
				if(!empty($_FILES['profilepic']['name'])){
		        	$config['upload_path'] = UPLOADS_PATH.'profile';
				    $config['allowed_types'] = 'jpg|jpeg|png';

				    $this->load->library('upload', $config);

				    if(!$this->upload->do_upload('profilepic')){
				        $msg .= $this->upload->display_errors()."<br>";
				    }else{
				        $file_data = $this->upload->data();
				        $update['profile_pic'] = $file_data['file_name'];
				    }
		        }
				$res = $this->common_model->db_update('tbl_users', 'id', $uid, $update);
				if($res){
					$this->ret = 1;
					$msg .= "Profile details updated..!";
				}else{
					$msg .= "Nothing changed to update..!";
				}
			}
		}
		$this->common_model->showAlert($this->ret, $msg);
		redirect('home/profile');
	}

	
	public function update_password($uid)
	{
		extract($_POST);
		$opass = md5($opass);
		if($opass != $opswd){
			$msg = "Old password mismatch..!";
		}else{
			$update['password'] = md5($npass);
			$res = $this->common_model->db_update('tbl_users', 'id', $uid, $update);
			if($res){
				$this->ret = 1;
				$msg = "Password changed..!";
			}else{
				$msg = "Something went wrong..!";
			}
		}
		$this->common_model->showAlert($this->ret, $msg);
		redirect('home/profile');
	}

	public function delete_user()
	{
		$uid = $this->session->userdata('sg_user_id');
		$this->db->where('id', $uid);
		$user = $this->db->update('tbl_users', array('is_deleted'=>1));
		if($user){
			$this->db->where('user_id', $uid);
			$this->db->update('tbl_products', array('is_deleted'=>1));
			$user_data = $this->session->userdata();
			foreach ($user_data as $key => $value) {
			    if ($key!='__ci_last_regenerate' && $key != '__ci_vars')
			    	$this->session->unset_userdata($key);
			}
			$this->common_model->showAlert(1, "Your profile deleted..!<br>Contact admin to restore your profile back..!");
			redirect(base_url());
		}
	}

	public function deactivate()
	{
		$uid = $this->session->userdata('sg_user_id');
		$this->db->where('id', $uid);
		$user = $this->db->update('tbl_users', array('status'=>1));
		if($user){
			$this->db->where('user_id', $uid);
			$this->db->update('tbl_products', array('is_deleted'=>1));
			$user_data = $this->session->userdata();
			foreach ($user_data as $key => $value) {
			    if ($key!='__ci_last_regenerate' && $key != '__ci_vars')
			    	$this->session->unset_userdata($key);
			}
			$this->common_model->showAlert(1, "User de-activated..!");
			redirect(base_url());
		}
	}

	public function posts()
	{
		$data['mypost'] = true;
		$this->load->view('posts', $data);
	}

	public function wishlist()
	{
		$this->load->view('wishlist');
	}

	public function verify_otp($email_id='')	
	{	
		$data['email_id'] = $email_id;	
		$this->load->view('verify_OTP', $data);	
	}	

	public function forget_password($email_id='')	
	{	
		$data['email_id'] = $email_id;	
		$this->load->view('forgetpassword', $data);	
	}	

	public function add_wishlist($pid)
	{
		$uid = $this->session->userdata('sg_user_id');
		$insert['user_id'] = $uid;
		$insert['product_id'] = $pid;
		$res = $this->db->insert('tbl_wishlists', $insert);
		if($res){
			$this->ret = 1;
			$msg = "Product added to wishlist..!";
		}else{
			$msg .= "Something went wrong..!";
		}
		$this->common_model->showAlert($this->ret, $msg);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function remove_wishlist($pid)
	{
		$uid = $this->session->userdata('sg_user_id');
		$whr['user_id'] = $uid;
		$whr['product_id'] = $pid;
		$this->db->where($whr);
		$res = $this->db->delete('tbl_wishlists');
		if($res){
			$this->ret = 1;
			$msg = "Product removed from wishlist..!";
		}else{
			$msg .= "Something went wrong..!";
		}
		$this->common_model->showAlert($this->ret, $msg);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function generate_otp() {	
		$OTP 	=	rand(1,9);	
		$OTP 	.=	rand(0,9);	
		$OTP 	.=	rand(0,9);	
		$OTP 	.=	rand(0,9);	
		$OTP 	.=	rand(0,9);	
		$OTP 	.=	rand(0,9);	
		return $OTP;	
	}
	
	public function forget_Password_Update($email)	
	{	
		$insert["password"] = md5($this->input->post("New_password"));
		$verifed_password = $this->common_model->db_update('tbl_users', 'email', $email, $insert);
		if($verifed_password){	
			$this->ret = 1;	 
			$msg = "Password Changed Successfully..!";	
				
		}	
		else{	
		$msg = "Password Changed Failed, Try Again..!";	
	}	
	$this->common_model->showAlert($this->ret, $msg);	
	redirect('home');
	}
		
	public function validate_otp($email)	
	{	
		$a	= $this->input->post("a");	
		$b	= $this->input->post("b");	
		$c	= $this->input->post("c");	
		$d	= $this->input->post("d");	
		$e	= $this->input->post("e");	
		$f	= $this->input->post("f");	
		$otp = $a.$b.$c.$d.$e.$f;	
		$otp_check = $this->common_model->otp_email_check($email, $otp);	
				if ($otp_check) {	
					$insert["otp_status"] 	= 1;	
					$verifed_otp = $this->common_model->db_update('tbl_users', 'email', $email, $insert);	
					if($verifed_otp){	
						$this->ret = 1;	
						$msg = "OTP Verified, Account is Activated..!";	
							
					}	
				}else{	
					$msg = "OTP Failed, Try Again..!";	
				}	
				$this->common_model->showAlert($this->ret, $msg);	
				redirect('home');	
	}	
	public function resend_otp($email)	
	{	
		// Generate OTP	
		$otp = $this->generate_otp();	
		$insert["email"] 	= $email;	
		$insert["otp_token"] 	= $otp;	
		$insert["otp_status"] 	= 0;	
		$resend_otp = $this->common_model->db_update('tbl_users', 'email', $email, $insert);	
		if($resend_otp){	
			$this->send_mail($email, $otp);	
			$this->ret = 1;	
			$msg = "The OTP Resend to Register email Account Kindly Check it..!";	
		}	
		$this->common_model->showAlert($this->ret, $msg);	
		redirect('home');	
	}

	public function forgetPassword()
	{
		$email 		= $this->input->post("email");
		$user_check = $this->common_model->auth_email_check($email);
				if ($user_check) {
					$to_email = $email; 	
		$from_email = "admin@shareget.in";	
        $subject = "Forget Password From Shareget";	
		$base_url = base_url()."forgetpassword/".$email;	
		$message = "	
		<html>	
       <head>	
       </head>	
       <body>	
		<div>	
        <div>	
      <h1>Shareget</h1>	
      click the below link and change your password don't share this link.	
      <h3> $base_url</h3>	
      </div>	
      Thanks,<br>	
      The Shareget team	
            </div>	
			</body>	
			</html>	
		";	
        $CI =& get_instance();	
		$CI->email->set_newline("\r\n");	
		$CI->email->from($from_email, 'Forget Password From Shareget'); // change it to yours	
		$CI->email->to($to_email);// change it to yours	
		$CI->email->subject($subject);	
		$CI->email->message($message);	
		$CI->email->set_mailtype('html');	
			
		if($CI->email->send())	
		{	
		  
		  $msg = "Success! - An email has been sent to ".$to_email;
		  $this->ret = 1;	
		}	
		else	
		{ 	
		  show_error($CI->email->print_debugger());	
		  return false;	
		}
		}else{
			$msg = "User email doesn't exist..!";
		
	}
	$this->common_model->showAlert($this->ret, $msg);
	redirect('home');
}


	public function signup()
	{
		$username	= $this->input->post("username");
		$email 		= $this->input->post("email");
		$phone 		= $this->input->post("phone");
		// Generate OTP	
		$otp = $this->generate_otp();
		$password 	= $this->input->post("password");
		$blood_group= $this->input->post("blood_group");
		$location 	= $this->input->post("Cities");
		$State 	= $this->input->post("State");

		if(empty($username)){
	    	$msg = "Username required..!";
		}else if(empty($email)){
			$msg = "Email required..!";
		}else if(empty($phone)){
			$msg = "Mobile number required..!";
		}else if(empty($otp)){
			$msg = "OTP required..!";
		}else if(empty($password)){
			$msg = "Password required..!";
		}else if(empty($blood_group)){
			$msg = "Blood Group required..!";
		}else if(empty($location)){
			$msg = "City required..!";
		}else if(empty($State)){
			$msg = "State required..!";
		}else{

			$user_token = md5($phone);

			$user_check = $this->common_model->auth_check($user_token);

			if ($user_check) {
				$msg = "User phone number already exist..!";
			}else{

				$user_check = $this->common_model->auth_email_check($email);
				if ($user_check) {
					$msg = "User email already exist..!";
				}else{
					$otp_token = $otp;

						$unique_id = substr(md5(microtime()), rand(0,25), 6);

						$insert["user_token"] 	= $user_token;
						$insert["username"] 	= $username;
						$insert["email"] 		= $email;
						$insert["phone"] 		= $phone;
						$insert["otp_token"] 	= $otp_token;
						$insert["password"]		= md5($password);
						$insert["blood_group"] 	= $blood_group;
						$insert["location"] 	= $location;
						$insert["State"] 	= $State;
						$insert["chat_unique_id"] 	= $unique_id;

						$register = $this->common_model->db_insert_last_id('tbl_users', $insert);
						// $this->send_sms($mobile, $message);	
						$this->send_mail($email, $otp);
						if ($register > 0) {
				// 			$otp = random_int(111111, 999999);
							$data["otp_token"] = md5($otp_token);
							$this->api_model->db_update($this->table, 'user_token', $user_token, $data);

				// 			$insert["password"]	= $password;

							$chat_id = $this->shareget_model->init_chat_profile($insert);

							$this->ret = 1;
							$msg = "The OTP Sent to Register email Account Kindly Check it..!";	
							$sess = array(	
								'sg_user_id' => $register, 	
								'sg_user_email' => $email, 	
								'sgUser' => $user_token, 	
								'sg_user_name' => $name, 	
								'sg_user_phone' => $phone,	
								'chat_username' => $name,	
								'chat_image' => '',	
								'chat_uniqueid' => $unique_id	
							);	
							$this->session->set_userdata($sess);
						}else{
							$msg = "Oops!, Something not right, Please try again..!";
						}

					}
				
			}
		}
		
		$this->common_model->showAlert($this->ret, $msg);
		redirect('home');
	}

	public function send_mail($email, $otp) { 	
		$to_email = $email; 	
		$from_email = "admin@shareget.in";	
        $subject = "OTP From Shareget";	
		$base_url = base_url()."otpverify/".$email;	
		$message = "	
		<html>	
       <head>	
       </head>	
       <body>	
		<div>	
        <div>	
      <h1>Shareget</h1>	
      Please use the verification code, click the below link, submit the OTP to verify in your account.	
      <h3><span>$otp</span></h3>	
      <h3> $base_url</h3>	
      </div>	
      Thanks,<br>	
      The Shareget team	
            </div>	
			</body>	
			</html>	
		";	
        $CI =& get_instance();	
		$CI->email->set_newline("\r\n");	
		$CI->email->from($from_email, 'OTP From Shareget'); // change it to yours	
		$CI->email->to($to_email);// change it to yours	
		$CI->email->subject($subject);	
		$CI->email->message($message);	
		$CI->email->set_mailtype('html');	
			
		if($CI->email->send())	
		{	
		  echo "Success! - An email has been sent to ".$to_email;	
		}	
		else	
		{ 	
		  show_error($CI->email->print_debugger());	
		  return false;	
		}	
        	
	 } 	
	public function send_sms($phone, $body) {	
		// Your authentication key	
		$authKey 	= 'auth_key';	
		// Multiple mobiles numbers separated by comma						
		// Sender ID,While using route4 sender id should be 6 characters long.	
		$senderId 	= 'CXSTEC';	
		// Your message to send, Add URL encoding here.	
		$message 	= urlencode($body);	
		//Define route 	
		$route 		= 'trans';	
		//Prepare you post parameters	
		$postData 	= array(	
			'authkey' 	=> $authKey,	
			'mobiles' 	=> $phone,	
			'message' 	=> $message,	
			'sender' 	=> $senderId,	
			'route' 	=> $route	
		);		
		//API URL	
		$url 		= 'http://api.msg91.com/api/sendhttp.php';		
		$ch = curl_init();	
		curl_setopt_array($ch, array(	
			CURLOPT_URL 			=> $url,	
			CURLOPT_RETURNTRANSFER		=> true,	
			CURLOPT_POST 			=> true,	
			CURLOPT_POSTFIELDS 		=> $postData	
			));			
		//Ignore SSL certificate verification	
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);	
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);	
		//get response	
		$output = curl_exec($ch);		
					
		curl_close($ch);	
	}

	public function login()
	{
		$mailPhone 		= $this->input->post("mailPhone");
		$password 		= $this->input->post("password");
		
		if(empty($mailPhone)){
			$msg = "Email required..!";
		}else if(empty($mailPhone)){
			$msg = "Password required..!";
		}else{
			$password = md5($password);
			$user_check = $this->db->query("SELECT * FROM `tbl_users` WHERE (`email` = '$mailPhone' OR `phone` = '$mailPhone') AND `password` = '$password'")->result_array();
			
			if (count($user_check)>0) {
				foreach ($user_check as $r) {
					$uid = $r['id'];
					$email = $r['email'];
					$user_token = $r['user_token'];
					$name = $r['username'];
					$phone = $r['phone'];
					$status = $r['status'];
					$is_deleted = $r['is_deleted'];
					$chat_unique_id = $r['chat_unique_id'];
					$user_avtar = $r['profile_pic'];
					$otp_status = $r['otp_status'];
				}
				if($is_deleted == 1){
					$msg = "Account deleted, please contact admin!";
				}else{
					if($status == 1){
						$this->common_model->db_update('tbl_users', 'id', $uid, array('status'=>0));
						$this->common_model->db_update('tbl_products', 'user_id', $uid, array('is_deleted'=>0));
						$msg = "Account deactivated!<br>Please contact admin to activate..!";
					}else{
						if($otp_status == 0){	
							$msg = "Account deactivated, kindly verify email otp in your register email!";	
						}else{
						$this->ret = 1;
						$msg = "Login Done, Wellcome $name..!";
						$sess = array(
							'sg_user_id' => $uid, 
							'sg_user_email' => $email, 
							'sgUser' => $user_token, 
							'sg_user_name' => $name, 
							'sg_user_phone' => $phone,
							'chat_username' => $name,
							'chat_image' => $user_avtar,
							'chat_uniqueid' => $chat_unique_id
						);
						$this->session->set_userdata($sess);
					}
				}
				}
			}else{
				$msg = "Email/Password missmatched..!";
			}
			$this->common_model->showAlert($this->ret, $msg);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->common_model->showAlert(1, "Logout successfully..!");
		redirect(base_url());
	}
}
