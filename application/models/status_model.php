<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Status_model extends CI_Model
{
	function __construct()
	{
		parent :: __construct();
	}
	
		function update_text($user,$status_content)        //发布一条状态
	{
		$_id = $user->stu_username;
		$this->load->database();
		
		date_default_timezone_set("Asia/Shanghai");  	
		$time = date("Y-m-d H:i:s", time()) ;   
		     
		$this->db->insert('status', array( 'status_user'    => $_id ,
										   'status_content' => $status_content , 
										   'status_time'    => $time
											  ));
		$affcted_row_num = $this->db->affected_rows();     
		$this->db->close();
		
		return $affcted_row_num;
	}
	
	
	function delete_status($status_id)        //删除一个状态
	{	
		$this->load->database();
		$data = array(
			'status_id' => $status_id
		);
		
		$this->db->delete('status', $data);
		
		$affected_row = $this->db->affected_rows();
		
		$this->db->close();
		
		return $affected_row;	
	}
	
	
	
	function get_status_time_line($user)	// 获取登录用户关注的公共状态信息
	{
		$_id = $user->stu_username;
		
		$this->load->database();
		
		$this->db->select('status.*,stu_info.*,photo_info.photo_url');
		$this->db->from('status,friend,stu_info');      
		$this->db->join('photo_info','photo_info.photo_id = stu_info.stu_photo','left');
		$this->db->where('friend.user_id',$_id); 
		//$this->db->where('friend.type',1);           //type = 1为关注，type = 0为好友       
		$this->db->where('status.status_user = friend.friend_id');
		$this->db->where('stu_info.stu_username = friend.friend_id');
		$this->db->order_by('status.status_time','desc');
		
		
		$query = $this->db->get();
		
		$result_array = $query->result();
		
		$query->free_result();
		$this->db->close();
		
		return $result_array;	
	}
	
	
	
	function get_status_friend_line($user)	// 获取好友状态信息
	{
		$_id = $user->stu_username;
		
		$this->load->database();
		
		$this->db->select('status.*,friend.*');
		$this->db->from('status,friend');      
		$this->db->where('friend.user_id',$_id); 
		$this->db->where('friend.type',0);           //type = 1为关注，type = 0为好友       
		$this->db->where('status.status_user = friend.friend_id');
		
		$query = $this->db->get();
		
		$result_array = $query->result();
		
		$query->free_result();
		$this->db->close();
		
		return $result_array;	
	}
	
	
	
	function get_time_line_by_id($user)		 //获取个人全部状态信息
	{ 
	    $_id = $user->stu_username;
		$this->load->database();
		$this->db->select('*');
		$this->db->where('status_user',$_id);
		$this->db->from('status');
		$this->db->join('stu_info','stu_info.stu_username = status.status_user','inner');
		$query = $this->db->get();
		
		$result_array = $query->result();
		$query->free_result();
		$this->db->close();
		
		return $result_array;
	}
	
	
	function get_status_all_line()		///获取所有注册用户个人状态信息
	{ 	
		$this->load->database();
	
		$query = $this->db->get('status');
		
		$result_array = $query->result();
		
		$query->free_result();
		$this->db->close();
		
		return $result_array;
	}
	
	
	
	function search_keyword_status($keyword)     //搜索关键字状态
	{
		$this->load->database();
			
		$this->db->like('status_content',$keyword);      //状态内容与关键字匹配，模糊查询
		
		$query = $this->db->get('status');
		$result_array = $query->result();
		
		$query->free_result();
		$this->db->close();
		
		return $result_array;
	}
	
	
	function check_comment_num_by_id($status_id)     //统计某条状态下的评论总数
	{
		$this->load->database();
		
		$this->db->where("comment_status_id",$status_id);
		$query = $this->db->get("status_comment");
		$result	= $query->result();
		$query->free_result();            //释放当前查询所占用的内存并删除其关联的资源标识
		$this->db->close();
		return $result;
	
	}
}