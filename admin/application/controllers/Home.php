<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->db->query("SET time_zone='+05:30'");
		$this->ret = 0;
    }

	public function index()
	{
		$data['products'] = $this->db->count_all_results('tbl_products');
		$data['users'] = $this->db->count_all_results('tbl_users');
		$Delete = $this->db->select('*')->where('id',1)->get('tbl_settings') ->result();
		if($Delete[0]->Auto_Delete == 'true'){
			$cur_date = date('Y-m-d');
			$this->db->where('expiry <',$cur_date);
	 		$this->db->delete('tbl_products');
		}
		$this->db->where('is_deleted', '1');
		$data['products_deleted'] = $this->db->count_all_results('tbl_products');
		$this->load->view('home', $data);
	}

	public function profile()
	{
		$data['admin'] = $this->db->get_where('tbl_admin', array('username'=>$this->session->userdata('sgAdmin')))->result();
		$data['settings'] = $this->db->get_where('tbl_settings', array('id'=>1))->result();
		$this->load->view('profile', $data);
	}

	public function update_profile()
	{
		if($this->input->post()){
			extract($_POST);
			$update['username'] = $username;
	        $update['email'] = $email;
	        $update['mobile'] = $mobile;
	        if(!empty($_FILES['profilepic']['name'])){
	        	$config['upload_path'] = PROFILE_PATH;
			    $config['allowed_types'] = 'jpg|jpeg|png';

			    $this->load->library('upload', $config);

			    if(!$this->upload->do_upload('profilepic')){
			        $error = array('error'=>$this->upload->display_errors());
			    }else{
			        $file_data = $this->upload->data();
			        $update['profilepic'] = $file_data['file_name'];
			    }
	        }
	        $this->db->where('username', $this->session->userdata('sgAdmin'));
	        $res = $this->db->update('tbl_admin', $update);
	        if($res){
	        	$this->session->set_userdata('sgAdmin', $username);
	        	$this->common_model->showAlert(1, 'Profie details updated..!');
	        }else{
	        	$this->common_model->showAlert(0, 'Profie details not updated..!');
	        }
		}
		redirect('home/profile');
	}
}
