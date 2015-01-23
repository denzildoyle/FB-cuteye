<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
    public function index(){
    	$this->load->model('facebookApiModel');
        $params = array(
            'scope' => 'email,publish_stream',
            'redirect_uri' => 'http://localhost/cuteye/welcome'
        );
        
        echo "<script type='text/javascript'>top.location.href = '".$this->facebook->getLoginUrl($params)."';</script>";

        	$data['friends'] = $this->facebookApiModel->getFriends();

		$this->load->view('home_view', $data);
    }

    public function post(){
        $this->load->model('facebookApiModel');
        $this->facebookApiModel->postSomething($_POST['friend'],$_POST['action']);
    }
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */