<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class FacebookApiModel extends CI_Model{


    public function __construct(){
        parent::__construct();

        $CI = & get_instance();
        $CI->config->load("facebook",TRUE);
        $config = $CI->config->item('facebook');
        $this->load->library('facebook', $config);
    }

	public function getUsername(){
		Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYPEER] = false;
		$user_id = $this->facebook->getUser();
		if($user_id) {
			try {
        		$user_profile = $this->facebook->api('/'.$user_id);
        		return $user_profile['name'];

	      	} catch(FacebookApiException $e) {
				return $e->getMessage();
	      	}   
    	} else {
			return "No name returned";
		}
	}

	public function getEmail(){
		Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYPEER] = false;
		$user_id = $this->facebook->getUser();
		if($user_id) {
			try {
        		$user_profile = $this->facebook->api('/'.$user_id);
        		return $user_profile['email'];

	      	} catch(FacebookApiException $e) {
				return $e->getMessage();
	      	}   
    	} else {
			return "No name returned";
		}
	}

	public function getUserID(){
		return $this->facebook->getUser();
	}

	public function getFriends(){
		Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYPEER] = false;
		$user_id = $this->facebook->getUser();
		if($user_id) {
			try {
        		$friends = $this->facebook->api('/'.$user_id.'/friendlists');
        		return $friends;
	      	} catch(FacebookApiException $e) {
				return $e->getMessage();
	      	}   
    	} else {
			return "No friends retured";
		}
	}

	public function postSomething($action , $friend){
		$user = $this->facebook->getUser();

        if($user) {
        	try{
        		$ret_obj = $this->facebook->api( $user.'/feed', 'POST',
	                array('message' => 'YaH mad! take a, '. $action .' @cordell lawrence'.' from '. 'denzil doyle' ));
       				echo '<pre>Post ID: ' . $ret_obj['id'] . '</pre>';
        	}

   			catch(FacebookApiException $e) {
    			$login_url = $this->facebook->getLoginUrl( array(
                   'scope' => 'publish_stream'
                )); 
		        echo 'Please <a href="' . $login_url . '">login.</a>';
		        error_log($e->getType());
		        error_log($e->getMessage());
  			} 
  		}  
	}
}	