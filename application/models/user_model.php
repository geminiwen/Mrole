<?php

class User_model extends CI_Model
{
	function __construct()
	{
		parent :: __construct();
	}
	function check_stu_number($num)
	{
		$this->load->database();
		$this->db->where("stu_username",$num);
		$this->db->where("stu_checked",0);
		$query = $this->db->get("stu_info");
		$result	= $query->result();
		$query->free_result();
		$this->db->close();
		return $result;
	}
	
	function insert_newuser($username,$realname,$data)
	{
		$this->load->database();
		$this->db->where('stu_username',$username);
		$this->db->where('stu_realname',$realname);
		$this->db->where('stu_checked',0);
		$this->db->update('stu_info',$data);
		$affcted_row_num = $this->db->affected_rows();
		$this->db->close();
		return $affcted_row_num;
	}
	
	function query_by_username_password($username,$password)
	{
		$this->load->database();
		$this->db->where('username');
	}

	function user_select($S_ID)
	{
		$this->db->where('S_ID',$S_ID);
		$this->db->select('*');
		$query = $this->db->get('user');
		return $query->result();
	}
		
	function user_update($S_ID,$arr)
	{
		$this->db->where('S_ID',$S_ID);
		$this->db->update('user',$arr);
	}
	
	
	function select($key)
	{
		$this->db->like('S_ID',$key); 
	    $this->db->or_like('username',$key);
		$this->db->or_like('major',$key);
		$this->db->or_like('position',$key);
        $this->db->or_like('grade',$key);
		$query = $this->db->get('user');
		return $query->result();
	}
	
	function e_mail_select($e_mail)
	{
		$this->db->where('e_mail',$e_mail);
		$this->db->select('*');
		$query = $this->db->get('user');
		return $query->result();
	}
}
