<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Videos\Module;
use Videos\Form;


class AdminController extends AbstractActionController {
	
	public function indexAction() {
		return new ViewModel ();
	}
	
	public function ManageVideosAction() {
		return new ViewModel ();
	}
	
	public function ManageAlbumAction() {
		return new ViewModel ();
	}
	
	public function ManageUsersAction() {
		return new ViewModel ();
	}
	
	
}
?>