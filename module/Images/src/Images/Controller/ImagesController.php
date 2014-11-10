<?php
namespace Images\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;



class ImagesController extends AbstractActionController {
	protected $imagesTable;
	
	
	public function indexAction() {
		return new ViewModel ();
	}

	
	public function MostViewedImagesAction(){
		return new ViewModel();
	}
	

	
	public function getImagesTable(){
	
		if (!$this->imagesTable) {
			$sm = $this->getServiceLocator();
			$this->imagesTable = $sm->get('Images\Model\ImagesTable');
		}
		return $this->imagesTable;
	}
	
}
?>