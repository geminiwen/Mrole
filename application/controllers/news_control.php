<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-Type:text/html;charset=utf-8");
class News_control extends CI_Controller {	
 public function __construct()
  {
    parent::__construct();
    $this->load->model('news_model');
	$this->load->helper('text');
  }

	function news_order()
	{   
        $news = $this->news_model->news_select();
	    foreach($news as $arr){
				$title=($arr->title); 
			echo $title;
		$json_str=json_encode($title);
	    echo $json_str;	     
		echo "<br />";          
		                      }
	}
}
