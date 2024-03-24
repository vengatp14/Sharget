<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->db->query("SET time_zone='+05:30'");
		$this->ret = 0;
    }

	public function index()
	{
		$data['categories'] = $this->shareget_model->get_categories();
		$this->load->view('categories', $data);
	}

	public function edit($cid)
	{
		if($this->input->post()){
			extract($_POST);
			$this->db->where(array('id !='=>$cid, 'cate_name'=>$cate_name));
			$check1 = $this->db->get('tbl_cate');
			$check2 = $this->shareget_model->check_sub_cate_with_cate_id($cid, $sub_cate);
			
			if($check1->num_rows() > 0){
				$this->common_model->showAlert(0, 'Category name already added..!');
			}else if($check2){
				$this->common_model->showAlert(0, 'Some sub categories already added..!');
			}else{
				$update['cate_name'] = $cate_name;
				$update['cate_name_hindi'] = $cate_name_hindi;
				$update['cate_validity'] = $cate_validity;
				if(!empty($_FILES['cate_pic']['name'])){
		        	$config['upload_path'] = UPLOADS_PATH.'cate';
				    $config['allowed_types'] = 'jpg|jpeg|png';
				    $this->load->library('upload', $config);
				    if(!$this->upload->do_upload('cate_pic')){
				        $error = array('error'=>$this->upload->display_errors());
				    }else{
				        $file_data = $this->upload->data();
				        $update['cate_pic'] = $file_data['file_name'];
				    }
			  	}
				$res = $this->common_model->db_update('tbl_cate', 'id', $cid, $update);
				if($res){
					$this->db->where('cate_id', $cid);
	 				$this->db->delete('tbl_sub_cate');
		        	$ins_sub['cate_id'] = $cid;
		        	for ($i=0; $i < count($sub_cate); $i++) {
		        		if($sub_cate[$i] != '' && $sub_cate_hindi[$i] != ''){
			        		$ins_sub['sub_cate_name'] = $sub_cate[$i];
			        		$ins_sub['sub_cate_name_hindi'] = $sub_cate_hindi[$i];
			        		$res_sub = $this->common_model->db_insert('tbl_sub_cate', $ins_sub);
		        		}
		        	}
					if($res_sub){
						$this->common_model->showAlert(1, 'Category details updated..!');
					}else{
						$this->common_model->showAlert(0, 'Something went wrong..!');
					}
				}else{
					$this->common_model->showAlert(0, 'Something went wrong...');
				}
			}
			redirect('category/edit/'.$cid);
		}else{
			$data['cid'] = $cid;
			$data['category'] = $this->shareget_model->get_cate_by_cate_id($cid);
			$this->load->view('edit_category', $data);
		}
	}

	public function add_cate()
	{
		if($this->input->post()){
			extract($_POST);
			$check1 = $this->shareget_model->check_cate($cate_name);
			$check2 = $this->shareget_model->check_sub_cate($sub_cate);
			if($check1){
				$this->common_model->showAlert(0, 'Category name already added..!');
			}else if($check2){
				$this->common_model->showAlert(0, 'Some sub categories already added..!');
			}else{
				if(!empty($_FILES['cate_pic']['name'])){
		        	$config['upload_path'] = UPLOADS_PATH.'cate';
				    $config['allowed_types'] = 'jpg|jpeg|png';
				    $this->load->library('upload', $config);
				    if(!$this->upload->do_upload('cate_pic')){
				        $error = array('error'=>$this->upload->display_errors());
				    }else{
				        $file_data = $this->upload->data();
				        $insert['cate_pic'] = $file_data['file_name'];
				    }
		        }
				$insert['cate_name'] = $cate_name;
				$insert['cate_name_hindi'] = $cate_name_hindi;
				$insert['cate_validity'] = $cate_validity;
				$res = $this->common_model->db_insert_last_id('tbl_cate', $insert);
				
				if($res > 1){
		        	$ins_sub['cate_id'] = $res;
		        	for ($i=0; $i < count($sub_cate); $i++) {
		        		if($sub_cate[$i] != '' && $sub_cate_hindi[$i] != ''){
			        		$ins_sub['sub_cate_name'] = $sub_cate[$i];
			        		$ins_sub['sub_cate_name_hindi'] = $sub_cate_hindi[$i];
			        		$res_sub = $this->common_model->db_insert('tbl_sub_cate', $ins_sub);
		        		}
		        	}
				}
				if($res_sub){
					$this->common_model->showAlert(1, 'Categories added..!');
				}else{
					$this->common_model->showAlert(0, 'Something went wrong..!');
				}
			}
		}
		redirect('category');
	}

	public function delete($cid)
	{
		if($this->shareget_model->delete_cate($cid)){
			$this->common_model->showAlert(1, 'Categories deleted..!');
		}else{
			$this->common_model->showAlert(0, 'Something went wrong..!');
		}
		redirect('category');
	}

	public function delete_sub($sid, $cid)
	{
		$this->db->where(array('id'=>$sid, 'cate_id'=>$cid));
		$res = $this->db->delete('tbl_sub_cate');
		if($res){
			$this->common_model->showAlert(1, 'Sub category deleted..!');
		}else{
			$this->common_model->showAlert(0, 'Something went wrong..!');
		}
		redirect('category/edit/'.$cid);
	}

}
