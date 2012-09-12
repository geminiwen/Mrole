<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model
{
	function __construct()
	{
		parent :: __construct();
	}
	function query_by_username($num)
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
		$this->db->trans_begin();
		$this->db->where('stu_username',$username);
		$this->db->where('stu_realname',$realname);
		$this->db->where('stu_checked',0);
		$this->db->update('stu_info',$data);
		$this->db->insert('friend', array('user_id' => $id, 'friend_id' => $id));
		if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }else
        {
				// 事务提交
                $this->db->trans_commit();
        }
		$affcted_row_num = $this->db->affected_rows();
		$this->db->close();
		
		return $affcted_row_num;
	}
	
	function query_by_username_password($username,$password)
	{
		$this->load->database();
		$this->db->where('stu_username',$username);
		$this->db->where('stu_password',$password);
		$query = $this->db->get('stu_info');
		$result	= $query->result();
		$query->free_result();
		$this->db->close();
		return $result;
	}
	
	function add_friend($user_id,$id)
	{
		$this->load->database();
		$data = array(
			'user_id' => $user_id,
			'friend_id' => $friend_id
		);
		$this->db->insert('friend', $data);
		
		$affected_row = $this->db->affected_rows();
		
		$this->db->close();
		
		return $affected_row;	
	}
	
	function delete_friend($user_id,$id)
	{
		$this->load->database();
		$data = array(
			'user_id' => $user_id,
			'friend_id' => $friend_id
		);
		$this->db->delete('friend', $data);
		
		$affected_row = $this->db->affected_rows();
		
		$this->db->close();
		
		return $affected_row;	
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
