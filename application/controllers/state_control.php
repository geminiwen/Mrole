<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class State_control extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function state_view()     /*个人状态发布*/
	{
		$this->load->view('state_view');
	}
	
	function status_update()
	{
		$login_user = $this->session->usedata('loginuser');
		
		$result = array();
		do
		{
			if( null == $login_user )
			{
				$result['result'] = false;
				$result['errorcode'] = 5;
				$result['message'] = "用户未登录";
				break;
			}
			
			$status = $this->input->post('status');
			
			$this->load->model("Status_model");
			
			$success = $this->Status_model->update_text($login_user,$status);
			
			
			if( $success === 0 )
			{
				$result['result'] = false;
				$result['errorcode'] = -1;
				$result['message'] = "服务器内部错误，发布状态失败";
				break;
			}
			
			$result['result'] = true;
			
		}while(0);
		
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
		
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
		
				
	function state_public_time_line()    /*查找好友所发布过的状态信息并按时间显示*/
	{   
	    $loginuser = $this->session->userdata('loginuser');
		
		$result = array();
		do
		{
			if( null == $login_user )
			{
				$result['result'] = false;
				$result['errorcode'] = 5;
				$result['message'] = "用户未登录";
				break;
			}
			
			$this->load->model('Status_model');
			
			$data = $this->Status_model->get_status_time_line($login_user);
			
			$result['result'] = true;
			$result['data'] = $data;
			
			
		}while(0);
		
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
	}
		
}

	  