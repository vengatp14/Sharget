<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->db->query("SET time_zone='+05:30'");
		$this->ret = 0;
		$this->common_model->auto_session();
    }

	public function index()
	{
		$bid = $this->uri->segment(2);
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
		$comments = $this->common_model->db_fetch_single('tbl_blogs_comments', 'blog_id', $bid);
		$html = '';
		if($comments){
			foreach ($comments as $c) {
				$uid = $c->user_id;
				$user = $this->shareget_model->get_user_by_id($uid);
				foreach ($user as $u) {
					$user_pic = $u->profile_pic;
					$uname = $u->username;
				}
				if ($this->session->userdata('sg_user_id') == $uid) {
					$reply = !empty($c->reply) ? $c->reply : '';
					$html .= 
						'<div class="text-start comments_blog p-4 pt-3 pb-2 mb-3">
			                <a href="'.base_url("blogs/blog_comment_delete/".$c->id).'" class="float-end">
			                	<i class="text-danger fa fa-trash"></i>
			                </a>
			                <p class="d-flex text-start">
			                  	<img class="img-fluid mr-4" style="border-radius: 50%;" src="'.UPLOADED_URL.'profile/'.$user_pic.'" height="30px" width="30px" alt="">
			                  	<span class="ms-4">'.$uname.'</span>
			                </p>
			                <p class="text-justify">
			                  '.$c->comments.'
			                </p>';
			        if(!empty($reply)){
			        	$html .= 
			                '<hr>
			                <p class="text-end">
			                  	Admin replied <i class="fa fa-user-alt text-info"></i>
			                </p>
			                <p class="text-justify">
			                	'.$reply.'
			                </p>';
			        }
			        $html .= '</div>';
				}else{
					$html .= 
						'<div class="text-start comments_blog p-4 pt-3 pb-2 mb-3">
							<p class="d-flex text-start">
			                  	<img class="img-fluid mr-4" style="border-radius: 50%;" src="'.UPLOADED_URL.'profile/'.$user_pic.'" height="30px" width="30px" alt="">
			                  	<span class="ms-4">'.$uname.'</span>
			                </p>
			                <p>
			                  '.$c->comments.'
			                </p>
			            </div>';
		        }
		    }
		}else{
			$html .= '<p class="text-center">No comments yet..!</p>';
		}
		echo $html;
	}

	public function blog_like($bid, $liketype)
	{
		$uid = $this->session->userdata('sg_user_id');
		$data['user_id'] = $uid;
		$data['blog_id'] = $bid;
		$data['likes'] = $liketype;
		$this->db->where(array('blog_id'=>$bid, 'user_id'=>$uid));
		$check = $this->db->get('tbl_blogs_likes');
		if($check->num_rows() > 0){
			$this->db->where(array('blog_id'=>$bid, 'user_id'=>$uid));
			$res = $this->db->update('tbl_blogs_likes', $data);
			if($res){
				if($liketype == 1){
					$this->ret = 1;
					$msg = 'Liked wow..!';
				}else{
					$msg = 'Unliked..!';
				}
			}else{
				$msg = 'Something went wrong..!';
			}
		}else{
			$res = $this->common_model->db_insert('tbl_blogs_likes', $data);
			if($res){
				$this->ret = 1;
				$msg = 'Liked wow..!';
			}else{
				$msg = 'Something went wrong..!';
			}
		}
		$this->common_model->showAlert($this->ret, $msg);
		redirect('blogs');
	}

	public function blog_comment($bid)
	{
		$uid = $this->session->userdata('sg_user_id');
		$data['user_id'] = $uid;
		$data['blog_id'] = $bid;
		$data['comments'] = $comment = $this->input->post('comment');
		$res = $this->common_model->db_insert('tbl_blogs_comments', $data);
		if($res){
			$blog = $this->db->get_where('tbl_blogs', array('id'=>$bid))->row('title');
			$insert = array(
				'title' => $this->session->userdata('sg_user_name')."(".$uid.") "." Commented on - ".$blog,
				'description' => $comment,
				'sent_from' => $uid,
				'sent_for' => 'blog',
				'token' => time(),
				'blog_id' => $bid
			);
			$res = $this->db->insert('tbl_notify_admin', $insert);
			// $this->db->update('tbl_admin', ['is_notify'=>1]);
			$this->ret = 1;
			$msg = 'Comment added..!';
		}else{
			$msg = 'Something went wrong..!';
		}
		$this->common_model->showAlert($this->ret, $msg);
		redirect('blogs');
	}

	public function blog_comment_delete($bcid)
	{
		$res = $this->common_model->db_delete('tbl_blogs_comments', 'id', $bcid);
		if($res){
			$this->ret = 1;
			$msg = 'Comment removed..!';
		}else{
			$msg = 'Something went wrong..!';
		}
		$this->common_model->showAlert($this->ret, $msg);
		redirect('blogs');
	}

}