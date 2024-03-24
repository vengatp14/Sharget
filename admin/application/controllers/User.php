<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->db->query("SET time_zone='+05:30'");
		$this->ret = 0;
    }

	public function index()
	{
		$this->db->order_by('id', 'desc');
		$this->db->where('is_deleted', '0');
		$query = $this->db->get('tbl_users');
		$data['users'] = $query->result_array();
		$this->load->view('users', $data);
	}

	public function items($uid)
	{
		$data['uid'] = $uid;
		$this->load->view('users_items', $data);
	}

	public function filter_items($uid)
	{
		if($this->input->post()!=""){
			$pname = $this->input->post('pname');
		}else{
			$pname = '';
		}
		$user = $this->shareget_model->get_user_by_id($uid);
		foreach ($user as $u) {
			$data['profilepic'] = $u->profile_pic;
		}

		$data['uid'] = $uid;

		$limit = 10;
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		$this->load->library('Ajax_pagination');

		$config = array();
		$config["base_url"] = base_url('user/filter_items/'.$uid);
		$config["total_rows"] = $this->shareget_model->get_user_products($limit, $offset, $count = true, $uid, $pname);
		$config["per_page"] = $limit;
		$config["uri_segment"] = 4;

		$this->ajax_pagination->initialize($config);

		$res = $this->shareget_model->get_user_products($limit, $offset, $count = false, $uid, $pname);

		$data["links"] = $this->ajax_pagination->create_links();
		$data['products'] = $res;

        $filter_view = $this->load->view('users_items_card', $data, TRUE);
        echo $filter_view;

	}

	public function change_status($uid, $status)
	{
		$this->db->where('id', $uid);
		$res = $this->db->update('tbl_users', array('status'=>$status));
		if($res){
			$disp = "Deactivated";
			if($status==0){
				$disp = "Activated";
			}
        	$this->common_model->showAlert(1, 'User status '.$disp.'..!');
        }else{
        	$this->common_model->showAlert(0, 'User status not changed..!');
        }
		redirect('user');
	}

	public function delete($uid)
	{
		$this->db->where('id', $uid);
		$res = $this->db->update('tbl_users', array('is_deleted'=>1));
		if($res){
			$this->db->where('user_id', $uid);
			$this->db->update('tbl_products', array('is_deleted'=>1));
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

	public function messages()
	{
		$this->db->update('tbl_admin', ['is_contacted'=>0]);
		$this->db->select('cm.*, u.profile_pic');
		$this->db->from('tbl_contact_msg cm')->order_by('cm.id', 'desc');
		$this->db->join('tbl_users u', 'cm.user_id = u.id', 'inner');
		$res = $this->db->get();
		$data['messages'] = $res->result();
		$this->load->view('user_messages', $data);
	}

	public function message_delete($mid)
	{
		$this->db->where('id', $mid);
		$res = $this->db->delete('tbl_contact_msg');
		if($res){
        	$this->common_model->showAlert(1, 'Client message deleted..!');
        }else{
        	$this->common_model->showAlert(0, 'Client message not deleted..!');
        }
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function blogs($bid='')
	{
		if ($bid!='') {
			$data['cmnt_id'] = $bid;
		}
		$data['blogs'] = $this->common_model->fetch_all('tbl_blogs', 'id', 'desc');
		$this->load->view('blogs', $data);
	}

	public function blog_likes($bid)
	{
		$likes = $this->common_model->db_fetch_single('tbl_blogs_likes', 'blog_id', $bid);
		$html = '';
		if($likes){
			foreach ($likes as $l) {
				$uid = $l->user_id;
				$user = $this->shareget_model->get_user_by_id($uid);
				foreach ($user as $u) {
					$user_pic = $u->profile_pic;
					$uname = $u->username;
				}
				$html .= 
					'<p>
						<img class="img-fluid mr-4" style="border-radius: 50%;" src="'.UPLOADED_URL.'profile/'.$user_pic.'" height="30px" width="30px" alt="">
						'.$uname.'
					</p>';
		    }
		}else{
			$html .= '<p class="text-center">No likes yet..!</p>';
		}
		echo $html;
	}

	public function blog_comments($bid)
	{
		$this->db->where('blog_id', $bid)->order_by('updated_at', 'desc');
		$res = $this->db->get('tbl_blogs_comments');
		$comments = array();
		if ($res->num_rows() > 0) {
			$comments = $res->result();
		}
		$html = '';
		if($comments){
			foreach ($comments as $c) {
				$uid = $c->user_id;
				$user = $this->shareget_model->get_user_by_id($uid);
				foreach ($user as $u) {
					$user_pic = $u->profile_pic;
					$uname = $u->username;
				}
				$reply = !empty($c->reply) ? $c->reply : '';
				$html .= 
					'<form class="text-start" action="'.base_url("user/blog_reply/".$bid."/".$uid."/".$c->id).'" method="post">
						<span class="float-end">'.date("m/d/Y", strtotime($c->created_at)).'</span>
		                <p class="d-flex text-start">
		                  <img class="img-fluid mr-4" style="border-radius: 50%;" src="'.UPLOADED_URL.'profile/'.$user_pic.'" height="30px" width="30px" alt="">
		                  <span class="ms-1">'.$uname.'</span>
		                </p>
		                <p class="text-justify">
		                  '.$c->comments.'
		                </p>
		                <textarea name="reply" required class="form-control" placeholder="Reply to this comment...">'.$reply.'</textarea>
		                <div class="text-center mt-2">
		                	<input type="submit" class="btn btn-primary" value="Reply">
		                </div>
		            </form><hr>';
		    }
		}else{
			$html .= '<p class="text-center">No comments yet..!</p>';
		}
		echo $html;
	}

	public function add_blog()
	{
		if($this->input->post('title')!=""){
			$title = $this->input->post('title');
			$descr = $this->input->post('description');
			$this->db->where('title', $title);
			$res = $this->db->get('tbl_blogs');
			if($res->num_rows() > 0){
				$this->common_model->showAlert(0, 'Blog title already added..!');
			}else{
				$insert['title'] = $title;
				$insert['description'] = $descr;
				if(!empty($_FILES['blog_pic']['name'])){
		        	$config['upload_path'] = UPLOADS_PATH.'blogs';
				    $config['allowed_types'] = 'jpg|jpeg|png';
				    $this->load->library('upload', $config);
				    if(!$this->upload->do_upload('blog_pic')){
				        $error = array('error'=>$this->upload->display_errors());
				    }else{
				        $file_data = $this->upload->data();
				        $insert['blog_pic'] = $file_data['file_name'];
				    }
			  	}
				$result = $this->common_model->db_insert('tbl_blogs', $insert);
				if($result){
					$this->common_model->showAlert(1, 'Blog added..!');
				}else{
					$this->common_model->showAlert(0, 'Blog not added..!');
				}
			}
		}
		redirect('user/blogs');
	}

	public function blog_delete($bid)
	{
		$this->db->where('id', $bid);
		$res = $this->db->delete('tbl_blogs');
		if($res){
			$this->db->where('blog_id', $bid);
			$this->db->delete('tbl_blogs_likes');
			$this->db->where('blog_id', $bid);
			$this->db->delete('tbl_blogs_comments');
        	$this->common_model->showAlert(1, 'Blog deleted..!');
        }else{
        	$this->common_model->showAlert(0, 'Blog not deleted..!');
        }
		redirect('user/blogs');
	}

	public function blog_reply($bid, $uid, $cid)
	{
		$update['reply'] = $reply = $this->input->post('reply');
		$this->db->where(array('blog_id' => $bid, 'user_id' => $uid, 'id' => $cid));
		$res = $this->db->update('tbl_blogs_comments', $update);
		if($res){
			$blog = $this->db->get_where('tbl_blogs', array('id'=>$bid))->row('title');
			$insert = array(
				'title' => 'Admin Replied to - '.$blog,
				'description' => $reply,
				'sent_to' => $uid,
				'sent_for' => 'blog',
				'type' => 'individual',
				'token' => time(),
				'blog_id' => $bid
			);
			$res = $this->db->insert('tbl_notifications', $insert);
        	$this->common_model->showAlert(1, 'Reply sent..!');
        }else{
        	$this->common_model->showAlert(0, 'Not replied..!');
        }
		redirect('user/blogs');
	}

	public function notified()
	{
		$nid = $this->input->post('nid');
		$this->db->where('id', $nid);
		echo $this->db->update('tbl_notify_admin', ['is_seen'=>0]);
	}

	public function AutoDelete()
	{
		$AutoDelete = $this->input->post('AutoDelete');
		$uid = 1;
		$this->db->where('id', $uid);
		$result = $this->db->update('tbl_settings', ['Auto_Delete'=>$AutoDelete]);
		if($result == 'true'){
		$Delete = $this->db->select('*')->where('id',1)->get('tbl_settings') ->result();
		if($Delete[0]->Auto_Delete == 'true'){
			$cur_date = date('Y-m-d');
			$this->db->where('expiry <',$cur_date);
	 		$this->db->delete('tbl_products');
		}
		}
	}

	public function ShowExpiry()
	{
		$ShowExpiry = $this->input->post('ShowExpiry');
		$uid = 1;
		$this->db->where('id', $uid);
		echo $this->db->update('tbl_settings', ['Show_Expiry'=>$ShowExpiry]);
	}

}
