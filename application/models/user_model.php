<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model
{
	function __construct()
	{
		parent :: __construct();
	}
	function query_by_username($num)                //检查用户名
	{
		$this->load->database();
		$this->db->where("stu_username",$num);
		$this->db->where("stu_checked",0);
		$query = $this->db->get("stu_info");
		$result	= $query->result();
		$query->free_result();            //释放当前查询所占用的内存并删除其关联的资源标识
		$this->db->close();
		return $result;
	}
	
	function insert_newuser($username,$realname,$data)     // 请求注册
	{
		$this->load->database();
		$this->db->trans_begin();         //使用事务来运行查询并根据查询的成功或失败来决定提交还是回滚
		$this->db->where('stu_username',$username);
		$this->db->where('stu_realname',$realname);
		$this->db->where('stu_checked',0);
		$this->db->update('stu_info',$data);
		$this->db->insert('friend', array('user_id' => $username, 'friend_id' => $username));  //注册成功即把自己加为好友
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();     //回滚
        }else
        {
				// 事务提交
                $this->db->trans_commit();
        }
		$affcted_row_num = $this->db->affected_rows();     //affected_rows()是执行INSERT,UPDATE和DELETE查询后受到影响的记录数目
		                                                   //SELECT查询可用num_rows().
		$this->db->close();
		
		return $affcted_row_num;
	}
	
	
	function update_newuser($user,$data)    // 请求修改注册信息
	{
		$_id = $user->stu_username;
		$this->load->database();
		$this->db->trans_begin();         //使用事务来运行查询并根据查询的成功或失败来决定提交还是回滚
		$this->db->where('stu_username',$_id);
		$this->db->update('stu_info',$data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();     //回滚
        }else
        {
				// 事务提交
                $this->db->trans_commit();
        }
		$affcted_row_num = $this->db->affected_rows();     //affected_rows()是执行INSERT,UPDATE和DELETE查询后受到影响的记录数目
		                                                   //SELECT查询可用num_rows().
		$this->db->close();
		
		return $affcted_row_num;
	}
	
	
	function query_by_username_password($username,$password)   // 请求登录
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
	
	function add_friend($user_id,$friend_id)          //添加好友
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
	
	function delete_friend($user_id,$friend_id)     //删除好友
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

}
