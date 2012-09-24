<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Journal_model extends CI_Model
{
	function __construct()
	{
		parent :: __construct();
	}
	
	
	function update_text($user,$journal_title,$journal_content)           //发布一篇日志
	{
		$_id = $user->stu_username;
		$this->load->database();
		
		date_default_timezone_set("Asia/Shanghai");  	
		$time = date("Y-m-d H:i:s", time()) ;   
		     
		$this->db->insert('journal', array( 'journal_user'    => $_id ,
										    'journal_title'   => $journal_title ,
											'journal_content' => $journal_content , 
											'journal_time'    => $time
											  ));
		$affcted_row_num = $this->db->affected_rows();     
		$this->db->close();
		
		return $affcted_row_num;
	}
	
	
    
	function delete_journal($journal_id)        //删除一篇日志
	{	
	   
		$this->load->database();
		
		$data = array(
		
			'journal_id' => $journal_id
		);
		
		$this->db->delete('journal', $data);
		
		$affected_row = $this->db->affected_rows();
		
		$this->db->close();
		
		return $affected_row;	
	}
	
	
	
	function get_journal_time_line($user)	// 获取登录用户关注的公日志信息
	{
		$_id = $user->stu_username;
		
		$this->load->database();
		
		$this->db->select('journal.*,friend.*');
		$this->db->from('journal,friend');      
		$this->db->where('friend.user_id',$_id); 
		$this->db->where('friend.type',1);           //type = 1为关注，type = 0为好友       
		$this->db->where('journal.journal_user = friend.friend_id');
		
		$query = $this->db->get();
		$result_array = $query->result();
		
		$query->free_result();
		$this->db->close();
		
		return $result_array;	
	}
	
	
	
	function get_journal_friend_line($user)	// 获取好友日志信息
	{
		$_id = $user->stu_username;
		
		$this->load->database();
		
		$this->db->select('journal.*,friend.*');
		$this->db->from('journal,friend');      
		$this->db->where('friend.user_id',$_id); 
		$this->db->where('friend.type',0);           //type = 1为关注，type = 0为好友       
		$this->db->where('journal.journal_user = friend.friend_id');
		
		$query = $this->db->get();
		
		$result_array = $query->result();
		
		$query->free_result();
		$this->db->close();
		
		return $result_array;	
	}
	
	
	
	function get_time_line_by_id($user)		 //获取个人全部日志信息
	{ 
	    $_id = $user->stu_username;
		
		$this->load->database();
	
		$this->db->where('journal_user',$_id);
		
		$query = $this->db->get('journal');
		
		$result_array = $query->result();
		
		$query->free_result();
		$this->db->close();
		
		return $result_array;
	}
	
	
	function get_journal_all_line()		///获取所有注册用户个人日志信息
	{ 	
		$this->load->database();
	
		$query = $this->db->get('journal');
		
		$result_array = $query->result();
		
		$query->free_result();
		$this->db->close();
		
		return $result_array;
	}
	
	
	
	function search_keyword_journal($word)     //搜索关键字状态
	{
		$this->load->database();
			
		$this->db->like('journal_content',$word);      //状态内容与关键字匹配，模糊查询
		$this->db->or_like('journal_title',$word);
		
		$query = $this->db->get('journal');
		$result_array = $query->result();
		
		$query->free_result();
		$this->db->close();
		
		return $result_array;
	}
	
	
	function check_comment_num_by_id($journal_id)     //统计某篇日志下的评论总数
	{
		$this->load->database();
		
		$this->db->where("comment_journal_id",$status_id);
		$query = $this->db->get("journal_comment");
		$result	= $query->result();
		$query->free_result();           
		$this->db->close();
		return $result;
	
	}
}