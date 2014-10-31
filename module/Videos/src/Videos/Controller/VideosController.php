<?php
namespace Videos\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use MarvinFileUploadUtils\FileUploadUtils;
use Zend\View\Model\JsonModel;


class VideosController extends AbstractActionController {
	protected $videosTable;
	
	public function indexAction() {
     return new ViewModel(array('videos'=>$this->getVideosTable()->getNewestVideos(),));
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
			return $this->redirect()->toRoute('videos');
		}
		
		return new ViewModel(array('playVideo'=>$videoToplay,
		                           'relatedVideos'=>$relatedVideos));
	}
	
	
    public function getVideoJsonAction(){
    	
    	$id = (int) $this->params()->fromRoute('id', 0);
    	if (!$id) {
    		return new JsonModel(array('result'=>'failed'));
    	}
    	
    	// Get the Album with the specified id.  An exception is thrown
    	// if it cannot be found, in which case go to the index page.
    	try {
    		$videoToplay = $this->getVideosTable()->getVideoSigle($id);
    	
    	}
    	catch (\Exception $ex) {
    		//change this to 404
    		return new JsonModel(array('result'=>'failed'));
    	}
    	
    	$result = new JsonModel(array('result'=>'success',
    	                              'video_path'=>$videoToplay->video_path));
    	
    	
     return $result;
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