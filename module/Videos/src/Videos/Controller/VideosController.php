<?php
namespace Videos\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;



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
			//TODO: get related videos using $videoToplay->title as search key;
		
		}
		catch (\Exception $ex) {
			//change this to 404
			return $this->redirect()->toRoute('videos');
		}
		
		return new ViewModel(array('playVideo'=>$videoToplay));
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