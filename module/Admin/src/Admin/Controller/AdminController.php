<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Videos\Module;
use Videos\Form\VideosForm;
use Videos\Controller\VideosController;


class AdminController extends AbstractActionController {
	protected $videosTable;
	
	public function indexAction() {
		
	}
	
	public function ManageVideosAction() {
		
	  return new ViewModel(array('videos'=>$this->getVideosTable()->getAllVideos(),));
	}
	
	public function AdminEditVideoAction(){
		$id = (int) $this->params()->fromRoute('id', 0);
		if (!$id) {
			return $this->redirect()->toRoute('admin', array(
					'action' => 'manage-videos'
			));
			
		}
		
		try {
			$video = $this->getVideosTable()->getVideoSigle($id,true);
	        $videos = $this->getVideosTable()->getAllVideos();
		}
		catch (\Exception $ex) {
			$this->flashmessenger()->addErrorMessage("".$ex->getMessage());
			return $this->redirect()->toRoute('admin', array(
					'action' => 'manage-videos'
			));
		}
		$form  = new VideosForm();
		$form->setOptionSelect($this->getVideosTable()->getCategoryArray());
		$form->initialize();
		$form->bind($video);
		$form->get('submit')->setAttribute('value', 'Edit');
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$form->setInputFilter($video->getInputFilter());
			$postData = $request->getPost();
			$form->setData($postData);
			if ($form->isValid()) {
				$this->getVideosTable()->saveVideo($video);
				$this->flashmessenger()->addErrorMessage("Video Updated Successfully!");
				return $this->redirect()->toRoute('admin', array('action'=>'admin-edit-video','id'=>$id));
			
			}else{
				//TODO: remove this else statement 
				$this->flashmessenger()->addErrorMessage("Form is invalid");
				return $this->redirect()->toRoute('admin', array('action'=>'admin-edit-video','id'=>$id));
			}
		}
		
		return array(
				'id' => $id,
				'editVideoForm' => $form,
				'video'=>$video,
				'videos'=>$videos
		);
		
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