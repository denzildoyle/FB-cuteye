<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class ApplicationModel extends CI_Model{


    public function __construct(){
        parent::__construct();
    }

    function codeGenerated($userID){
    	$data = array( 'FacebookID' => $userID);

    	$this->db->where($data);
    	$query = $this->db->get('couponcode');

    	if($query->num_rows() > 0){
			return TRUE;
		} else{
			return FALSE;
		}
    }

    function addUserDetails($data){
        $this->db->insert('couponcode', $data);
    }

    function getCode($userID){
    	$data = array( 'FacebookID' => $userID);

    	$this->db->where($data);
		$query = $this->db->get('couponcode');

    	if($query->num_rows() == 1) {
			return $query->row(0)->Code;
		} else{
			return FALSE;
		}
    }

    function verify($code){
    	$data = array( 'Code' => $code);

    	$this->db->where($data);
    	$query = $this->db->get('couponcode');

    	if($query->num_rows() > 0) {
			return TRUE;
		} else{
			return FALSE;
		}	
    }

    function redeem($code, $recNum){
        $data = array( 'Code' => $code,
                       'RecNum' => $recNum
                    );
        $this->db->insert('redemption', $data);
    }

    function verifyPassInfo($data){

        $this->db->where($data);
        $query = $this->db->get('admin');

        if($query->num_rows() > 0) {
            return TRUE;
        } else{
            return FALSE;
        }
    }

    function getUsernameByCode($code){
        $this->db->where('code', $code);
        $query = $this->db->get('couponcode');

        if($query->num_rows() == 1) {
            return $query->row(0)->Name;
        } else{
            return 0;
        }
    }

    function getEmailByCode($code){
        $this->db->where('code', $code);
        $query = $this->db->get('couponcode');

        if($query->num_rows() == 1) {
            return $query->row(0)->Email;
        } else{
            return 0;
        }
    }

    function getEmail(){
        $this->db->where('code', '1014bf5fdeed47f0aaf20f29542c843d');
        $query = $this->db->get('couponcode');

        if($query->num_rows() == 1) {
            return $query->row(0)->Email;
        } else{
            return 0;
        }
    }

    function codesGenerated(){
		$query = $this->db->get('couponcode');
		return $query->result();
    }
	
    function getRedemptions(){
        $query = $this->db->query("SELECT couponcode.FacebookID, couponcode.Name, couponcode.Email, redemption.DateRedeemed
        FROM couponcode
        INNER JOIN redemption ON redemption.Code = couponcode.Code");
        return $query->result();
    }

	function getRedemptionsForWeek(){
		$query = $this->db->query("SELECT couponcode.FacebookID, couponcode.Name, couponcode.Email, redemption.DateRedeemed
        FROM couponcode
        INNER JOIN redemption ON redemption.Code = couponcode.Code
        WHERE redemption.DateRedeemed > DATE_SUB( CURDATE( ) , INTERVAL 1 WEEK ) ");
        return $query->result();
	}
	
	function notRedeemedForWeek(){
		$query = $this->db->query("SELECT couponcode.FacebookID, couponcode.Name, couponcode.Email, redemption.DateRedeemed
        FROM couponcode
        INNER JOIN redemption ON redemption.Code <> couponcode.Code
        WHERE redemption.DateRedeemed > DATE_SUB( CURDATE( ) , INTERVAL 1 WEEK ) ");
        return $query->result();
	}
}	