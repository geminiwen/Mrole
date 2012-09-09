<?php

class Pic_model extends CI_Model
{      
        function __construct()
    {
	 parent :: __construct();
     $this->load->database();
	}	
	
		
	    function pic_update($S_ID,$arr)
	{
		$this->db->where('S_ID',$S_ID);
		$this->db->update('user',$arr);
	}
	
}