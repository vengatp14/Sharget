<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->db->query("SET time_zone='+05:30'");
		$this->ret = 0;
    }

	public function index()
	{
		if($this->input->post()){
			$username = $this->input->post("username");
			$password = md5($this->input->post("password"));
			$res = $this->db->get_where('tbl_admin', array('username'=>$username, 'password'=>$password))->result();
			if(count($res) > 0){
				$sess = array('sgAdminId' => $res[0]->id, 'sgAdmin' => $res[0]->username, 'sgAdminName' => $res[0]->name);
				$this->session->set_userdata($sess);
				$this->ret = 1;
				$msg = 'Welcome back..!';
				$this->common_model->showAlert($this->ret, $msg);
				redirect('home');
			}else{
				$msg = 'Username/Password mismatch..!';
				$this->common_model->showAlert($this->ret, $msg);
			}
		}
		$this->load->view('login');
	}

	public function change_password($value='')
	{
		if($this->input->post()){
			$old_password = md5($this->input->post("old_password"));
			$new_password = md5($this->input->post("new_password"));
			$res = $this->db->get_where('tbl_admin', array('password'=>$old_password))->result();
			if(count($res) > 0){
				$this->db->where('password', $old_password);
				$this->db->update('tbl_admin', array('password'=>$new_password));
				$this->ret = 1;
				$msg = 'Password updated..!';
			}else{
				$msg = 'Old password mismatch..!';
			}
		}
		$this->common_model->showAlert($this->ret, $msg);
		$this->load->view('login');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->common_model->showAlert(1, "Logout successfully..!");
		redirect(base_url());
	}
}
