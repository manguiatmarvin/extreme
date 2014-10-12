<?php
namespace Videos\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;



class VideosController extends AbstractActionController {
	protected $videosTable;
	
	public function indexAction() {
     return new ViewModel();
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