<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo_upload extends CI_Controller
{
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function personal_photo_upload()     //用户上传照片至相册
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
			
				$datefile = $login_user->stu_username;     //上传到用户专属的个人文件夹中（注册成功时已同时建立）
				
				$action =  $this->input->get('action');	   // build 新建相册 click 点击某个相册
			
		        $config['allowed_types'] = "gif|jpg|png";
			    $config['max_size'] = '5000000';
                $config['max_width']  = '1024';
                $config['max_height']  = '768';
				$config['overwrite'] = 'false';
				$config ['file_name'] = $this->input->post('pic_name');   //图片自命名
				$photo_name = $config ['file_name'];
				if( !strcmp($action,'build') )
			{	
					$album_name = $this->input->post('album_name');    //建立新相册，给其命名
				
					if(!file_exists('./album./'.$datefile.'./'.$album_name))
				{
					mkdir('./album./'.$datefile.'./'.$album_name,0777);       
					@chmod ($album_name, 0777);             
				}
			
				$config['upload_path'] = './album./'.$datefile.'./'.$album_name;
				$this->load->library("upload",$config);
				
		        $success = $this->upload->do_upload('upfile');
				
				if( $success === 0 )
				{
				$result['result'] = false;
				$result['errorcode'] = 13;
				$result['message'] = "图片上传失败";
				break;
				}
				
				$this->load->model("Photo_model");
				$query_result = $this->Photo_model->add_album_info($login_user,$album_name);   //将新建相册信息写入数据库
				$query_result = $this->Photo_model->add_photo_info($login_user,$photo_name,$album_name);   //将新上传照片信息写入数据
				
		        $result['result'] = true;
			} 
			
			else if( !strcmp($action,'click') )
			
			{	
				$album_name = $this->input->get('album_name');    //接收相册名
				
								
				$config['upload_path'] = './album./'.$datefile.'./'.$album_name;  //路径为已有相册下
				$this->load->library("upload",$config);
			
		        $success = $this->upload->do_upload('upfile');
				
				if( $success === 0 )
				{
				$result['result'] = false;
				$result['errorcode'] = 13;
				$result['message'] = "图片上传失败";
				break;
				}
				$this->load->model("Photo_model");
				
				$query_result = $this->Photo_model->update_album_info($login_user,$album_name);   //更新相册时间
				$query_result = $this->Photo_model->add_photo_info($login_user,$photo_name,$album_name);   //将新上传照片信息写入数据
				
		        $result['result'] = true;
			}	
		}while(0);
		
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);
		
	}
	
	function look_over_photo()          //查看自己相册内图片（查看他人相册传他人ID就可）
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
			
			$album_name = $this->input->get('album_name');      //http method获取相册名
			
			$this->load->model("Photo_model");
			
			$success = $this->Photo_model->get_photo_from_album($login_user,$album_name);
			
			if( $success === 0 )
				{
				$result['result'] = false;
				$result['errorcode'] = 14;
				$result['message'] = "图片查看失败";
				break;
				}
				
			$result['result'] = true;
			$result['data'] = $success;
		}while(0);
		
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result);					
	}
	
}