<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
    public function index(){
    	$this->load->model('facebookApiModel');
        
        //pass data to variable
        $data['friends'] = $this->facebookApiModel->getFriends();
        $data['fbID'] = $this->facebookApiModel->getUserID();

		$this->load->view('home_view', $data);
    }
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */