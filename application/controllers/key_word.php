<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-Type:text/html;charset=utf-8");
class Key_word extends CI_Controller
{
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function add_keyword()  //添加个人关键词
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
			  
			$action =  $this->input->get('action');	// add 添加 
			$keyword =$this->input->post('keyword'); 
			
			$this->load->model("Keyword_model");
			if( !strcmp($action,'add') )
			{
				
			$success = $this->Keyword_model->keyword_add($login_user,$keyword);
			
			if( $success === 0 )
			{
				$result['result'] = false;
				$result['errorcode'] = 19;
				$result['message'] = "添加个人关键词失败";
				break;
			}
			
			$result['result'] = true;
		    }	
		}while(0);
		
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
		
	}


	function delete_keyword()  //删除个人关键词
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
			  
			$action =  $this->input->get('action');	     //delete 删除
			$keyword =$this->input->get('keyword'); 
			
			$this->load->model("Keyword_model");
			if( !strcmp($action,'delete') )
			{
				
			$success = $this->Keyword_model->keyword_delete($login_user,$keyword);
			
			if( $success === 0 )
			{
				$result['result'] = false;
				$result['errorcode'] = 20;
				$result['message'] = "删除个人关键词失败";
				break;
			}
			
			$result['result'] = true;
		    }	
		}while(0);
		
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);	
	}
	
	
	function get_keyword_by_recommend()    //系统推荐关键词（随机推荐)
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
			
			$this->load->model("Keyword_model");
				
			$success = $this->Keyword_model->recommend_keyword();
			
			$result['result'] = true;
		    $result['data'] = $success;
		}while(0);
		
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);	
	}

}