<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		header('Content-type: text/json');
		$this->req = json_decode(file_get_contents('php://input'),true);
        date_default_timezone_set('Asia/Kolkata');
		$this->db->query("SET time_zone='+05:30'");
		$this->ret['status'] 	= 0;
		$this->ret['message'] = "Authorization token required..!";
    	$this->ret['data'] 	= array();
    }
	
    public function index(){
        echo json_encode($this->ret);
    }

	public function main_categories()
	{
		$user_token = isset($this->req["user_token"]) ? $this->req["user_token"] : '';

		if (empty($user_token)) {
			$data = array("missing_param"=>"user_token");
			$this->ret["message"] = "User token required..!";
			$this->ret["data"] = $data;
		}else{

			$user_check = $this->api_model->auth_check($user_token);
			if ($user_check) {
				$cate = $this->api_model->cate_all('tbl_cate', 'id', 'desc');
				if(is_array($cate) && count($cate)){
					$this->ret["status"]	= 1;
					$this->ret["message"]	= "Main categories...";
					$this->ret["data"]		= $cate;
				}else{
					$this->ret["message"]	= "No more main categories...";
				}
			}else{
				$this->ret["message"]	= "Oops!, User not exist..!";
				$this->ret["data"]		= array("note"=>"user_token not exist..!");
			}
		}
		$this->index();
	}

	public function sub_categories()
	{
		$user_token = isset($this->req["user_token"]) ? $this->req["user_token"] : '';
		$cate_id = $this->req["cate_id"];

		if (empty($user_token)) {
			$data = array("missing_param"=>"user_token");
			$this->ret["message"] = "User token required..!";
			$this->ret["data"] = $data;
		}else if(empty($cate_id)){
			$data = array("missing_param"=>"cate_id");
			$this->ret["message"] = "Main category id required..!";
			$this->ret["data"] = $data;
		}else{

			$user_check = $this->api_model->auth_check($user_token);
			if ($user_check) {
				$subCate = $this->api_model->sub_cate_all('tbl_sub_cate', 'cate_id', $cate_id);
				if(is_array($subCate) && count($subCate)){
					$this->ret["status"]	= 1;
					$this->ret["message"]	= "Sub categories...";
					$this->ret["data"]		= $subCate;
				}else{
					$this->ret["message"]	= "No more sub categories...";
				}
			}else{
				$this->ret["message"]	= "Oops!, User not exist..!";
				$this->ret["data"]		= array("note"=>"user_token not exist..!");
			}
		}
		$this->index();
	}
}
