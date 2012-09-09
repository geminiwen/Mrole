<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-Type:text/html;charset=utf-8");
class State_control extends CI_Controller
{
	
	       function __construct()
        {
           parent::__construct();
		   $this->load->model("user");
		   $this->load->model('state_model');
		   $this->load->library('session');
        }


           function state_view()     /*个人状态发布*/
	 
	    {   
		$this->load->view('state_view');
	    }

	
	      function state_insert()     /*个人状态信息写入数据库*/
	    {   
	    $S_ID = $this->session->userdata('S_ID');
		$state = $this->state_model->state_select($S_ID);
		$username = $state[0]->username;
	    $content = $_POST['content'];
		$now = date('Y-m-d H:i:s',time());
		$arr = array('content'=>$content,'author'=>$username,'time'=>$now,'S_ID'=>$S_ID); 
		$this->state_model->state_insert($arr);   /*状态写入数据库*/
	    }
		
		
		 function state_self_show()    /*查找自己所发布过的状态信息并按时间显示*/
	    {   
	    $S_ID = $this->session->userdata('S_ID');
		$state_show = $this->state_model->state_self_show($S_ID);   
		$json_str=json_encode($state_show);
	    echo $json_str;	
	    }
		
				
		function state_friends_show()    /*查找好友所发布过的状态信息并按时间显示*/
	    {   
	    $S_ID = $this->session->userdata('S_ID');
		$state_f = $this->state_model->state_others_show($S_ID);   /*friends表中查找好友*/
		foreach($state_f as $arr){
				$f_ID=($arr->f_S_ID);   
		$state_f= $this->state_model->state_f_show($f_ID);  
		$json_str=json_encode($state_f);
	    echo $json_str;	     
		echo "<br />";
		                         }
		
	    }
		
}

	  