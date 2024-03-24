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
	
 	function check_cate($cate_name)
 	{
 		$res = $this->db->get_where('tbl_cate', array('cate_name' => $cate_name));
 		if ($res->num_rows() > 0) {
   			return true;
		}else{
			return false;
		}
 	}
	
 	function check_sub_cate($sub_cate)
 	{
 		$this->db->where_in('sub_cate_name', $sub_cate);
 		$res = $this->db->get('tbl_sub_cate');
 		if ($res->num_rows() > 0) {
   			return true;
		}else{
			return false;
		}
 	}
	
 	function check_sub_cate_with_cate_id($cid, $sub_cate)
 	{
 		$this->db->where('cate_id !=', $cid);
 		$this->db->where_in('sub_cate_name', $sub_cate);
 		$res = $this->db->get('tbl_sub_cate');
 		if ($res->num_rows() > 0) {
   			return true;
		}else{
			return false;
		}
 	}

 	function get_categories()
 	{
 		$this->db->select('a.*, group_concat(b.sub_cate_name) as sub_cate');
		$this->db->from('tbl_cate a');
		$this->db->group_by('a.id');
		$this->db->join('tbl_sub_cate b', 'b.cate_id = a.id', 'inner');
		$res = $this->db->get();
		if ($res->num_rows() > 0) {
			return $res->result();
		}else{
			return array();
		}
 	}

 	function get_cate_by_cate_id($cid)
 	{
 		$this->db->select('a.*, group_concat(b.sub_cate_name) as sub_cate, group_concat(b.sub_cate_name_hindi) as sub_cate_hindi, group_concat(b.id) as sub_cate_id');
		$this->db->from('tbl_cate a');
		$this->db->where('a.id', $cid);
		$this->db->join('tbl_sub_cate b', 'b.cate_id = a.id', 'inner');
		$res = $this->db->get();
		if ($res->num_rows() > 0) {
			return $res->result();
		}else{
			return array();
		}
 	}

 	function delete_cate($cid)
 	{
 		$this->db->where('id', $cid);
 		if($this->db->delete('tbl_cate')){
	 		$this->db->where('cate_id', $cid);
 			if($this->db->delete('tbl_sub_cate')){
 				return true;
 			}else{
 				return false;
 			}
	 	}else{
	 		return false;
	 	}
 	}

 	function get_user_products($offset, $limit, $count, $uid, $search)
 	{
 		$this->db->select('p.*, c.cate_name as cate_name, c.cate_name_hindi as cate_name_hindi, sc.sub_cate_name as sub_cate_name, sc.sub_cate_name_hindi as sub_cate_name_hindi, u.profile_pic as user_pic');
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
			if (!empty($search)) {
				$this->db->like('p.product_name', $search);
				$this->db->or_like('p.product_id', $search);
			}
			$this->db->limit($offset, $limit);
			$res = $this->db->get();
			if ($res->num_rows() > 0) {
				return $res->result();
			}
		}

		return array();
 	}

 	function get_products($offset, $limit, $count, $search)
 	{
 		$this->db->select('p.*, c.cate_name as cate_name, c.cate_name_hindi as cate_name_hindi, sc.sub_cate_name as sub_cate_name, sc.sub_cate_name_hindi as sub_cate_name_hindi, u.profile_pic as user_pic');
		$this->db->from('tbl_products p');
		$this->db->where('p.is_deleted', 0);
		$this->db->order_by('p.product_id', 'desc');
		$this->db->join('tbl_users u', 'p.user_id = u.id', 'inner');
		$this->db->join('tbl_cate c', 'p.cate_id = c.id', 'inner');
		$this->db->join('tbl_sub_cate sc', 'p.subcate_id = sc.id', 'inner');

		if($count){
			return $this->db->count_all_results();
		}
		else{
			if (!empty($search)) {
				$this->db->like('p.product_name', $search);
				$this->db->or_like('p.product_id', $search);
			}
			$this->db->limit($offset, $limit);
			$res = $this->db->get();
			if ($res->num_rows() > 0) {
				return $res->result();
			}
		}

		return array();
 	}

 	function get_reported_products($offset, $limit, $count, $search)
 	{
 		$this->db->select('p.*, c.cate_name as cate_name, c.cate_name_hindi as cate_name_hindi, sc.sub_cate_name as sub_cate_name, sc.sub_cate_name_hindi as sub_cate_name_hindi, u.profile_pic as user_pic, u.username as user_name, rp.reason as rep_reason, rp.created_at as reported_at');
		$this->db->from('tbl_report_product rp');
		$this->db->where('p.is_deleted', 0);
		$this->db->order_by('p.product_id', 'desc');
		$this->db->join('tbl_products p', 'p.product_id = rp.product_id', 'inner');
		$this->db->join('tbl_users u', 'p.user_id = u.id', 'inner');
		$this->db->join('tbl_cate c', 'p.cate_id = c.id', 'inner');
		$this->db->join('tbl_sub_cate sc', 'p.subcate_id = sc.id', 'inner');

		if($count){
			return $this->db->count_all_results();
		}
		else{
			if (!empty($search)) {
				$this->db->like('p.product_name', $search);
				$this->db->or_like('p.product_id', $search);
			}
			$this->db->limit($offset, $limit);
			$res = $this->db->get();
			if ($res->num_rows() > 0) {
				return $res->result();
			}
		}

		return array();
 	}

 	function get_reported_users($offset, $limit, $count, $search)
 	{
 		$this->db->select('ru.*, u.username as reported_by, repuse.reason as rep_reason, repuse.created_at as reported_at');
		$this->db->from('tbl_report_user repuse');
		$this->db->where('ru.is_deleted', 0);
		$this->db->order_by('repuse.id', 'desc');
		$this->db->join('tbl_users ru', 'repuse.reported_id = ru.id', 'inner');
		$this->db->join('tbl_users u', 'repuse.user_id = u.id', 'inner');

		if($count){
			return $this->db->count_all_results();
		}
		else{
			if (!empty($search)) {
				$this->db->like('ru.username', $search);
				$this->db->or_like('ru.user_id', $search);
			}
			$this->db->limit($offset, $limit);
			$res = $this->db->get();
			if ($res->num_rows() > 0) {
				return $res->result();
			}
		}

		return array();
 	}

 	public function get_rep_deleted_users()
 	{
 		$this->db->select('ru.*, group_concat(u.username) as reported_by, group_concat(repuse.created_at) as reported_at');
		$this->db->from('tbl_report_user repuse');
		$this->db->join('tbl_users ru', 'repuse.reported_id = ru.id', 'inner');
		$this->db->join('tbl_users u', 'repuse.user_id = u.id', 'inner');
		$this->db->where('ru.is_deleted', 1);
		$this->db->order_by('repuse.id', 'desc');

		$res = $this->db->get();
		// print_r($this->db->last_query());
		if ($res->num_rows() > 0) {
			$data = $res->result();
			if ($data[0]->id > 0) {
				return $data;
			}
		}

		return array();
 	}

 	public function get_rep_deleted_products()
 	{
 		$this->db->select('p.*, group_concat(u.username) as reported_by, group_concat(rp.created_at) as reported_at, up.username as uploaded_by');
		$this->db->from('tbl_report_product rp');
		$this->db->join('tbl_products p', 'rp.product_id = p.product_id', 'inner');
		$this->db->join('tbl_users u', 'rp.user_id = u.id', 'inner');
		$this->db->join('tbl_users up', 'p.user_id = up.id', 'inner');
		$this->db->where('p.is_deleted', 1);
		$this->db->order_by('rp.id', 'desc');

		$res = $this->db->get();
		if ($res->num_rows() > 0) {
			$data = $res->result();
			if ($data[0]->product_id > 0) {
				return $data;
			}
		}

		return array();
 	}

 	public function get_deleted_users()
 	{
 		$this->db->select('reported_id');
		$excludedData = $this->db->get('tbl_report_user')->result_array();
		if(count($excludedData) > 0){
			foreach($excludedData as $key => $record){
			    $excludedData[$key] = $record['reported_id'];
			}
			$this->db->where_not_in('id', $excludedData);
		}
		$this->db->where('is_deleted', 1);
		$res = $this->db->get('tbl_users');
		if ($res->num_rows() > 0) {
			return $res->result();
		}

		return array();
 	}

 	public function get_deleted_products()
 	{
 		$this->db->select('product_id');
		$excludedData = $this->db->get('tbl_report_product')->result_array();
		if(count($excludedData) > 0){
			foreach($excludedData as $key => $record){
			    $excludedData[$key] = $record['product_id'];
			}
			$this->db->where_not_in('product_id', $excludedData);
		}
		$this->db->where('is_deleted', 1);
		$res = $this->db->get('tbl_products');
		if ($res->num_rows() > 0) {
			return $res->result();
		}

		return array();
 	}

}