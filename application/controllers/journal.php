<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-Type:text/html;charset=utf-8");
class Journal extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	
	function journal_update()              //发布一篇日志
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
			
			$journal_title = $this->input->post('journal_title');       //http method			
			$journal_content = $this->input->post('journal_content');       //http method
			
			$this->load->model("Journal_model");
			
			$success = $this->Journal_model->update_text($login_user,$journal_title,$journal_content);
			
			
			if( $success === 0 )
			{
				$result['result'] = false;
				$result['errorcode'] = -1;
				$result['message'] = "服务器内部错误，发布日志失败";
				break;
			}
			
			$result['result'] = true;
			
		}while(0);
		
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
		
	}
	
	
	
	function journal_delete()              //(只有在自己的日志全部显示的页面才有删除操作)删除一篇日志并同时删除该日志下的所有评论
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
			
			$journal_id = $this->input->get('journal_id',$journal_id);  //http method  
			
			$this->load->model('Journal_model');
			$this->load->model('Journal_comment_model');
			
			if( !strcmp($action,'delete') )
			{
				$success = $this->Journal_model->delete_journal($journal_id);
				$success_comment = $this->Journal_comment_model->delete_comment_journal($journal_id);   //可能该日志下无评论
				
				if( $success == 0)
				{
					$result['result'] = false;
					$result['errorcode'] = 15;
					$result['message'] = '删除日志失败';
					break;
				}
				
				$result['result'] = true;
			}
			
		}while(0);
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
	}
	


	function journal_all_public_time_line()     //获取所有注册用户个人日志信息
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
			
			$this->load->model('Journal_model');
			
			$data = $this->Journal_model->get_journal_all_line();
			
			$result['result'] = true;
			$result['data'] = $data;
			
			
		}while(0);
		
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
	}
		
		
		
	function journal_self_public_time_line()      //获取个人全部日志信息
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
			
			$this->load->model('Journal_model');
			
			$data = $this->Journal_model->get_time_line_by_id($login_user);
			
			$result['result'] = true;
			$result['data'] = $data;
			
			
		}while(0);
		
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
	}
			
	
		
				
	function journal_public_time_line()    // 获取登录用户关注的公共日志信息
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
			
			$this->load->model('Journal_model');
			
			$data = $this->Journal_model->get_journal_time_line($login_user);  
			

			$result['result'] = true;
			$result['data'] = $data;
			
			
		}while(0);
		
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
	}
		
		
		
		
		
		function journal_friend_time_line()    // 获取好友日志信息
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
			
			$this->load->model('Journal_model');
			
			$data = $this->Journal_model->get_journal_friend_line($login_user);
			
			$result['result'] = true;
			$result['data'] = $data;
			
			
		}while(0);
		
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
	}
	
	
	function journal_keyword_search()              //搜索关键字日志
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
			
			$this->load->model('Journal_model');
			
			if( !strcmp($action,'search') )
			{
				$success = $this->Journal_model->search_keyword_journal($word);
				
				if( $success == 0 )
				{
					$result['result'] = false;
					$result['errorcode'] = 16;
					$result['message'] = '查无此关键字日志';
					break;
				}
				
				$result['result'] = true;
				$result['data'] = $success;
			}
			
		}while(0);
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
	}
		
		
	function check_comment_num()    //统计某篇日志下的评论总数
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
			
			$id = $this->input->get('id',$journal_id);  //http method  获取日志编号
			
			$this->load->model('Journal_model');
			
			$query_result = $this->Journal_model->check_comment_num_by_id($id);
		
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

	  