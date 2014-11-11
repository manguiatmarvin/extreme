<?php

namespace Videos\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Expression;

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
        
        if(!$row->publish){
        	throw new \Exception('Video is cunrrently not available at the moment');
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
	
	public function addVideoLikes($id){
		$rowSet = $this->tableGateway->select(array('id'=>$id));
		$row = $rowSet->current();
		if(!$row){
			throw new \Exception('Video id does not exist');
		}
		
		$tmp_likes  = (int) $row->likes + 1;
		
		$data = array(
			'likes'=>$tmp_likes
		);
	
		$this->tableGateway->update($data,array('id'=>$id));
		return $tmp_likes;
	}
	
	public function addVideoDislikes($id){
	$rowSet = $this->tableGateway->select(array('id'=>$id));
		$row = $rowSet->current();
		if(!$row){
			throw new \Exception('Video id does not exist');
		}
		
		$tmp_dislikes  =  (int) $row->dislikes + 1;
		
		$data = array(
			'dislikes'=>$tmp_dislikes
		);
	
		$this->tableGateway->update($data,array('id'=>$id));
		return $tmp_dislikes;	
	}
	
	public function getNewestVideos(){
		$select = new Select('video');
		$select->join('category',
		              'video.category_id = category.id',
		              array('cat_id'=>'id','cat_name'=>'category_name'),
		              Select::JOIN_LEFT );
		$select->where(array('publish'=>1));
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
	
	
	public function getTopRatedVideos(){
		$select = new Select('video');
		$select->columns(array('id', 
				               'title',
		                       'desc',
		                       'runtime',
		                       'embed_code',
		                       'video_src',
		                       'video_path',
		                       'thumbnail',
		                       'uploaded',
		                       'views',
		                       'likes',
		                        'dislikes',
		                       'rate'=>new Expression('(video.likes / ( video.dislikes + video.likes)) * 100')));
		$select->join('category',
				'video.category_id = category.id',
				array('cat_id'=>'id','cat_name'=>'category_name'),
				Select::JOIN_LEFT );
		
		$select->having('rate > 0');
		$select->where(array('publish'=>1));
		$select->order(array('rate'=>'desc',
		                     'views'=>'asc'));
	
	
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
		$select->join('category',
		              'video.category_id = category.id',
		              array('cat_id'=>'id','cat_name'=>'category_name'),
		              Select::JOIN_LEFT );
		$select->where(array('publish'=>1));
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
	
	public function getVideoCategories(){
		$select = new Select('video');
		$select->columns(array('thumbnail'));
		
		$select->join('category',
		              'video.category_id = category.id',
		              array('cat_id'=>'id',
		              		'category_name',
		              		'n_videos'=>new Expression('COUNT(video.category_id)')),
		              Select::JOIN_LEFT)->group('category.category_name');;
		
		
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
	
	public function getVideosByCategory($cat_id){
		//test if exist
		$rowSet = $this->tableGateway->select(array('category_id'=>$cat_id));
		$row = $rowSet->current();
        if(!$row){
        	throw new \Exception('Video category  id does not exist');
        }
		
			$select = new Select('video');
		$select->columns(array('id', 
				               'title',
		                       'desc',
		                       'runtime',
		                       'embed_code',
		                       'video_src',
		                       'video_path',
		                       'thumbnail',
		                       'uploaded',
		                       'views',
		                       'likes',
		                        'dislikes',
		                       'rate'=>new Expression('(video.likes / ( video.dislikes + video.likes)) * 100')));
		$select->join('category',
				'video.category_id = category.id',
				array('cat_id'=>'id','cat_name'=>'category_name'),
				Select::JOIN_LEFT );
		
		$select->where(array('category_id'=>$cat_id,'publish'=>1));
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
		$select->where(array('publish'=>1));
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