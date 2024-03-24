<?php
class Shareget_model extends CI_Model
{
	
 	function get_user_by_id($uid)
 	{
 		$res = $this->db->get_where('tbl_users', array('id' => $uid));
 		if ($res->num_rows() > 0) {
   			return $res->result();
		}else{
			return false;
		}
 	}

 	function get_bloods()
 	{
 		$this->db->select('a.*, group_concat(b.id) as sub_cate_id, group_concat(b.sub_cate_name) as sub_cate, group_concat(b.sub_cate_name_hindi) as sub_cate_hindi');
		$this->db->from('tbl_cate a');
		$this->db->where('a.id', 1);
		$this->db->join('tbl_sub_cate b', 'b.cate_id = a.id', 'inner');
		$res = $this->db->get();
		if ($res->num_rows() > 0) {
			return $res->result();
		}else{
			return array();
		}
 	}


	 function get_search_location_based_products($offset, $limit, $count, $location, $category)
 	{
 		$this->db->select('p.*, c.cate_name as cate_name, c.cate_name_hindi as cate_name_hindi, sc.sub_cate_name as sub_cate_name, sc.sub_cate_name_hindi as sub_cate_name_hindi, u.profile_pic as user_pic, u.id as user_id, u.location as location');
		$this->db->from('tbl_products p');
		$this->db->where(array('p.is_deleted'=>0, 'u.is_deleted'=>0, 'u.status'=>0));
		$this->db->where('u.location', $location);
		if($category){
		$this->db->where('p.product_name', $category);
		}
		$this->db->order_by('p.product_id', 'desc');
		$this->db->join('tbl_users u', 'p.user_id = u.id', 'inner');
		$this->db->join('tbl_cate c', 'p.cate_id = c.id', 'inner');
		$this->db->join('tbl_sub_cate sc', 'p.subcate_id = sc.id', 'inner');

		if($count){
			return $this->db->count_all_results();
		}
		else{

			$this->db->limit($offset, $limit);
			$res = $this->db->get();
			if ($res->num_rows() > 0) {
				return $res->result();
			}
		}

		return array();
 	}
	 

 	function get_all_products($offset, $limit, $count)
 	{
		
 		$this->db->select('p.*, c.cate_name as cate_name, c.cate_name_hindi as cate_name_hindi, sc.sub_cate_name as sub_cate_name, sc.sub_cate_name_hindi as sub_cate_name_hindi, u.profile_pic as user_pic, u.id as user_id, u.location as location');
		$this->db->from('tbl_products p');
		$this->db->where(array('p.is_deleted'=>0, 'u.is_deleted'=>0, 'u.status'=>0));
				$cur_date = date('Y-m-d');
		$this->db->where('p.expiry >',$cur_date);
		$this->db->order_by('p.product_id', 'desc');
		$this->db->join('tbl_users u', 'p.user_id = u.id', 'inner');
		$this->db->join('tbl_cate c', 'p.cate_id = c.id', 'inner');
		$this->db->join('tbl_sub_cate sc', 'p.subcate_id = sc.id', 'inner');
		
		if($count){
			return $this->db->count_all_results();
		}
		else{

			$this->db->limit($offset, $limit);
			$res = $this->db->get();
			if ($res->num_rows() > 0) {
				return $res->result();
			}
		}

		return array();
 	}

	 function get_all_products2($offset, $limit, $count)
 	{
		
 		$this->db->select('p.*, c.cate_name as cate_name, c.cate_name_hindi as cate_name_hindi, sc.sub_cate_name as sub_cate_name, sc.sub_cate_name_hindi as sub_cate_name_hindi, u.profile_pic as user_pic, u.id as user_id, u.location as location');
		$this->db->from('tbl_products p');
		$this->db->where(array('p.is_deleted'=>0, 'u.is_deleted'=>0, 'u.status'=>0));
		$this->db->order_by('p.product_id', 'desc');
		$this->db->join('tbl_users u', 'p.user_id = u.id', 'inner');
		$this->db->join('tbl_cate c', 'p.cate_id = c.id', 'inner');
		$this->db->join('tbl_sub_cate sc', 'p.subcate_id = sc.id', 'inner');
		
		if($count){
			return $this->db->count_all_results();
		}
		else{

			$this->db->limit($offset, $limit);
			$res = $this->db->get();
			if ($res->num_rows() > 0) {
				return $res->result();
			}
		}

		return array();
 	}
	
 	function get_user_products($offset, $limit, $count, $uid)
 	{
 		$this->db->select('p.*, c.cate_name as cate_name, c.cate_name_hindi as cate_name_hindi, sc.sub_cate_name as sub_cate_name, sc.sub_cate_name_hindi as sub_cate_name_hindi, u.profile_pic as user_pic, u.id as user_id, u.location as location');
		$this->db->from('tbl_products p');
		$this->db->where(array('p.is_deleted' => 0, 'p.user_id' => $uid, 'u.status'=>0));
		$this->db->order_by('p.product_id', 'desc');
		$this->db->join('tbl_users u', 'p.user_id = u.id', 'inner');
		$this->db->join('tbl_cate c', 'p.cate_id = c.id', 'inner');
		$this->db->join('tbl_sub_cate sc', 'p.subcate_id = sc.id', 'inner');

		if($count){
			return $this->db->count_all_results();
		}
		else{

			$this->db->limit($offset, $limit);
			$res = $this->db->get();
			if ($res->num_rows() > 0) {
				return $res->result();
			}
		}

		return array();
 	}
	
