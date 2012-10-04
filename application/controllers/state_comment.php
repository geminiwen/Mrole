<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-Type:text/html;charset=utf-8");
class State_comment extends CI_Controller
{
	function __construct()
	{
		parent :: __construct();
		session_start();
	}
	
	
	function status_comment_update()              //针对状态发表新评论
	{
		$result = array();
		 
		do
		{
			if( !isset($_SESSION['loginuser']) )
			{
				$result['result'] = false;
				$result['errorcode'] = 5;
				$result['message'] = "用户未登录";
				break;
			}

			$login_user = $_SESSION['loginuser'];
			
			
			$comment_status_id = $this->get_default('status_id',0);   //http method   获取状态ID
			
			$comment_reply_id  = $this->get_default('comment_id', 0);
			
			$status_comment = $this->input->post('comment_content');       //http method  评论内容
			
			$this->load->model("Status_comment_model");
			
			$success = $this->Status_comment_model->comment_update($login_user,$comment_status_id,$status_comment,$comment_reply_id);
			$success = 1;
			if( $success === 0 )
			{
				$result['result'] = false;
				$result['errorcode'] = 11;
				$result['message'] = "评论状态失败";
				break;
			}
			
			$result['result'] = true;
					
		}while(0);
		
		$this->output
		->set_content_type('application/json; charset=utf-8')
		->set_output(json_encode($result));
	}

	
	
	function comment_time_line()      //显示对应状态下的全部评论信息
	{
		$login_user = $this->session->userdata('loginuser');
		
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
			
			$comment_status_id = $this->input->get('comment_status_id',$status_id);   //http method
			
			$this->load->model('Status_comment_model');
			
			$data = $this->Status_comment_model->get_comment_by_id($comment_status_id);
			
			$result['result'] = true;
			$result['data'] = $data;
			
			
		}while(0);
		
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
	}
	
	function get_default($attr,$def)
	{
		
		$result = $this->input->get($attr,TRUE);
		
		
		if( $result === false )
		{
			$result = $def;
		}
		return $result;
	}
	
}

	  