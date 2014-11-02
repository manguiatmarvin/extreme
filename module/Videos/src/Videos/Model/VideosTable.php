<?php

namespace Videos\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
use Zend\Filter\DateTimeFormatter;

class VideosTable {
	protected $tableGateway;
	protected $videoId;
    protected $videoPlaceHolder;
    
	
	public function __construct(TableGateway $tableGateway) {
		$this->tableGateway = $tableGateway;
	}
	
	public function getTableGateway() {
		return $this->tableGateway;
	}
	
	public function setTablegateway(TableGateway $tableGateway) {
		if (null == $this->tableGateway) {
			$this->tableGateway = $tableGateway;
		}
	}
	
	
	public function getVideoSigle($id){
		
		$rowSet = $this->tableGateway->select(array('id'=>$id));
		$row = $rowSet->current();
        if(!$row){
        	throw new \Exception('Video id does not exist');
        }
        return $row;
	}
	
	public function UpdateVideoViews($id,$currentViews){
		if($currentViews=="" && $currentViews=null && $currentViews){
			$currentViews = 0;
		}
		$data = array('views'=>$currentViews+1);
		$this->tableGateway->update($data,array('id'=>$id));
		
	}
	
	public function getNewestVideos(){
		$select = new Select('video');
		$select->order(array('uploaded'=>'ACS'));
		
		$paginatorAdapter = new DbSelect(
				// our configured select object
				$select,
				// the adapter to run it against
				$this->tableGateway->getAdapter(),
				// the result set to hydrate
				new ResultSet()
		);
		$paginator = new Paginator($paginatorAdapter);
		return $paginator;
	}
	
	

	public function getMostViewedVideos(){
		$select = new Select('video');
		$select->order(array('views'=>'desc'));
	
		$paginatorAdapter = new DbSelect(
				// our configured select object
				$select,
				// the adapter to run it against
				$this->tableGateway->getAdapter(),
				// the result set to hydrate
				new ResultSet()
		);
		$paginator = new Paginator($paginatorAdapter);
		return $paginator;
	}
	
	public function getRelatedVideos($videoTitle){
		$videoTitle = '%'.$videoTitle.'%';
		$select = new Select('video');
		$select->where->like('title',$videoTitle);
		$select->order(array('uploaded'=>'ACS'));
	
	
		$paginatorAdapter = new DbSelect(
				// our configured select object
				$select,
				// the adapter to run it against
				$this->tableGateway->getAdapter(),
				// the result set to hydrate
				new ResultSet()
		);
		$paginator = new Paginator($paginatorAdapter);
		return $paginator;
	}
	

}