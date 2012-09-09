<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
                              } 
class Avatar extends CI_Controller 
{  
	function __construct() {
		parent::__construct (); 
		$this->load->library ( 'avatarlib' ); 
	
	                       }
	public function index() { 
		$data ['uid'] =1;
		$data ['avatarhtml'] = $this->avatarlib->avatar_show($data ['uid'] ,'big'); 
		$this->load->view ( 'avatar', $data );
	                        } 
	function index_2() { 
	 	$data ['uid'] =1;
		$data ['avatarflash'] = $this->avatarlib->uc_avatar ( $data ['uid'] ); 
		$this->load->view ( 'avatar_2', $data );
	                    } 
	function doavatar(){ 
		$action='on'.$_GET['a']; 
		$data = $this->avatarlib->$action(); 
		echo $data;
	                   }
}
 