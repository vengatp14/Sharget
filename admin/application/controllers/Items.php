<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->db->query("SET time_zone='+05:30'");
		$this->ret = 0;
    }

	public function index()
	{
		$this->load->view('products');
	}

	public function filter_items()
	{	
		$limit = 10;
		$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$this->load->library('Ajax_pagination');

		if($this->input->post('pname')!=""){
			$pname = $this->input->post('pname');
		}else{
			$pname = $uid = '';
		}

		$config = array();
		$config["base_url"] = base_url('items/filter_items/');
		$config["total_rows"] = $this->shareget_model->get_products($limit, $offset, $count = true, $pname);
		$config["per_page"] = $limit;
		$config["uri_segment"] = 3;

		$this->ajax_pagination->initialize($config);

		$res = $this->shareget_model->get_products($limit, $offset, $count = false, $pname);

		$data["links"] = $this->ajax_pagination->create_links();
		$data['products'] = $res;

        $filter_view = $this->load->view('items_card', $data, TRUE);
        echo $filter_view;
	}

	public function delete($uid)
	{
		$this->db->where('id', $uid);
		$res = $this->db->update('tbl_users', array('is_deleted'=>1));
		if($res){
        	$this->common_model->showAlert(1, 'User deleted..!');
        }else{
        	$this->common_model->showAlert(0, 'User not deleted..!');
        }
		redirect('user');
	}

	public function delete_product($pid, $uid)
	{
		$this->db->where(array('product_id'=>$pid, 'user_id'=>$uid));
		$res = $this->db->update('tbl_products', array('is_deleted'=>1));
		if($res){
        	$this->common_model->showAlert(1, 'Product deleted..!');
        }else{
        	$this->common_model->showAlert(0, 'Product not deleted..!');
        }
		redirect('user/items/'.$uid);
	}

	public function delete_this_product($pid, $uid)
	{
		$this->db->where(array('product_id'=>$pid, 'user_id'=>$uid));
		$res = $this->db->update('tbl_products', array('is_deleted'=>1));
		if($res){
        	$this->common_model->showAlert(1, 'Product deleted..!');
        }else{
        	$this->common_model->showAlert(0, 'Product not deleted..!');
        }
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function messages()
	{
		$this->load->view('user_messages');
	}
}
