<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-Type:text/html;charset=utf-8");
class Upload extends CI_Controller
{
	function index()
	{   $this->load->library('session');
		$S_ID = $this->session->userdata('S_ID');
		$this->load->model("user");
		$user = $this->user->user_select($S_ID);
		$username = $user[0]->username;
		$password = md5($user[0]->password);
		$sex = $user[0]->sex;
		$sex_2 = $user[0]->sex_2;
		$birthday = $user[0]->birthday;
		$constellation = $user[0]->constellation;
		$college = $user[0]->college;
		$major = $user[0]->major;
		$grade = $user[0]->grade;
		$position = $user[0]->position;
		$e_mail = $user[0]->e_mail;
		$tel = $user[0]->tel;
		$question = $user[0]->question;
		$answer = $user[0]->answer;
		$data=array('username'=>$username,'password'=>$password,'sex'=>$sex,'sex_2'=>$sex_2,'birthday'=>$birthday,'constellation'=>$constellation,'college'=>$college,'major'=>$major,'grade'=>$grade,'position'=>$position,'e_mail'=>$e_mail,'tel'=>$tel,'question'=>$question,'answer'=>$answer);
		$this->load->view('up',$data);
	}


     function up_inf()
	 {
		 $this->load->model("user");
		 $this->load->library('session');
		 $S_ID = $this->session->userdata('S_ID');
		 $username = $_POST['username'];
		 $password = md5($_POST['password']);
		 $sex = $_POST['sex'];
		 $sex_2 = $_POST['sex_2'];
		 $birthday = $_POST['birthday'];
		 $constellation = $_POST['constellation'];
		 $college = $_POST['college'];
		 $major = $_POST['major'];
		 $grade = $_POST['grade'];
		 $position = $_POST['position'];
		 $e_mail = $_POST['e_mail'];
		 $tel = $_POST['tel'];
		 $question = $_POST['question'];
		 $answer = $_POST['answer'];
		 $arr = array('username'=>$username,'password'=>$password,'sex'=>$sex,'sex_2'=>$sex_2,'birthday'=>$birthday,'constellation'=>$constellation,'college'=>$college,'major'=>$major,'grade'=>$grade,'position'=>$position,'e_mail'=>$e_mail,'tel'=>$tel,'question'=>$question,'answer'=>$answer);
		 $this->user->user_update($S_ID,$arr);
		 }
		 
		function search()
	{
		 $this->load->model("user");
		 $user = $this->user->select($_POST['S_ID']);
		 $num = count($user);
		 if($num)
		{foreach ($user as $row)
          { 
	         $json_str=json_encode($row);
		     echo $json_str;
		     echo '<br>';	   
          }
        }
		
    }
}
