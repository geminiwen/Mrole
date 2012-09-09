<?php

class State_model extends CI_Model
{  
 
        function __construct()
     {
	   parent :: __construct();
       $this->load->database();
	 }		
	 
	    function state_insert($arr)
	 {
		$this->db->insert('state',$arr);
	 }
	 
	 
        function state_select($S_ID)
	 {
		$this->db->where('S_ID',$S_ID);
		$this->db->select('*');
		$query=$this->db->get('user');
		return $query->result();
	 }
	
	
	     function state_self_show($S_ID)
	 { 
	    $this->db->where('S_ID',$S_ID);
		$this->db->select('*');
		$this->db->order_by('time','desc');
        $query = $this->db->get('state');
        return $query->result();
	 }
	 
	  function state_others_show($S_ID)
	 { 
	    $this->db->where('s_S_ID',$S_ID);
		$this->db->select('*');
        $query = $this->db->get('friends');
        return $query->result();
	 }
	 
	  function state_f_show($f_ID)
	 { 
	    $this->db->where('S_ID',$f_ID);
		$this->db->select('*');
		$this->db->order_by('time','desc');
        $query = $this->db->get('state');
        return $query->result();
	 }
	 
}