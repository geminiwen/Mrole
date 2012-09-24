<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Journal_comment_model extends CI_Model
{
	function __construct()
	{
		parent :: __construct();
	}
	
	function comment_update($user,$comment_journal_id,$comment)		//针对日志发表新评论
	{
		$_id = $user->stu_username;
		
		date_default_timezone_set("Asia/Shanghai");  //php5.1以上时间戳会与实际时间相差8小时，加时间的初始化的语句	
		$time = date("Y-m-d H:i:s", time()) ;        
		
		$this->load->database();
		
		$this->db->insert('journal_comment', array( 'comment_journal_id' => $comment_journal_id ,
		     									    'comment_user' 	     => $_id ,
												    'comment_content'    => $comment , 
												    'comment_time'       => $time
												 ) ); 
		
		$affected_row = $this->db->affected_rows();
		
		$this->db->close();
		
		return $affected_row;
	}
	
	
	
	function comment_reply_update($user,$comment_journal_id,$comment,$comment_reply_id)		//针对评论进行回复
	{
		$_id = $user->stu_username;
		
		date_default_timezone_set("Asia/Shanghai");  //php5.1以上时间戳会与实际时间相差8小时，加时间的初始化的语句	
		$time = date("Y-m-d H:i:s", time()) ;        
		
		$this->load->database();
		
		$this->db->insert('journal_comment', array( 'comment_journal_id' => $comment_journal_id ,
		     									    'comment_user' 	     => $_id ,
												    'comment_content'    => $comment , 
												    'comment_time'       => $time ,
												    'comment_reply_id'   => $comment_reply_id
												 ) ); 
		
		$affected_row = $this->db->affected_rows();
		
		$this->db->close();
		
		return $affected_row;
	}
	
	function get_comment_by_id($id)		 //显示对应日志下的全部评论信息
	{ 
		$this->load->database();
	
		$this->db->select('journal_comment.*');
		$this->db->from('journal_comment');
		$this->db->where('journal_comment.comment_journal_id',$id);
		
		$query = $this->db->get();
		
		$result_array = $query->result();
		
		$query->free_result();
		$this->db->close();
		
		return $result_array;
	}
	
	
	function delete_comment_journal($journal_id)        //删除日志下所有评论
	{	
		$this->load->database();
		
		$data = array(
			'comment_journal_id' => $journal_id
		);
		
		$this->db->delete('journal_comment', $data);
		
		$affected_row = $this->db->affected_rows();
		
		$this->db->close();
		
		return $affected_row;	
	}
	
	
}