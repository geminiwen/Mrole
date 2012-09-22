<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Photo_model extends CI_Model
{
	function __construct()
	{
		parent :: __construct();
	}
	
	
	function add_album_info($user,$album_name)          //将新建相册信息写入数据库
	{
		$_id = $user->stu_username;
		$this->load->database();
		
		date_default_timezone_set("Asia/Shanghai");  	
		$time = date("Y-m-d H:i:s", time()) ;   
		     
		$this->db->insert('album_info', array('album_name'  => $album_name,
											  'album_user'  => $_id,
											  'build_time'  => $time,
											  'update_time' => $time
											  ));
		$affcted_row_num = $this->db->affected_rows();     
		$this->db->close();
		
		return $affcted_row_num;
	}
	
	
	function add_photo_info($user,$photo_name,$album_name)      //将新上传照片信息写入数据
	{
		$_id = $user->stu_username;
		$this->load->database();
		
		date_default_timezone_set("Asia/Shanghai");  	
		$time = date("Y-m-d H:i:s", time()) ;   
		     
		$this->db->insert('photo_info', array('photo_name' 	      => $photo_name,
											  'photo_album_name'  => $album_name,
											  'photo_user'		  => $_id,
											  'upload_time' 	  => $time
											  ));
		$affcted_row_num = $this->db->affected_rows();     
		$this->db->close();
		
		return $affcted_row_num;
	}
	
	
	function update_album_info($user,$album_name)     //更新相册时间
	{
		$_id = $user->stu_username;
		$this->load->database();
		
		$this->db->where('album_user',$_id);
		$this->db->where('album_name',$album_name);
		
		date_default_timezone_set("Asia/Shanghai");  	
		$time = date("Y-m-d H:i:s", time()) ; 
		$data = array(
						'update_time' => $time
						);
		
		$this->db->update('album_info',$data);
		
		$affcted_row_num = $this->db->affected_rows();     
		$this->db->close();
		
		return $affcted_row_num;
	}

	function get_photo_from_album($user,$album_name)    //查看自己相册内图片
	{
	    $_id = $user->stu_username;
	    $this->load->database();
	  
		$this->db->where('photo_user',$_id);
		$this->db->where('photo_album_name',$album_name);
	  
		$query = $this->db->get('photo_info');
		$result	= $query->result();
		$query->free_result();
		$this->db->close();
		return $result;
	}
	
}
