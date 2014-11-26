<?php
namespace Videos\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use MarvinFileUploadUtils\FileUploadUtils;
use Zend\View\Model\JsonModel;

class VideosController extends AbstractActionController {
	protected $videosTable;
	
	public function indexAction() {
     $videosPaginator = $this->getVideosTable()->getNewestVideos();
     // set the current page to what has been passed in query string, or to 1 if none set
     $videosPaginator->setCurrentPageNumber($this->params()->fromRoute('page', 0));
     // set the number of items per page to 10
     $videosPaginator->setItemCountPerPage(15);
     
     return new ViewModel(array('videos'=>$videosPaginator,));
	}

	public function playAction(){
		
		$id = (int) $this->params()->fromRoute('id', 0);
		if (!$id) {
			return $this->redirect()->toRoute('videos');
		}
		
		// Get the Album with the specified id.  An exception is thrown
		// if it cannot be found, in which case go to the index page.
		try {
			$videoToplay = $this->getVideosTable()->getVideoSigle($id);
			$relatedVideos = $this->getVideosTable()->getRelatedVideos($videoToplay->title);
			$this->getVideosTable()->UpdateVideoViews($videoToplay->id,$videoToplay->views);
			
		}
		catch (\Exception $ex) {
			//change this to 404
			$this->flashmessenger()->addErrorMessage($ex->getMessage());
			return $this->redirect()->toRoute('videos');
		}
		
		return new ViewModel(array('playVideo'=>$videoToplay,
		                           'relatedVideos'=>$relatedVideos));
	}
	
	
	 public function VideosByCategoryAction(){

	 	$id = (int) $this->params()->fromRoute('id', 0);
	 	if (!$id) {
	 		return $this->redirect()->toRoute('video-categories');
	 	}
	 	
	 	// Get the Album with the specified id.  An exception is thrown
	 	// if it cannot be found, in which case go to the index page.
	 	try {
	 		
	 		$videos = $this->getVideosTable()->getVideosByCategory($id);
	 	}
	 	catch (\Exception $ex) {
	 		//change this to 404
	 		return $this->redirect()->toRoute('video-categories');
	 	}
	 	
	 	return new ViewModel(array('videos'=>$videos));
	}
	
	/**
	 * Display Top rated Videos
	 */
	public function TopRatedVideosAction(){

		return new ViewModel(array('videos'=>$this->getVideosTable()->getTopRatedVideos()));
	}
	
    public function getVideoJsonAction(){
    	
    	$id = (int) $this->params()->fromRoute('id', 0);
    	if (!$id) {
    		return new JsonModel(array('result'=>'failed'));
    	}
    	
    	// Get the Album with the specified id.  An exception is thrown
    	// if it cannot be found, in which case go to the index page.
    	try {
    		$videoToplay = $this->getVideosTable()->getVideoSigle($id,true);
    	
    	}
    	catch (\Exception $ex) {
    		//change this to 404
    		return new JsonModel(array('result'=>'failed'));
    	}
    	
    	$result = new JsonModel(array('result'=>'success',
    	                              'video_path'=>$videoToplay->video_path));
    	
    	
     return $result;
    }
    
    
    public function AddVideoLikesJsonAction(){

    	$request = $this->getRequest();
    	if($request->isPost()){
    		$video_id = $request->getPost('video_id');
    		try {
    			$video = $this->getVideosTable()->getVideoSigle($video_id);
    			$addLikeRes = $this->getVideosTable()->addVideoLikes($video->id);
    		}
    		catch (\Exception $ex) {
    			//change this to 404
    			return new JsonModel(array('result'=>'failed'));
    		}
    		return  new JsonModel(array('result'=>$addLikeRes));
    	}
    	
    	return new JsonModel(array('result'=>'failed'));
    }
    
    
    public function AddVideoDislikesJsonAction(){$request = $this->getRequest();
    	if($request->isPost()){
    		$video_id = $request->getPost('video_id');
    		try {
    			$video = $this->getVideosTable()->getVideoSigle($video_id);
    			$addDislikeRes = $this->getVideosTable()->addVideoDislikes($video->id);
    		}
    		catch (\Exception $ex) {
    			//change this to 404
    			return new JsonModel(array('result'=>'failed'));
    		}
    		return  new JsonModel(array('result'=>$addDislikeRes));
    	}
    	
    	return new JsonModel(array('result'=>'failed'));
    }
    
    
    public function MostViewedVideosAction(){
    	    return new ViewModel(array('videos'=>$this->getVideosTable()->getMostViewedVideos(),));
    }
    
    public function VideoCategoriesAction(){
  
    	return new ViewModel(array('categories'=>$this->getVideosTable()->getVideoCategories()));
    }
	
	public function latestAction(){
		return new ViewModel();
	}
	
	
	public function getVideosTable(){
	
		if (!$this->videosTable) {
			$sm = $this->getServiceLocator();
			$this->videosTable = $sm->get('Videos\Model\VideosTable');
		}
		return $this->videosTable;
	}
	
}
?>