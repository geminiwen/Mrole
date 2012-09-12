<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Status_model extends CI_Model
{
	function __construct()
	{
		parent :: __construct();
	}
	
	function update_text($user,$status)		// ����һ��״̬
	{
		$_id = $user->stu_username;
		
		$this->load->database();
		
		$this->db->insert('status', array( 'status_user' => $_id , 'status_content' => $status ) );
		
		$affected_row = $this->db->affected_rows();
		
		$this->db->close();
		
		return $affected_row;
	}
	
	function get_status_time_line($user)	// ��ȡ��¼�û���ע�Ĺ���״̬��Ϣ
	{
		$_id = $user->stu_username;
		
		$this->load->database();
		
		$this->db->select('stu_info.*,status.*');
		$this->db->from('stu_info,status,friend');
		$this->db->where('friend.user_id',$_id);
		$this->db->where('stu_info.stu_username = friend.user_id');
		$this->db->where('status.status_user = friend.user_id');
		
		$query = $this->db->get();
		
		$result_array = $query->result();
		
		$query->free_result();
		$this->db->close();
		
		return $result_array;	
	}
	
	function get_time_line_by_id($id)		// ����һ��id��ȡ״̬��Ϣ
	{
		$this->db->select('stu_info.*,status.*');
		$this->db->from('stu_info,status');
		$this->db->where('status.status_user',$id);
		$this->db->where('status.status_user = stu_info.stu_username');
		
		$query = $ this->db->get();
		
		$result_array = $query->result();
		
		$query->free_result();
		$this->db->close();
		
		return $result_array;
	}
}