<?php

class News_model extends CI_Model
{  
 
   function __construct()
     {
	   parent :: __construct();
       $this->load->database();
	 }		
	 
	 function news_select()
	 {  
	    $this->db->limit(8);
		$this->db->order_by('ID','desc');
        $query = $this->db->get('news');
        return $query->result();
	 }
}

?>

