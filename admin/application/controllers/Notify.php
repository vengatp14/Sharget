<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notify extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->db->query("SET time_zone='+05:30'");
		$this->ret = 0;
    }

	public function index()
	{
		$this->db->where(array('is_deleted'=>0, 'status'=>0));
		$data['users'] = $this->db->get('tbl_users')->result();
		$this->db->group_by('token');
		$data['notifications'] = $this->db->get('tbl_notifications')->result();
		$this->load->view('notify', $data);
	}

	public function add_new()
	{
		extract($_POST);
		$token = time();
		if($sent_to == 'all'){
			
			$this->db->where(array('is_deleted'=>0, 'status'=>0));
			$res = $this->db->get('tbl_users')->result();
			if (count($res)>0) {
				foreach ($res as $r) {
					$uid = $r->id;
					$insert[] = array(
						'title' => $title,
						'description' => $description,
						'sent_to' => $uid,
						'sent_for' => 'general',
						'type' => 'all',
						'token' => $token
					);
				}
			}

		}else{
			$insert[] = array(
				'title' => $title,
				'description' => $description,
				'sent_to' => $sent_to,
				'sent_for' => 'general',
				'type' => 'individual',
				'token' => $token
			);
		}

		$res = $this->db->insert_batch('tbl_notifications', $insert);
		if($res){
			/*
			$update['is_notify'] = 1;
			if($sent_to == 'all'){
				$this->db->where(array('is_deleted'=>0, 'status'=>0));
			}else{
				$this->db->where('id', $sent_to);
			}
			if($this->db->update('tbl_users', $update)){
			*/
				$this->ret = 1;
				$msg = 'Notification sent..!';
			/*
			}else{
				$msg = 'Something went wrong..!';	
			}
			*/
		}else{
			$msg = 'Something went wrong...';
		}
		$this->common_model->showAlert($this->ret, $msg);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function delete($nid){
		$this->db->where('id', $nid);
		if($this->db->delete('tbl_notifications')){
			$this->ret = 1;
			$msg = 'Notification deleted..!';
		}else{
			$msg = 'Something went wrong..!';	
		}
		$this->common_model->showAlert($this->ret, $msg);
		redirect($_SERVER['HTTP_REFERER']);
	}

}