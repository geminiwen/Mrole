<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function check_stunum()
	{
		$stu_num = $this->input->post('username');
		$this->load->model("User_model");
		
		$query_result = $this->User_model->check_stu_number($stu_num);
		
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
	
	function request_register()
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
		
		
		header("Content-Type: application/json; charset=utf-8");
		$inner_captcha	= $this->session->userdata('captcha');
		
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
			$success = $this->User_model->register($username,$realname,$data);
			if( $success > 0 )
			{
				$result['result'] = true;
			}
			else
			{
				$result['result']		= false;
				$result['message']		= '用户名已经存在';
				$result['errorcode']	= 2;
			}
		}while(0);
		
		
		echo json_encode($result);
	}
	
	function request_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$password = md5(md5($password));
		
	}	
}