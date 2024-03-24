<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->db->query("SET time_zone='+05:30'");
		$this->ret = 0;
    }

	public function index()
	{
		$this->load->view('reports_deleted');
	}

	public function deleted()
	{
		$data["users"] = $this->shareget_model->get_rep_deleted_users();
		$data["products"] = $this->shareget_model->get_rep_deleted_products();
		$data["users_deleted"] = $this->shareget_model->get_deleted_users();
		$data["products_deleted"] = $this->shareget_model->get_deleted_products();
		$this->load->view('reports_deleted', $data);
	}

	public function items()
	{
		$this->load->view('reported_items');
	}

	public function filter_items()
	{
		$limit = 10;
		$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$this->load->library('Ajax_pagination');

		if($this->input->post('pname')!=""){
			$pname = $this->input->post('pname');
		}else{
			$pname = '';
		}

		$config = array();
		$config["base_url"] = base_url('report/filter_items/');
		$config["total_rows"] = $this->shareget_model->get_reported_products($limit, $offset, $count = true, $pname);
		$config["per_page"] = $limit;
		$config["uri_segment"] = 3;

		$this->ajax_pagination->initialize($config);

		$res = $this->shareget_model->get_reported_products($limit, $offset, $count = false, $pname);

		$data["links"] = $this->ajax_pagination->create_links();
		$data['products'] = $res;

        $filter_view = $this->load->view('reported_items_card', $data, TRUE);
        echo $filter_view;
	}

	public function users()
	{
		$this->load->view('reported_users');
	}

	public function filter_users()
	{
		$limit = 10;
		$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$this->load->library('Ajax_pagination');

		if($this->input->post('uname')!=""){
			$uname = $this->input->post('uname');
		}else{
			$uname = '';
		}

		$config = array();
		$config["base_url"] = base_url('report/filter_users/');
		$config["total_rows"] = $this->shareget_model->get_reported_users($limit, $offset, $count = true, $uname);
		$config["per_page"] = $limit;
		$config["uri_segment"] = 3;

		$this->ajax_pagination->initialize($config);

		$res = $this->shareget_model->get_reported_users($limit, $offset, $count = false, $uname);

		$data["links"] = $this->ajax_pagination->create_links();
		$data['users'] = $res;

        $filter_view = $this->load->view('reported_users_card', $data, TRUE);
        echo $filter_view;
	}

	public function delete_product($pid)
	{
		$update['is_deleted'] = 1;
		$res = $this->common_model->db_update('tbl_products', 'product_id', $pid, $update);
		if($res){
        	$this->common_model->showAlert(1, 'Product deleted..!');
        }else{
        	$this->common_model->showAlert(0, 'Product not deleted..!');
        }
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function delete_user($uid)
	{
		$update['is_deleted'] = 1;
		$res = $this->common_model->db_update('tbl_users', 'id', $uid, $update);
		if($res){
        	$this->common_model->showAlert(1, 'User deleted..!');
        }else{
        	$this->common_model->showAlert(0, 'User not deleted..!');
        }
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function restore_item($pid)
	{
		$update['is_deleted'] = 0;
		$res = $this->common_model->db_update('tbl_products', 'product_id', $pid, $update);
		if($res){
			$this->db->where('product_id', $pid);
			$this->db->delete('tbl_report_product');
        	$this->common_model->showAlert(1, 'Product resorted..!');
        }else{
        	$this->common_model->showAlert(0, 'Product not resorted..!');
        }
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function remove_item($pid)
	{
		$this->db->where('product_id', $pid);
		$res = $this->db->delete('tbl_products');
		if($res){
			$this->db->where('product_id', $pid);
			$this->db->delete('tbl_report_product'); 
        	$this->common_model->showAlert(1, 'Product deleted forever..!');
        }else{
        	$this->common_model->showAlert(0, 'Product not deleted..!');
        }
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function restore_user($uid)
	{
		$update['is_deleted'] = 0;
		$res = $this->common_model->db_update('tbl_users', 'id', $uid, $update);
		if($res){
			$this->common_model->db_update('tbl_products', 'user_id', $uid, $update);
			$this->db->where('reported_id', $uid);
			$this->db->delete('tbl_report_user');

			$user = $this->db->get_where('tbl_users', array('id'=>$uid))->row();

			$new_password = 'Shareget@'.rand(1111,9999);

			$mailIt = '<h4>Hello '.$user->username.',</h4>';
			$mailIt.= '<p>Your Account is restored! Please use the password below to login and please change it after the login done.</p>';
			$mailIt.= '<p><b>Your password : </b>'.$new_password.'</p>';

			$header = "From:sharegetin@gmail.com \r\n";
			$header .= "Cc:manojram8800@gmail.com \r\n";
			$header .= "MIME-Version: 1.0\r\n";
			$header .= "Content-type: text/html\r\n";

			$mailed = mail($email, 'Shareget Account Resorted',$mailIt,$header);
			if($mailed){
				$update['password'] = md5($new_password);
				$res = $this->common_model->db_update('tbl_users', 'id', $uid, $update);
	        	$this->common_model->showAlert(1, 'User resorted & password sent to user\'s email..!');
	        }else{
	        	$this->common_model->showAlert(1, 'User resorted..!');
	        }
        }else{
        	$this->common_model->showAlert(0, 'User not resorted..!');
        }
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function remove_user($uid)
	{
		$this->db->where('id', $uid);
		$res = $this->db->delete('tbl_users');
		if($res){
			$this->db->where('reported_id', $uid);
			$this->db->delete('tbl_report_user'); 
        	$this->common_model->showAlert(1, 'User deleted forever..!');
        }else{
        	$this->common_model->showAlert(0, 'User not deleted..!');
        }
		redirect($_SERVER['HTTP_REFERER']);
	}

}