 	function get_wishlist_products($offset, $limit, $count, $uid)
 	{
 		
 		$this->db->select('p.*, c.cate_name as cate_name, c.cate_name_hindi as cate_name_hindi, sc.sub_cate_name as sub_cate_name, sc.sub_cate_name_hindi as sub_cate_name_hindi, u.profile_pic as user_pic, u.id as user_id, u.location as location, wl.id as wished');
		$this->db->from('tbl_products p');
		$this->db->where(array('p.is_deleted'=>0, 'u.is_deleted'=>0, 'u.status'=>0));
			$cur_date = date('Y-m-d');
		$this->db->where('p.expiry >',$cur_date);
		$this->db->order_by('p.product_id', 'desc');
		$this->db->join('tbl_users u', 'p.user_id = u.id', 'inner');
		$this->db->join('tbl_cate c', 'p.cate_id = c.id', 'inner');
		$this->db->join('tbl_sub_cate sc', 'p.subcate_id = sc.id', 'inner');
		$this->db->join('tbl_wishlists wl', 'p.product_id = wl.product_id and wl.user_id = '.$uid, 'inner');

		if($count){
			return $this->db->count_all_results();
		}
		else{

			$this->db->limit($offset, $limit);
			$res = $this->db->get();
			if ($res->num_rows() > 0) {
				return $res->result();
			}
		}

		return array();
 	}
	
 	function get_type_products($offset, $limit, $count, $type, $type_id)
 	{
 		if($type == 'cate'){
 			$where = array('p.is_deleted'=>0, 'u.is_deleted'=>0, 'u.status'=>0, 'p.cate_id'=>$type_id);
 		}else{
 			$where = array('p.is_deleted'=>0, 'u.is_deleted'=>0, 'u.status'=>0, 'p.subcate_id'=>$type_id);
 		}
 		$this->db->select('p.*, c.cate_name as cate_name, c.cate_name_hindi as cate_name_hindi, sc.sub_cate_name as sub_cate_name, sc.sub_cate_name_hindi as sub_cate_name_hindi, u.profile_pic as user_pic, u.id as user_id, u.location as location');
		$this->db->from('tbl_products p');
		$this->db->where($where);
		$cur_date = date('Y-m-d');
		$this->db->where('p.expiry >',$cur_date);
		$this->db->order_by('p.product_id', 'desc');
		$this->db->join('tbl_users u', 'p.user_id = u.id', 'inner');
		$this->db->join('tbl_cate c', 'p.cate_id = c.id', 'inner');
		$this->db->join('tbl_sub_cate sc', 'p.subcate_id = sc.id', 'inner');

		if($count){
			return $this->db->count_all_results();
		}
		else{

			$this->db->limit($offset, $limit);
			$res = $this->db->get();
			if ($res->num_rows() > 0) {
				return $res->result();
			}
		}

		return array();
 	}

	 function get_type_products2($offset, $limit, $count, $type, $type_id)
 	{
 		if($type == 'cate'){
 			$where = array('p.is_deleted'=>0, 'u.is_deleted'=>0, 'u.status'=>0, 'p.cate_id'=>$type_id);
 		}else{
 			$where = array('p.is_deleted'=>0, 'u.is_deleted'=>0, 'u.status'=>0, 'p.subcate_id'=>$type_id);
 		}
 		$this->db->select('p.*, c.cate_name as cate_name, c.cate_name_hindi as cate_name_hindi, sc.sub_cate_name as sub_cate_name, sc.sub_cate_name_hindi as sub_cate_name_hindi, u.profile_pic as user_pic, u.id as user_id, u.location as location');
		$this->db->from('tbl_products p');
		$this->db->where($where);
		$this->db->order_by('p.product_id', 'desc');
		$this->db->join('tbl_users u', 'p.user_id = u.id', 'inner');
		$this->db->join('tbl_cate c', 'p.cate_id = c.id', 'inner');
		$this->db->join('tbl_sub_cate sc', 'p.subcate_id = sc.id', 'inner');

		if($count){
			return $this->db->count_all_results();
		}
		else{

			$this->db->limit($offset, $limit);
			$res = $this->db->get();
			if ($res->num_rows() > 0) {
				return $res->result();
			}
		}

		return array();
 	}

 	// To create chat profile in another db

	public function init_chat_profile($data){

		if(isset($data)){

			$file_upload_name = 'default.jpeg';

			//Data
			$unique_id = $data['chat_unique_id']; // substr(md5(microtime()), rand(0,25), 6);
			$user_fname = $data['username'];
			$user_lname = '';
			$user_email = $data['email'];
			$user_phone = $data['phone'];
			$user_pass = $data['password'];
			$created_at = date('d-m-Y');
			$user_avtar = $file_upload_name;
			$user_token = $data['user_token'];
			$user_status = 'active';

			$data_arr = array(
				'unique_id' => $unique_id,
				'user_fname' => $user_fname,
				'user_lname' => $user_lname,
				'user_email' => $user_email,
				'phone' => $user_phone,
				'user_pass' => $user_pass,
				'user_avtar' => $user_avtar,
				'created_at'=> $created_at,
				'user_status' => $user_status,
				'user_token' => $user_token
			);

			$this->db->insert('tbl_chat_user',$data_arr);
			$this->idUpdate();
			return true;
			$username = $user_fname." ".$user_lname;
			$image = $user_avtar;
			$session_arr = array(
				'chat_username' => $username,
				'chat_image' => $image,
				'chat_uniqueid' => $unique_id
			);
			$this->session->set_userdata($session_arr);
				
		}
	}

	public function idUpdate(){
		$this->db->select('unique_id');
		$unique_id = $this->db->get('tbl_chat_user')->result_array();
		$totalId = count($unique_id);
		for ($i=0; $i < $totalId; $i++) {
			$data = $unique_id[$i]['unique_id'];
			$count = $i + 1;
			$this->db->query("UPDATE tbl_chat_user SET id = '$count' WHERE unique_id = '$data'");
		}
	}

}