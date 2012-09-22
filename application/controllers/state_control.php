<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class State_control extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	
	function status_update()              //发布一个状态
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
			 
			$status = $this->input->post('status');       //http method
			
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
	
	
	
	function status_delete()              //(只有在自己的状态全部显示的页面才有删除操作)删除一个状态并同时删除该状态下的所有评论
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
			
			$action =  $this->input->get('action');	   //删除操作
			
			$id = $this->input->get('id',$status_id);  //http method  所选状态序号
			
			$this->load->model('Status_model');
			$this->load->model('Status_comment_model');
			
			if( !strcmp($action,'delete') )
			{
				$success = $this->Status_model->delete_status($id);
				$success_comment = $this->Status_comment_model->delete_comment_status($id);
				
				if( $success == 0 && $success_comment == 0)
				{
					$result['result'] = false;
					$result['errorcode'] = 9;
					$result['message'] = '删除状态失败';
					break;
				}
				
				$result['result'] = true;
			}
			
		}while(0);
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
	}
	


	function state_all_public_time_line()     //获取所有注册用户个人状态信息
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
			
			$this->load->model('Status_model');
			
			$data = $this->Status_model->get_status_all_line();
			
			$result['result'] = true;
			$result['data'] = $data;
			
			
		}while(0);
		
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
	}
		
		
		
	function state_self_public_time_line()      //获取个人全部状态信息
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
			
			$this->load->model('Status_model');
			
			$data = $this->Status_model->get_time_line_by_id($login_user);
			
			$result['result'] = true;
			$result['data'] = $data;
			
			
		}while(0);
		
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
	}
			
	
		
				
	function state_public_time_line()    // 获取登录用户关注的公共状态信息
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
			
			$this->load->model('Status_model');
			
			$data = $this->Status_model->get_status_time_line($login_user);  
			
			$result['result'] = true;
			$result['data'] = $data;
			
			
		}while(0);
		
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
	}
		
		
		
		function state_friend_time_line()    // 获取好友状态信息
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
			
			$this->load->model('Status_model');
			
			$data = $this->Status_model->get_status_friend_line($login_user);
			
			$result['result'] = true;
			$result['data'] = $data;
			
			
		}while(0);
		
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
	}
	
	
	function status_keyword_search()              //搜索关键字状态
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
			
			$action =  $this->input->get('action');	   //搜索操作
			
			$word = $this->input->get('word',$keyword);  //http method
			
			$this->load->model('Status_model');
			
			if( !strcmp($action,'search') )
			{
				$success = $this->Status_model->search_keyword_status($word);
				
				if( $success == 0 )
				{
					$result['result'] = false;
					$result['errorcode'] = 10;
					$result['message'] = '查无此关键字状态';
					break;
				}
				
				$result['result'] = true;
			}
			
		}while(0);
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
	}
		
		
	function check_comment_num()    //统计某条状态下的评论总数
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
			
			$id = $this->input->get('id',$status_id);  //http method  获取状态序号
			
			$this->load->model('Status_model');
			
			$query_result = $this->Status_model->check_comment_num_by_id($id);
		
		    $result_count = count( $query_result );
		
			header("Content-Type: application/json; charset=utf-8");
		
			if( $result_count > 0 )
			{	
			$result['result']	= true;
			$result['count']	= $result_count;
			}
		    else
		   {
			$result['result']	= false;
			$result['count']	= 0;
		   }
		}while(0);
		
		echo json_encode($result);
	}
	
}

	  