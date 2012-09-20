<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Status_comment_model extends CI_Model
{
	function __construct()
	{
		parent :: __construct();
	}
		
	function comment_update($user,$comment_status_id,$comment)		//针对状态发表新评论
	{
		$_id = $user->stu_username;
		
		date_default_timezone_set("Asia/Shanghai");  //php5.1以上时间戳会与实际时间相差8小时，加时间的初始化的语句	
		$time = date("Y-m-d H:i:s", time()) ;        
		
		$this->load->database();
		
		$this->db->insert('status_comment', array( 'comment_status_id' => $comment_status_id ,
		     									   'comment_user' 	   => $_id ,
												   'comment_content'   => $comment , 
												   '$comment_time'     => $time
												 ) ); 
		
		$affected_row = $this->db->affected_rows();
		
		$this->db->close();
		
		return $affected_row;
	}
	
	
	
	function comment_reply_update($user,$comment_status_id,$comment,$comment_reply_id)		//针对评论进行回复
	{
		$_id = $user->stu_username;
		
		date_default_timezone_set("Asia/Shanghai");  //php5.1以上时间戳会与实际时间相差8小时，加时间的初始化的语句	
		$time = date("Y-m-d H:i:s", time()) ;        
		
		$this->load->database();
		
		$this->db->insert('status_comment', array( 'comment_status_id' => $comment_status_id ,
		     									   'comment_user' 	   => $_id ,
												   'comment_content'   => $comment , 
												   '$comment_time'     => $time ,
												   '$comment_reply_id' => $comment_reply_id
												 ) ); 
		
		$affected_row = $this->db->affected_rows();
		
		$this->db->close();
		
		return $affected_row;
	}
	
	function get_comment_by_id($id)		 //显示对应状态下的全部评论信息
	{ 
		$this->load->database();
	
		$this->db->select('status_comment.*');
		$this->db->from('status_comment');
		$this->db->where('status_comment.comment_status_id',$id);
		
		$query = $this->db->get();
		
		$result_array = $query->result();
		
		$query->free_result();
		$this->db->close();
		
		return $result_array;
	}
	
	
	function delete_comment_status($status_id)        //删除状态下所有评论
	{	
		$this->load->database();
		$data = array(
			'comment_status_id' => $status_id
		);
		
		$this->db->delete('status_comment', $data);
		
		$affected_row = $this->db->affected_rows();
		
		$this->db->close();
		
		return $affected_row;	
	}
	
	
}