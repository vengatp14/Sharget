<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->db->query("SET time_zone='+05:30'");
		$this->ret = 0;
		$this->common_model->auto_session();
    }

    public function add()
    {
    	extract($_POST);
    	$insert['user_id'] = $this->session->userdata('sg_user_id');
    	$insert['cate_id'] = $category;
    	$insert['subcate_id'] = $sub_category;
    	$insert['product_name'] = $pname;
    	$insert['description'] = addslashes($description);

    	$cate = $this->db->get_where('tbl_cate', array('id' => $category))->result();
    	foreach ($cate as $c) {
    		$validity = $c->cate_validity;
    	}
    	$insert['expiry'] = date('Y-m-d', strtotime(' + '.$validity.' days'));

    	$imgs_count = !empty($_FILES['product_pic']['name']) ? count($_FILES['product_pic']['name']) : 0;
    	if(!empty($_FILES['product_image']['name'])){
        	$config['upload_path'] = UPLOADS_PATH.'products';
		    $config['allowed_types'] = 'jpg|jpeg|png';
        	$config['file_ext_tolower'] = TRUE;
        	$new_name = time().pathinfo($_FILES["product_image"]['name'], PATHINFO_EXTENSION);
			$config['file_name'] = $new_name;

		    $this->load->library('upload', $config);

		    if(!$this->upload->do_upload('product_image')){
		        $msg = $this->upload->display_errors();
		        $this->common_model->showAlert($this->ret, $msg);
		        redirect($_SERVER['HTTP_REFERER']);
		    }else{
		        $file_data = $this->upload->data();
		        $insert['product_pic'] = $file_data['file_name'];
		    }
        }
        if($imgs_count > 0){
        	$imgs = array();
	        for ($i=0; $i < $imgs_count; $i++) {
	        	if(!empty($_FILES['product_pic']['name'][$i])){

	        		$_FILES['images']['name'] 	  = $_FILES['product_pic']['name'][$i];
	        		$_FILES['images']['type'] 	  = $_FILES['product_pic']['type'][$i];
	        		$_FILES['images']['tmp_name'] = $_FILES['product_pic']['tmp_name'][$i];
		            $_FILES['images']['error']    = $_FILES['product_pic']['error'][$i];
		            $_FILES['images']['size']     = $_FILES['product_pic']['size'][$i];

		        	$config['upload_path'] = UPLOADS_PATH.'products';
				    $config['allowed_types'] = 'jpg|jpeg|png';
		        	$config['file_ext_tolower'] = TRUE;
		        	$new_name = time().pathinfo($_FILES["images"]['name'], PATHINFO_EXTENSION);
					$config['file_name'] = $new_name;

				    $this->load->library('upload', $config);

				    if(!$this->upload->do_upload('images')){
				        $msg = $this->upload->display_errors();
				        $this->common_model->showAlert($this->ret, $msg);
				        redirect($_SERVER['HTTP_REFERER']);
				    }else{
				        $file_data = $this->upload->data();
				        $imgs[] = $file_data['file_name'];
				    }
		        }
	        }
	        $insert['images'] = implode(',', $imgs);
	    }
	    $res = $this->common_model->db_insert('tbl_products', $insert);
	    if($res){
	    	$this->ret = 1;
	    	$msg = "Product added..!";
	    }else{
	    	$msg = "Oops! Product not added..!";
	    }
	    $this->common_model->showAlert($this->ret, $msg);
	    redirect($_SERVER['HTTP_REFERER']);
    }

    public function edit($pid)
    {
    	extract($_POST);
    	$update['user_id'] = $this->session->userdata('sg_user_id');
    	$update['cate_id'] = $category;
    	$update['subcate_id'] = $sub_category;
    	$update['product_name'] = $pname;
    	$update['description'] = addslashes($description);

    	$cate = $this->db->get_where('tbl_cate', array('id' => $category))->result();
    	foreach ($cate as $c) {
    		$validity = $c->cate_validity;
    	}
    	$update['expiry'] = date('Y-m-d', strtotime(' + '.$validity.' days'));

    	$imgs_count = !empty($_FILES['product_pic']['name']) ? count($_FILES['product_pic']['name']) : 0;
    	if(!empty($_FILES['product_image']['name'])){
        	$config['upload_path'] = UPLOADS_PATH.'products';
		    $config['allowed_types'] = 'jpg|jpeg|png';
        	$config['file_ext_tolower'] = TRUE;
        	$new_name = time().pathinfo($_FILES["product_image"]['name'], PATHINFO_EXTENSION);
			$config['file_name'] = $new_name;

		    $this->load->library('upload', $config);

		    if(!$this->upload->do_upload('product_image')){
		        $msg = $this->upload->display_errors();
		        $this->common_model->showAlert($this->ret, $msg);
		        redirect($_SERVER['HTTP_REFERER']);
		    }else{
		        $file_data = $this->upload->data();
		        $update['product_pic'] = $file_data['file_name'];
		    }
        }
        if($imgs_count > 0){
        	$imgs = array();
	        for ($i=0; $i < $imgs_count; $i++) {
	        	if(!empty($_FILES['product_pic']['name'][$i])){

	        		$_FILES['images']['name'] 	  = $_FILES['product_pic']['name'][$i];
	        		$_FILES['images']['type'] 	  = $_FILES['product_pic']['type'][$i];
	        		$_FILES['images']['tmp_name'] = $_FILES['product_pic']['tmp_name'][$i];
		            $_FILES['images']['error']    = $_FILES['product_pic']['error'][$i];
		            $_FILES['images']['size']     = $_FILES['product_pic']['size'][$i];

		        	$config['upload_path'] = UPLOADS_PATH.'products';
				    $config['allowed_types'] = 'jpg|jpeg|png';
		        	$config['file_ext_tolower'] = TRUE;
		        	$new_name = time().pathinfo($_FILES['images']['name'], PATHINFO_EXTENSION);
					$config['file_name'] = $new_name;

				    $this->load->library('upload', $config);

				    if(!$this->upload->do_upload('images')){
				        $msg = $this->upload->display_errors();
				        $this->common_model->showAlert($this->ret, $msg);
				        redirect($_SERVER['HTTP_REFERER']);
				    }else{
				        $file_data = $this->upload->data();
				        $imgs[] = $file_data['file_name'];
				    }
		        }
	        }
	        $update['images'] = implode(',', $imgs);
	    }

		// print"<pre>";
		// print_r($update);
		// exit;

	    $res = $this->common_model->db_update('tbl_products', 'product_id', $pid, $update);
	    if($res){
	    	$this->ret = 1;
	    	$msg = "Product updated..!";
	    }else{
	    	$msg = "Oops! Product not updated..!";
	    }
	    $this->common_model->showAlert($this->ret, $msg);
	    redirect($_SERVER['HTTP_REFERER']);
    }

	public function view($pid)
	{
		$data['product'] = $this->db->get_where('tbl_products', array('product_id'=>$pid))->result();
		$this->load->view('item_view', $data);
	}

	public function report_product()
	{
		$insert['user_id'] = $uid = $this->session->userdata('sg_user_id');
		$insert['product_id'] = $pid = $this->input->post('report_product_id');
		$insert['reason'] = $reason = $this->input->post('report_reason');
		$res = $this->common_model->db_insert('tbl_report_product', $insert);
		if($res){
			$uname = $this->session->userdata('sg_user_name');
			$pname = $this->db->get_where('tbl_products', array('product_id'=>$pid))->row('product_name');
			$insert = array(
				'title' => $pname."($pid)"." Reported by - ".$uname."($uid)",
				'description' => $reason,
				'sent_from' => $uid,
				'sent_for' => 'report',
				'type' => 'product',
				'token' => time(),
				'reported_id' => $pid
			);
			$res = $this->db->insert('tbl_notify_admin', $insert);
	    	$this->ret = 1;
	    	$msg = "Product reported..!";
	    }else{
	    	$msg = "Something went wrong..!";
	    }
	    $this->common_model->showAlert($this->ret, $msg);
	    redirect($_SERVER['HTTP_REFERER']);
	}

	public function report_user()
	{
		$insert['user_id'] = $uid = $this->session->userdata('sg_user_id');
		$insert['reported_id'] = $reportId = $this->input->post('report_user_id');
		$insert['reason'] = $reason = $this->input->post('report_reason');
		$res = $this->common_model->db_insert('tbl_report_user', $insert);
		if($res){
			$uname = $this->session->userdata('sg_user_name');
			$report_name = $this->db->get_where('tbl_users', array('id'=>$reportId))->row('username');
			$insert = array(
				'title' => $report_name."($reportId)"." Reported by - ".$uname."($uid)",
				'description' => $reason,
				'sent_from' => $uid,
				'sent_for' => 'report',
				'type' => 'user',
				'token' => time(),
				'reported_id' => $reportId
			);
			$res = $this->db->insert('tbl_notify_admin', $insert);
	    	$this->ret = 1;
	    	$msg = "User reported..!";
	    }else{
	    	$msg = "Something went wrong..!";
	    }
	    $this->common_model->showAlert($this->ret, $msg);
	    redirect($_SERVER['HTTP_REFERER']);
	}

	public function get_all_products()
	{
		$limit = 10;
		$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$expire = $this->db->select('*')->where('id',1)->get('tbl_settings') ->result();
		$this->load->library('Ajax_pagination');

		$config = array();
		if($expire[0]->Show_Expiry == 'true'){
			$config["base_url"] = base_url('items/get_all_products/');
			$config["total_rows"] = $this->shareget_model->get_all_products($limit, $offset, $count = true);
		}else{
			$config["base_url"] = base_url('items/get_all_products2/');
			$config["total_rows"] = $this->shareget_model->get_all_products2($limit, $offset, $count = true);
		}
		
		$config["per_page"] = $limit;
		$config["uri_segment"] = 3;

		$this->ajax_pagination->initialize($config);
		
		if($expire[0]->Show_Expiry == 'true'){
			$res = $this->shareget_model->get_all_products($limit, $offset, $count = false);
		}else{
			$res = $this->shareget_model->get_all_products2($limit, $offset, $count = false);
		}
		

		$data["links"] = $this->ajax_pagination->create_links();
		$data['products'] = $res;

        $filter_view = $this->load->view('common/products', $data, TRUE);
        echo $filter_view;
	}

	public function search_location()
	{
		$limit = 10;
		$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = $this->input->post();
		$location = $this->input->post('location');
		$category = $this->input->post('category');
		$this->load->library('Ajax_pagination');

		$config = array();
		$config["base_url"] = base_url('items/get_search_location_based_products/');
		$config["total_rows"] = $this->shareget_model->get_search_location_based_products($limit, $offset, $count = true, $location, $category);
		$config["per_page"] = $limit;
		$config["uri_segment"] = 3;
		

		$this->ajax_pagination->initialize($config);

		$res = $this->shareget_model->get_search_location_based_products($limit, $offset, $count = false, $location, $category);

		$data["links"] = $this->ajax_pagination->create_links();
		$data['products'] = $res;

        $filter_view = $this->load->view('common/products', $data, TRUE);
        echo $filter_view;
	}

	public function get_user_products()
	{
		$limit = 10;
		$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$uid = $this->session->userdata('sg_user_id');

		$this->load->library('Ajax_pagination');

		$config = array();
		$config["base_url"] = base_url('items/get_user_products/');
		$config["total_rows"] = $this->shareget_model->get_user_products($limit, $offset, $count = true, $uid);
		$config["per_page"] = $limit;
		$config["uri_segment"] = 3;

		$this->ajax_pagination->initialize($config);

		$res = $this->shareget_model->get_user_products($limit, $offset, $count = false, $uid);

		$data["links"] = $this->ajax_pagination->create_links();
		$data['products'] = $res;

        $filter_view = $this->load->view('common/products', $data, TRUE);
        echo $filter_view;
	}

	public function get_wished_products()
	{
		$limit = 10;
		$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$uid = $this->session->userdata('sg_user_id');

		$this->load->library('Ajax_pagination');

		$config = array();
		$config["base_url"] = base_url('items/get_wished_products/');
		$config["total_rows"] = $this->shareget_model->get_wishlist_products($limit, $offset, $count = true, $uid);
		$config["per_page"] = $limit;
		$config["uri_segment"] = 3;

		$this->ajax_pagination->initialize($config);

		$res = $this->shareget_model->get_wishlist_products($limit, $offset, $count = false, $uid);

		$data["links"] = $this->ajax_pagination->create_links();
		$data['products'] = $res;

        $filter_view = $this->load->view('common/products', $data, TRUE);
        echo $filter_view;
	}

	public function get_type_products()
	{
		$limit = 10;
		$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$type = $this->input->post('type');
		$type_id = $this->input->post('type_id');

		$this->load->library('Ajax_pagination');

		$config = array();
		$config["base_url"] = base_url('items/get_type_products/');
		$config["total_rows"] = $this->shareget_model->get_type_products($limit, $offset, $count = true, $type, $type_id);
		$config["per_page"] = $limit;
		$config["uri_segment"] = 3;

		$this->ajax_pagination->initialize($config);

		$res = $this->shareget_model->get_type_products($limit, $offset, $count = false, $type, $type_id);

		$data["links"] = $this->ajax_pagination->create_links();
		$data['products'] = $res;

        $filter_view = $this->load->view('common/products', $data, TRUE);
        echo $filter_view;
	}

	public function cate($cid)
	{
		$data['type'] = 'cate';
		$data['type_id'] = $cid;
		$data['catename'] = $this->db->get_where('tbl_cate', array('id'=>$cid))->row('cate_name');
		$this->load->view('items', $data);
	}

	public function sub($cid)
	{
		$data['type'] = 'subcate';
		$data['type_id'] = $cid;
		$data['catename'] = $this->db->get_where('tbl_sub_cate', array('id'=>$cid))->row('sub_cate_name');
		$this->load->view('items', $data);
	}

	public function delete_this_product($pid)
	{
		$this->db->where('product_id', $pid);
		$res = $this->db->update('tbl_products', array('is_deleted'=>1));
		if($res){
			$this->ret = 1;
			$msg = "Post deleted..!";
		}else{
			$msg = "Something went wrong..!";
		}
		$this->common_model->showAlert($this->ret, $msg);
		redirect($_SERVER["HTTP_REFERER"]);
	}

	public function delete_product_pic($pid, $picind)
	{
		$res = $this->db->get_where('tbl_products', array('product_id'=>$pid));
		if($res->num_rows() > 0){
			foreach ($res->result() as $p) {
				if(!empty($p->images)){
					$imgs = explode(',',$p->images);
					for ($i=0; $i < count($imgs); $i++) {
						if($picind == $i){
							$path = UPLOADS_PATH.'products/'.$imgs[$i];
							unlink($path);
						}else{
							$upImgs[] = $imgs[$i];
						}
					}
				}
			}

			$update['images'] = implode(",", $upImgs);

			$this->db->where('product_id', $pid);
			$res = $this->db->update('tbl_products', $update);
			if($res){
				$this->ret = 1;
				$msg = "Post image deleted..!";
			}else{
				$msg = "Something went wrong..!";
			}
		}else{
			$msg = "Something went wrong..!";
		}
		$this->common_model->showAlert($this->ret, $msg);
		redirect($_SERVER["HTTP_REFERER"]);
	}

}
