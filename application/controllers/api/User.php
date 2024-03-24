<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		header('Content-type: text/json');
		$this->req = json_decode(file_get_contents('php://input'),true);
        date_default_timezone_set('Asia/Kolkata');
		$this->db->query("SET time_zone='+05:30'");
		$this->ret['status'] 	= 0;
		$this->ret['message'] = "Authorization token required..!";
    	$this->ret['data'] 	= array();
    	$this->table = 'tbl_users';
    }
	
    public function index(){
        echo json_encode($this->ret);
    }

    public function login()
	{
		$email = isset($this->req["email"]) ? $this->req["email"] : '';
		$password = isset($this->req["password"]) ? $this->req["password"] : '';
		if(empty($email)){
			$data = array("missing_param"=>"email");
			$this->ret['message'] = "Email required..!";
			$this->ret["data"] = $data;
		}else if(empty($password)){
			$data = array("missing_param"=>"password");
			$this->ret['message'] = "Password required..!";
			$this->ret["data"] = $data;
		}else{
			$this->db->where("email", $email);
			$query = $this->db->get($this->table);
			if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $single) {
					$tokn = $single["user_token"];
					$pswd = $single["password"];
				}
				if ($pswd == md5($password)) {
					$data = array("user_token"=>$tokn);
					$this->ret["status"]  = 1;
					$this->ret['message'] = "Login successfull! Happy shopping..!";
					$this->ret["data"] 	  = $data;
				}else{
					$this->ret['message'] = "Password mismatch..!";
				}
			}else{
				$this->ret['message'] = "Email does not exist..!";
			}	
		}
		$this->index();
	}

    public function forgot_password()
	{
		$email = isset($this->req["email"]) ? $this->req["email"] : '';

		if(empty($email)){
			$data = array("missing_param"=>"email");
			$this->ret['message'] = "Email required..!";
			$this->ret["data"] = $data;
		}else{
			$this->db->where("email", $email);
			$query = $this->db->get($this->table);
			if ($query->num_rows() > 0) {
				$otp = random_int(111111, 999999);
				$data["otp_token"] = md5($otp);
				$this->api_model->db_update($this->table, 'email', $email, $data);
				$data["otp"] = "$otp";
				$this->ret["status"] = 1;
				$this->ret["message"] = "OTP sent to your email..!";
				$this->ret["data"] = $data;
			}else{
				$this->ret['message'] = "Email does not exist..!";
			}	
		}
		$this->index();
	}

	public function verify_otp()
	{
		$email = isset($this->req["email"]) ? $this->req["email"] : '';
		$otp_token = isset($this->req["otp_token"]) ? $this->req["otp_token"] : '';

		if(empty($email)){
			$data = array("missing_param"=>"email");
			$this->ret['message'] = "Email required..!";
			$this->ret["data"] = $data;
		}else if(empty($otp_token)){
			$data = array("missing_param"=>"otp_token");
			$this->ret['message'] = "OTP token required..!";
			$this->ret["data"] = $data;
		}else{
			$this->db->where("email",$email);
			$query = $this->db->get($this->table);
			if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $single) {
					$db_otp_token = $single["otp_token"];
				}
				if ($db_otp_token == $otp_token) {
					$this->ret["status"] = 1;
					$this->ret["message"] = "OTP verified..!";
				}else{
					$this->ret["message"] = "OTP mismatch..!";
				}
			}else{
				$this->ret["message"] = "Email does not exist..!";
			}
		}
		$this->index();
	}

	public function change_password()
	{
		$email = isset($this->req["email"]) ? $this->req["email"] : '';
		$password = isset($this->req["password"]) ? $this->req["password"] : '';

		if(empty($email)){
			$data = array("missing_param"=>"email");
			$this->ret['message'] = "Email required..!";
			$this->ret["data"] = $data;
		}else if(empty($password)){
			$data = array("missing_param"=>"password");
			$this->ret['message'] = "Password required..!";
			$this->ret["data"] = $data;
		}else{
			$this->db->where("email",$email);
			$query = $this->db->get($this->table);
			if ($query->num_rows() > 0) {
				$data = array("password"=>md5($password));
				$update = $this->api_model->db_update($this->table, 'email', $email, $data);
				if ($update) {
					$this->ret["status"] = 1;
					$this->ret["message"] = "Password changed! Please login..!";
				}else{
					$this->ret["message"] = "Password alredy in use, try another..!";
				}
			}else{
				$this->ret["message"] = "Email does not exist..!";
			}
		}
		$this->index();
	}

	public function register()
	{
		// $fname 		= $this->input->post("fname");
		// $lname 		= $this->input->post("lname");
		$username 	= isset($this->req["username"]) ? $this->req["username"] : '';
		$email 		= isset($this->req["email"]) ? $this->req["email"] : '';
		$phone 		= isset($this->req["phone"]) ? $this->req["phone"] : '';
		$password 	= isset($this->req["password"]) ? $this->req["password"] : '';

		/*
		if(empty($fname)){
			$data = array("missing_param"=>"fname");
	    	$this->ret['message'] = "Firstname required..!";
	    	$this->ret["data"] = $data;
		}else if(empty($lname)){
			$data = array("missing_param"=>"lname");
			$this->ret['message'] = "Lastname required..!";
			$this->ret["data"] = $data;
		}
		*/
		if(!isset($username) || empty($username)){
			$data = array("missing_param"=>"username");
	    	$this->ret['message'] = "Username required..!";
	    	$this->ret["data"] = $data;
		}else if(!isset($email) || empty($email)){
			$data = array("missing_param"=>"email");
			$this->ret['message'] = "Email required..!";
			$this->ret["data"] = $data;
		}else if(!isset($phone) || empty($phone)){
			$data = array("missing_param"=>"phone");
			$this->ret['message'] = "Mobile number required..!";
			$this->ret["data"] = $data;
		}else if(!isset($password) || empty($password)){
			$data = array("missing_param"=>"password");
			$this->ret['message'] = "Password required..!";
			$this->ret["data"] = $data;
		}else{

			$user_token = md5($phone);

			$user_check = $this->api_model->auth_check($user_token);

			if ($user_check) {
				$this->ret["message"] = "User phone number already exist..!";
			}else{

				$user_check = $this->api_model->auth_email_check($email);
				if ($user_check) {
					$this->ret["message"] = "User email already exist..!";
				}else{

					$insert["user_token"] 	= $user_token;
					// $insert["fname"] 		= $fname;
					// $insert["lname"] 		= $lname;
					$insert["username"] 	= $username;
					$insert["email"] 		= $email;
					$insert["phone"] 		= $phone;
					$insert["password"]		= md5($password);

					$register = $this->api_model->db_insert($this->table, $insert);

					if ($register) {
						$otp = random_int(111111, 999999);
						$data["otp_token"] = md5($otp);
						$this->api_model->db_update($this->table, 'user_token', $user_token, $data);
						$data["otp"] = "$otp";
						$this->ret["status"] = 1;
						$this->ret["message"] = "Registeration Done..! OTP sent to your mobile & email..!";
						$this->ret["data"] = $data;
					}else{
						$this->ret["message"] = "Oops!, Something not right, Please try again..!";
					}
				}
			}
		}
		$this->index();
	}

	public function profile()
	{
		$user_token = isset($this->req["user_token"]) ? $this->req["user_token"] : '';

		if (empty($user_token)) {
			$this->ret["message"] = "User token required..!";
		}else{

			$user_check = $this->api_model->auth_check($user_token);
			if ($user_check) {
				$profile = $this->api_model->get_profile($this->table, 'user_token', $user_token);
				$this->ret["status"]	= 1;
				$this->ret["message"]	= "Profile details...";
				$this->ret["data"]		= $profile;
			}else{
				$this->ret["message"]	= "Oops!, User not exist..!";
				$this->ret["data"]		= array("note"=>"user_token not exist..!");
			}
		}
		$this->index();
	}
}
