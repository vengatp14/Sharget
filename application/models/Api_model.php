<?php
class Api_model extends CI_Model
{
 	function fetch_all($table, $orderBy, $order)
 	{
 		$this->db->order_by($orderBy, $order);
  		return $this->db->get($table)->result_array();
 	}

 	function db_insert($table, $data)
 	{
  		$this->db->insert($table, $data);
  		if ($this->db->affected_rows() > 0) {
   			return true;
		}else{
			return false;
		}
 	}

	function db_fetch_single($table, $by, $value)
	{
		$this->db->where($by, $value);
		$query = $this->db->get($table);
		return $query->result_array();
	}

	function db_update($table, $by, $value, $data)
	{
		$this->db->where($by, $value);
		$this->db->update($table, $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	function db_delete($table, $by, $value)
	{
		$this->db->where($by, $value);
		$this->db->delete($table);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}
	
    function auth_check($token){
    	$check = $this->db->get_where("tbl_users", ["user_token"=>$token]);
	    if ($check->num_rows() > 0) {
	    	return true;
	    }else{
	    	return false;
	    }
    }
	
    function auth_email_check($email){
    	$check = $this->db->get_where("tbl_users", ["email"=>$email]);
	    if ($check->num_rows() > 0) {
	    	return true;
	    }else{
	    	return false;
	    }
    }

	function get_profile($table, $by, $value)
	{
		$this->db->where($by, $value);
		$query = $this->db->get($table);
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $single) {
				// $data["fname"] = $single["fname"];
				// $data["lname"] = $single["lname"];
				$data["username"] = $single["username"];
				$data["email"] 	  = $single["email"];
				$data["phone"] 	  = $single["phone"];
				$data["profile_pic"] = $single["profile_pic"];
			}
			return $data;
		}else{
			return false;
		}
	}

	function cate_all($table, $orderBy, $order)
 	{
 		$this->db->order_by($orderBy, $order);
 		$query = $this->db->get($table);
  		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $i => $single) {
				$data[$i]["cate_id"] = $single["id"];
				$data[$i]["cate_name"] = $single["cate_name"];
				$data[$i]["cate_pic"] = UPLOADS_PATH."cate/".$single["cate_pic"];
			}
		}else{
			$data = array();
		}
		return $data;
 	}

	function sub_cate_all($table, $by, $value)
	{
		$this->db->where($by, $value);
		$query = $this->db->get($table);
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $i => $single) {
				$data[$i]["cate_id"] = $single["cate_id"];
				$data[$i]["sub_cate_id"] = $single["id"];
				$data[$i]["sub_cate_name"] = $single["sub_cate_name"];
			}
		}else{
			$data = array();
		}
		return $data;
	}
}