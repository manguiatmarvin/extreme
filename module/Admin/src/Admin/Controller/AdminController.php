<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Videos\Module;
use Videos\Form;
use Videos\Controller\VideosController;


class AdminController extends AbstractActionController {
	protected $videosTable;
	
	public function indexAction() {
		
	}
	
	public function ManageVideosAction() {
		
	  return new ViewModel(array('videos'=>$this->getVideosTable()->getAllVideos(),));
	}
	
	public function ManageAlbumAction() {
		return new ViewModel ();
	}
	
	public function ManageUsersAction() {
		return new ViewModel ();
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