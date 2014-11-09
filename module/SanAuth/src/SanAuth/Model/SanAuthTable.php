<?php
namespace SanAuth\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

 class SanAuthTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }
     
     public function getTableGateway(){
      return $this->tableGateway;
     }
     
     public function setTablegateway(TableGateway $tableGateway){
     	if(null == $this->tableGateway){
     		$this->tableGateway = $tableGateway;
     	}
     }

     public function getProfileInfoByUserName($username) {
     	// get DB adapter
     	$dbAdapter = $this->tableGateway->getAdapter ();
     	// custom query
     	$sql = "SELECT  users.user_name,
     	users.role,
     	user_profile.id,
     	user_profile.users_id,
     	user_profile.firstname,
     	user_profile.lastname,
     	user_profile.middle,
     	user_profile.birthdate,
     	user_profile.gender_id,
     	user_profile.about,
     	user_profile.address,
     	user_profile.landline,
     	user_profile.cellphone,
     	DATE_FORMAT(user_profile.created,'%b %d, %Y') as created,
     	user_profile.profile_pic_url,
     	DATE_FORMAT(user_profile.last_modified,'%b %d, %Y @ %h:%i %p') as last_modified
     	FROM users LEFT JOIN user_profile
     	ON  users.id = user_profile.users_id
     	WHERE users.user_name =  '{$username}'";
     
     	$statement = $dbAdapter->query ( $sql );
     	$result = $statement->execute ();
     	return $result->current();
     }
    

     
     private function get_client_ip() {
    $ipaddress = '';
    
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

 }