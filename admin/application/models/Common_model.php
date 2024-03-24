<?php
class Common_model extends CI_Model
{
	function showAlert($type, $msg)
	{
		if($type==1){
			$this->session->set_flashdata("message",'<div class="alert manosuccess">
				        <a onclick="closeshownAlert()"><i class="fa fa-times"></i></a>
				        <p><b>Success!</b> '.$msg.'</p>
				    </div>');
		}else{
			$this->session->set_flashdata("message",'<div class="alert manofailed">
				        <a onclick="closeshownAlert()"><i class="fa fa-times"></i></a>
				        <p><b>Failed!</b> '.$msg.'</p>
				    </div>');
		}
	}

 	function fetch_all($table, $orderBy, $order)
 	{
 		$this->db->order_by($orderBy, $order);
  		return $this->db->get($table)->result();
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

 	function db_insert_last_id($table, $data)
 	{
  		$this->db->insert($table, $data);
  		if ($this->db->affected_rows() > 0) {
   			return $this->db->insert_id();
		}else{
			return false;
		}
 	}

	function db_fetch_single($table, $by, $value)
	{
		$this->db->where($by, $value);
		$res = $this->db->get($table);
		if ($res->num_rows() > 0) {
			return $res->result();
		}else{
			return array();
		}
	}

	function db_update($table, $by, $value, $data)
	{
		$this->db->where($by, $value);
		$res = $this->db->update($table, $data);
		if ($res) {
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
}