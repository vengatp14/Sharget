<?php
class Common_model extends CI_Model
{
	function showAlert($type, $msg)
	{
		if($type==1){
			$this->session->set_flashdata("message",'<div class="alert manosuccess">
				        <a onclick="closeshownAlert()"><i class="fa fa-times"></i></a>
				        <p class="mb-2"><b>Success!</b></p><p>'.$msg.'</p>
				    </div>');
		}else{
			$this->session->set_flashdata("message",'<div class="alert manofailed">
				        <a onclick="closeshownAlert()"><i class="fa fa-times"></i></a>
				        <p class="mb-2"><b>Failed!</b></p><p>'.$msg.'</p>
				    </div>');
		}
	}

	function get_States(){
		$this->db->order_by("name", "asc");
        $query = $this->db->get_where('states', array('country_code' => 'IN'));
        return $query;  
    }
 
    function get_Cities($State_id){
		$this->db->order_by("name", "asc");
        $query = $this->db->get_where('cities', array('state_id' => $State_id));
        return $query;
    }
	
 	function fetch_all($table, $orderBy, $order)
 	{
 		$this->db->order_by($orderBy, $order);
  		$res = $this->db->get($table);
  		if ($res->num_rows() > 0) {
   			return $res->result();
		}else{
			return array();
		}
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
			return 0;
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

	function otp_email_check($email, $otp){
    	$check = $this->db->get_where("tbl_users", ["email"=>$email, "otp_token"=>$otp]);
	    if ($check->num_rows() > 0) {
	    	return true;
	    }else{
	    	return false;
	    }
    }


    function auto_session()
    {
    	$user = $this->session->userdata('sgUser');
    	if(!empty($user)){
	    	$check = $this->db->query("SELECT * from `tbl_users` WHERE (`status` = '1' OR `is_deleted` = '1') AND `user_token` = '$user'");
		    if ($check->num_rows() > 0) {
		    	$this->session->unset_userdata('sgUser');
    			redirect('home/logout');
		    }
		}
    }

	function get_all_cate()
 	{
 		$this->db->order_by('id', 'asc');
 		$res = $this->db->get('tbl_cate');
 		$data = array();
  		if ($res->num_rows() > 0) {
			foreach ($res->result_array() as $i => $single) {
				$cid = $single["id"];
				$data[$i]["cate_id"] = $cid;
				$data[$i]["cate_name"] = $single["cate_name"];
				$data[$i]["cate_pic"] = UPLOADED_URL.'cate/'.$single["cate_pic"];
				$this->db->where('cate_id', $cid);
				$sub = $this->db->get('tbl_sub_cate');
				if($sub->num_rows() > 0){
					$data[$i]["subcate"] = $sub->result();
				}else{
					$data[$i]["subcate"] = array();
				}
			}
		}
		return $data;
 	}

}