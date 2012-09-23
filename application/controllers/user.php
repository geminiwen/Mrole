<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function check_stunum()	// 检查用户名
	{
		$stu_num = $this->input->post('username');
		$this->load->model("User_model");
		
		$query_result = $this->User_model->query_by_username($stu_num);
		
		$result_count = count( $query_result );
		$result = array();
		
		header("Content-Type: application/json; charset=utf-8");
		
		if( $result_count > 0 )
		{	
			$result['result']	= true;
			$result['real_name'] = $query_result[0]->stu_realname;
		}
		else
		{
			$result['result']	= false;
			
		}
		
		echo json_encode($result);
	}
	
	function request_register()	// 请求注册
	{
		$username	= $this->input->post('username');
		$realname	= $this->input->post('realname');
		$password	= $this->input->post('password');
		$job		= $this->input->post('job');
		$birthday	= $this->input->post('birthday');
		$email		= $this->input->post('email');
		$captcha	= $this->input->post('captcha');
		
		
		
		$captcha	= strtolower($captcha);
		$password	= md5(md5($password));
		
		$inner_captcha	= $this->session->userdata('captcha');	// 读取session中的验证码
		
		$result			= array();
		
		do{
			if( strcmp($captcha,$inner_captcha) != 0 )
			{
				$result['result']		= false;
				$result['message']		= '验证码错误';
				$result['test']			= $inner_captcha;
				$result['errorcode']	= 1;
				break;
			}
			$this->load->model("User_model");
			$data = array(
						'stu_password'	=> $password,
						'stu_job'		=> $job,
						'stu_birthday'	=> $birthday,
						'stu_email'		=> $email,
						'stu_checked'	=> 1
						);
			$success = $this->User_model->insert_newuser($username,$realname,$data);
			if( $success == 0 )
			{
				$result['result']		= false;
				$result['message']		= '用户名已经存在';
				$result['errorcode']	= 2;
				break;
			}
			$result['result'] = true;
		}while(0);
		
		// 应该做个注册完自动登录
		
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
	}
	
	function request_login()	// 请求登录
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$password = md5(md5($password)); // 两次MD5加密
		
		$this->load->model("User_model");
		
		$result = array();
		
		do
		{
			$query_result = $this->User_model->query_by_username($username);
		
			$result_count = count( $query_result );
			
			if( $result_count === 0 )
			{
				$result['result'] = false;
				$result['errorcode'] = 3;
				$result['message'] = '用户不存在';
				break;
			}
			
			$query_result = $this->User_model->query_by_username_password($username,$password);
			
			$result_count = count( $query_result );
			
			if( $result_count === 0 )
			{
				$result['result'] = false;
				$result['errorcode'] = 4;
				$result['message'] = '密码错误';
				break;
			}
			
			$this->session->set_userdata('loginuser',$query_result[0]);
			$result['result'] = true;		
			
		}while(0);
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
	}
	
	function request_add_friend()
	{
	}

}