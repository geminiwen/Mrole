<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-Type:text/html;charset=utf-8");
class Pic_control extends CI_Controller
{
	
	       function __construct()
        {
           parent::__construct();
		   $this->load->model("user_model");
		   $this->load->model("pic_model");
	       $this->load->library('session');
        }

            function pic_up()
		{    
		    $S_ID = $this->session->userdata('S_ID');
			$user = $this->user_model->user_select($S_ID);
            $img = $user[0]->img;
			$arr = array('img'=>$img);
		    $this->load->view("pic_view",$arr);		/*头像显示并更新头像*/
		}
		
        	function up()
	    {   
		   $S_ID = $this->session->userdata('S_ID');
		   $config['upload_path']="./upload";
		   $config['allowed_types']="gif|jpg|png";
		   $config['max_size']="20000";
		   $config['overwrite']="true";
		   $config ['file_name'] = $S_ID;   /*把文件命名为唯一的学号，则每个ID只能有一张图片作为头像且随时覆盖*/
		   $this->load->library("upload",$config);
		   if($this->upload->do_upload('upfile'))
		   {
			$data=array('upload_data'=>$this->upload->data());
			$img=$data['upload_data']['file_name']; 
			$arr = array('img'=>$img);
		    $this->pic_model->pic_update($S_ID,$arr);
			$json_str=json_encode($data);
			var_dump($json_str);
			
		   }
		else
		   {
			$error=array('error'=>$this->upload->display_errors());
			var_dump($error);
	       }
	  }
}
	  