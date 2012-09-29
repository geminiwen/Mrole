<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Keyword_model extends CI_Model
{
	function __construct()
	{
		parent :: __construct();
	}
	
	
	function keyword_add($user,$keyword)     //添加个人关键词
	{   
	    $_id = $user->stu_username;
		$this->load->database();
		$this->db->insert('keyword_info', array('keyword' => $keyword, 'keyword_user' => $_id)); 
	
		$affcted_row_num = $this->db->affected_rows();     
		$this->db->close();
		
		return $affcted_row_num;
	}
	
	
	function keyword_delete($user,$keyword)     //删除个人关键词
	{   
	    $_id = $user->stu_username;
		$this->load->database();
		$this->db->delete('keyword_info', array('keyword' => $keyword, 'keyword_user' => $_id)); 
	
		$affcted_row_num = $this->db->affected_rows();     
		$this->db->close();
		
		return $affcted_row_num;
	}


	function recommend_keyword()     //系统推荐关键词（随机推荐)
	{
		$this->load->database();
		$this->db->order_by("keyword", "random");
		$this->db->limit(10);
		$query = $this->db->get('keyword_info');
		
		$result_array = $query->result();
		
		$query->free_result();
		$this->db->close();
		
		return $result_array;
	}
}