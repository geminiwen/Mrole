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
			
			$datefile = $username;     //在注册的同时建立自己专属的文件夹及头像文件夹，文件名设置为用户学号
			
			if(!file_exists('./album./'.$datefile))
			{
			    mkdir('./album./'.$datefile,0777);           //文件的权限(可读，可写，可执行)并且新建文件夹
			    @chmod ($datefile, 0777);             //进行一次文件夹mode的转换
			}
			
				if(!file_exists('./album./'.$datefile.'./HeadPortrait./'))           //上传到个人头像文件夹下
			{
			    mkdir('./album./'.$datefile.'./HeadPortrait./',0777);           //文件的权限(可读，可写，可执行)并且新建文件夹
			    @chmod ($datefile, 0777);             //进行一次文件夹mode的转换
			}
			$album_name = 'HeadPortrait';
			$this->load->model("Photo_model");
			$query_result = $this->Photo_model->add_album_headportrait_info($username,$album_name);   //将新建相册信息写入数据库
			$result['result'] = true;
		}while(0);
		
		// 应该做个注册完自动登录，不做自动登录若再按提交则会再加自己一次好友
		
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
			
			$this->session->set_userdata('loginuser',$query_result[0]);  //记录session
			$result['result'] = true;
			
			
			
		}while(0);
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
	}
	
	
	
	
	function request_update_register()	// 请求修改注册信息
	{
		$login_user = $this->session->usedata('loginuser');
	
     	$realname	    = $this->input->post('realname');
		$job		    = $this->input->post('job');
		$birthday		= $this->input->post('birthday');
		$email			= $this->input->post('email');
		$sex	   	    = $this->input->post('sex');
		$sex_2	   	    = $this->input->post('sex_2');
		$constellation	= $this->input->post('constellation');
		$school			= $this->input->post('school');
		$college		= $this->input->post('college');
		$class			= $this->input->post('class');
		$tel			= $this->input->post('tel');
		$question		= $this->input->post('question');
		$answer			= $this->input->post('answer');
		
		$result			= array();
		
		do{
			if( null == $login_user )
			{
				$result['result'] = false;
				$result['errorcode'] = 5;
				$result['message'] = "用户未登录";
				break;
			}
			
			$this->load->model("User_model");
			$data = array(
						'stu_realname'		=> $realname,
						'stu_job'			=> $job,
						'stu_birthday'		=> $birthday,
						'stu_email'			=> $email,
						'stu_sex'			=> $sex,
						'stu_sex_2'  		=> $sex_2,
						'stu_constellation'	=> $constellation,
						'stu_school'		=> $school,
						'stu_college'		=> $college,
						'stu_class'			=> $class,
						'stu_tel'			=> $tel,
						'stu_question'		=> $question,
						'stu_answer'		=> $answer
						);
			$success = $this->User_model->update_newuser($login_user,$data);
			
			if( $success == 0 )
			{
				$result['result']		= false;
				$result['message']		= '服务器内部错误，个人信息更新失败';
				$result['errorcode']	= -1;
				break;
			}
			$result['result'] = true;
		}while(0);
		
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
	}
	
	
	function request_friend() //好友操作请求
	{
		$loginsuer = $this->session->userdata('loginuser');
		$result = array();
		do
		{
			if( null == $loginuser )
			{
				$result['result'] = false;
				$result['errorcode'] = 5;
				$result['message'] = '用户未登录';
				break;
			}
			
			$s_id = $loginuser->stu_username;
			$action =  $this->input->get('action');	// add 添加 delete 删除 （请求验证暂时放着）
			$f_id = $this->input->get('f_id',$f_id);  //http method   注册时已把自己加为好友
			
			$this->load->model('User_model');
			if( !strcmp($action,'add') )
			{
			
				$success = $this->User_model->add_friend($s_id,$f_id);
				
				if( $success == 0 )
				{
					$result['result'] = false;
					$result['errorcode'] = 6;
					$result['message'] = '添加好友失败';
					break;
				}
				
				$result['result'] = true;
			}
			else if( !strcmp($action,'delete') )
			{
				$success = $this->User_model->delete_friend($s_id,$f_id);
				
				if( $success == 0 )
				{
					$result['result'] = false;
					$result['errorcode'] = 7;
					$result['message'] = '删除好友失败';
					break;
				}
				
				$result['result'] = true;
			}
			
		}while(0);
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
	}
	
	
	
	function personal_pic_update()     //用户上传头像
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
			
			    $datefile = $login_user->stu_username;     
		     	$album_name = 'HeadPortrait';
				
			    $config['upload_path'] = './album./'.$datefile.'./HeadPortrait./';  //上传至个人头像文件夹
		        $config['allowed_types'] = "gif|jpg|png";
			    $config['max_size'] = '100';
                $config['max_width']  = '1024';
                $config['max_height']  = '768';
				$config['overwrite'] = 'false';
				$config ['file_name'] = $this->input->post('pic_name');   //图片自命名
				$photo_name = $config ['file_name'];
				$this->load->library("upload",$config);
			
		        $success = $this->upload->do_upload('upfile');
				if( $success === 0 )
			{
				$result['result'] = false;
				$result['errorcode'] = 8;
				$result['message'] = "头像上传失败";
				break;
			}
			    $this->load->model("Photo_model");
				$query_result = $this->Photo_model->update_album_info($login_user,$album_name);   //更新头像相册
				$query_result = $this->Photo_model->add_photo_info($login_user,$photo_name,$album_name);   //将新上传照片信息写入数据
		        $result['result'] = true;
				
		}while(0);
		
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
		
	}
	
	
	
	function request_change_password()  //用户请求修改密码
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
			  
			$password =$this->input->post('password'); 
			$password = md5(md5($password)); // 两次MD5加密
			
			$this->load->model("User_model");
			
			$success = $this->User_model->password_change($login_user,$password);
			
			
			if( $success === 0 )
			{
				$result['result'] = false;
				$result['errorcode'] = 18;
				$result['message'] = "修改密码失败";
				break;
			}
			
			$result['result'] = true;
			
		}while(0);
		
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
		
	}


}