<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Journal_comment extends CI_Controller
{
	function __construct()
	{
		parent :: __construct();
	}
	
	
	function journal_comment_update()              //针对日志发表新评论或对已有评论进行回复
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
			
			$action =  $this->input->get('action');	// comment评论 reply 回复
			
			$comment_journal_id = $this->input->get('comment_journal_id',$journal_id);    //建立日志表和日志评论表的连接
			
			$journal_comment = $this->input->post('comment_content');       //http method
			
			$this->load->model("Journal_comment_model");
			
			if( !strcmp($action,'comment') )
			{
			
			$success = $this->Journal_comment_model->comment_update($login_user,$comment_journal_id,$journal_comment);
			
				if( $success === 0 )
				{
				$result['result'] = false;
				$result['errorcode'] = 17;
				$result['message'] = "评论日志失败";
				break;
				}
			
				$result['result'] = true;
			}
			
			else if( !strcmp($action,'reply') )
			{
			
			$comment_reply_id = $this->input->get('comment_reply_id',$comment_id);    //得到对应日志的序号
			$success = $this->Journal_comment_model->comment_reply_update($login_user,$comment_journal_id,$journal_comment,$comment_reply_id);
			
				if( $success === 0 )
				{
				$result['result'] = false;
				$result['errorcode'] = 18;
				$result['message'] = "回复日志失败";
				break;
				}
			
				$result['result'] = true;
			}
			
		}while(0);
		
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
		
	}
	
	
	function comment_time_line()      //显示对应日志下的全部评论信息
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
			
			$comment_journal_id = $this->input->get('comment_journal_id',$journal_id);   //http method
			
			$this->load->model('Journal_comment_model');
			
			$data = $this->Journal_comment_model->get_comment_by_id($comment_journal_id);
			
			$result['result'] = true;
			$result['data'] = $data;
			
			
		}while(0);
		
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
	}	
	
}

	  