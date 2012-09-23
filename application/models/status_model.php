<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Status_model extends CI_Model
{
	function __construct()
	{
		parent :: __construct();
	}
	
	function update_text($user,$status)		// 发布一个状态
	{
		$_id = $user->stu_username;
		
		date_default_timezone_set("Asia/Shanghai");  //php5.1以上时间戳会与实际时间相差8小时，加时间的初始化的语句	
		$time = date("Y-m-d H:i:s", time()) ;        
		
		$this->load->database();
		
		$this->db->insert('status', array( 'status_user' => $_id , 'status_content' => $status , 'status_time' => $time ) );
		
		$affected_row = $this->db->affected_rows();
		
		$this->db->close();
		
		return $affected_row;
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
		
		$this->db->select('stu_info.*,status.*');
		$this->db->from('stu_info,status,friend');      
		$this->db->where('friend.user_id',$_id); 
		$this->db->where('friend.type',1);           //type = 1为关注，type = 0为好友       
		$this->db->where('stu_info.stu_username = friend.user_id');
		$this->db->where('status.status_user = friend.user_id');
		
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
		
		$this->db->select('stu_info.*,status.*');
		$this->db->from('stu_info,status,friend');      
		$this->db->where('friend.user_id',$_id); 
		$this->db->where('friend.type',0);           //type = 1为关注，type = 0为好友       
		$this->db->where('stu_info.stu_username = friend.user_id');
		$this->db->where('status.status_user = friend.user_id');
		
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
	
		$this->db->select('stu_info.*,status.*');
		$this->db->from('stu_info,status');
		$this->db->where('status.status_user',$id);
		$this->db->where('status.status_user = stu_info.stu_username');
		
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