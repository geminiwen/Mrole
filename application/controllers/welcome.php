<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-Type:text/html;charset=utf-8");
class Welcome extends CI_Controller {
	
	function __construct()
	{
        parent::__construct();
	}

	function login()
	{
		$this->load->view('login');
	}
	function checklogin()
	{

		$user = $this->user->user_select($_POST['S_ID']);
		$num = count($user);
		if($num)
		{
			if($user[0]->password==md5($_POST['password']))
			{
				echo '登陆成功';
				echo '<br />';
				$this->load->library('session');
				$arr = array('S_ID'=>$user[0]->S_ID);
				$this->session->set_userdata($arr);
				echo $this->session->userdata('S_ID');
				echo '<br />';
	            foreach($user as $arr_2){
				$username=($arr_2->S_ID);
				$user['data']='ajax'.$username;
				echo $user['data'];}
				echo '<br />';
				$json_str=json_encode($user);
			    echo $json_str;	
			}
			else
			{
				echo "<script>alert('密码错误！');history.back();</script>";
			}
		}
		else
		{
			echo "<script>alert('用户名不存在！');history.back();</script>";		}
	}
	
	function checksession()
	{
		$this->load->library('session');
		if( $this->session->userdata('S_ID'))
		{
			echo '已经登录';
		}
		else
		{
			echo '没有登录';
		}
	}

	function loginout()
	{
		$this->load->library('session');
		$this->session->unset_userdata('S_ID');
	}

	
	     function register()
	{
		$this->load->view('register');
	}

         function checkregister()
	{

		$user = $this->user->user_select($_POST['S_ID']);
		$num = count($user);
		if($num)
		{
			if($user[0]->username==$_POST['username'])
			{
				if($user[0]->e_mail!=''){
				$user['result']=false;
				echo "<script>alert('该账户已被注册！');history.back();</script>";
			}else{
				   $S_ID=($user[0]->S_ID);
				   $data=array('S_ID'=>$S_ID);
				   $this->load->view('checkregister',$data); 
				   
				    }
			
			}else {
				echo "<script>alert('姓名与学号不匹配！');history.back();</script>";
				}
		}else {
			echo "<script>alert('该学号不存在！');history.back();</script>";}
	}
	
	
	function register_update()
	{   
	
		$e_mail = $this->user->e_mail_select($_POST['e_mail']);
		$num = count($e_mail);
		if($num == ''){
		$S_ID = $_GET['S_ID'];
		$password = md5($_POST['password']);
		$position = $_POST['position'];
		$birthday = $_POST['birthday'];
		$e_mail = $_POST['e_mail'];
		$tel= $_POST['tel'];
		$arr = array('password'=>$password,'position'=>$position,'birthday'=>$birthday,'e_mail'=>$e_mail,'tel'=>$tel);
		$this->user->user_update($S_ID,$arr);
		echo "注册成功";
		}else{
			echo "该邮箱已被注册";}
	}
	
	function index()
	{
		$this->load->view('index');
	}
	
}
?>