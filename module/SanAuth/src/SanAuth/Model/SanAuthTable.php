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

     
     public function getUserFullDetails($username){
     	$rowSet = $this->tableGateway->select(array('user_name'=>$username));
     	$data = $rowSet->current();
     	if($data){
     	  return $data;
     	}
     	return null;
     }
     


 }