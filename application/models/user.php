<?php

class User extends CI_Model
{ 
     function __construct()
    {
	 parent :: __construct();
     $this->load->database();
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
	{   $this->db->like('S_ID',$key); 
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

