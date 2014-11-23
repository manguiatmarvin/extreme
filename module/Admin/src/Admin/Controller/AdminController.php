<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Videos\Module;
use Videos\Form\VideosForm;
use Videos\Controller\VideosController;
use Videos\Model\Videos;
use Admin\Form\CategoryForm;
use Admin\Model\Category;

class AdminController extends AbstractActionController {
	protected $videosTable;
	protected  $categoryTable;
	
	public function indexAction() {
		
	}
	
	public function ManageVideoCategoryAction(){
		
		try{
			$category = $this->getCategoryTable()->getAllCategory();
			
		}catch (\Exception $ex) {
			$this->flashmessenger()->addErrorMessage("".$ex->getMessage());
			return $this->redirect()->toRoute('admin', array(
					'action' => 'manage-video-category'
			));
		}
	
		
		$form = new CategoryForm();
		$form->get('submit')->setValue('Add');
		$form->get('id')->setValue(0);
		
		$request = $this->getRequest();
		if ($request->isPost()) {		
			$category = new Category();
			$form->setInputFilter($category->getInputFilter());
			$form->setData($request->getPost());
		
			if ($form->isValid()) {
				$category->exchangeArray($form->getData());
				$this->getCategoryTable()->saveCategory($category);
				return $this->redirect()->toRoute('admin',array('action'=>'manage-video-category'));
				
			}else{
				echo "Form inValid";
				exit;
			}
		}
		
		
		return new ViewModel(array('addVideoCategoryForm'=>$form,
				                   'categories'=>$category));
	}
	
	
	public function EditVideoCategoryAction(){
		$id = (int) $this->params()->fromRoute('id', 0);
		if (!$id) {
			return $this->redirect()->toRoute('admin', array(
					'action' => 'manage-video-category'
			));
		}
		
		try {
			$category = $this->getCategoryTable()->getCategory($id);
			$categoryList = $this->getCategoryTable()->getAllCategory();
		}
		catch (\Exception $ex) {
			return $this->redirect()->toRoute('admin', array(
					'action' => 'manage-video-category'
			));
		}
		
		$form  = new CategoryForm();
		$form->bind($category);
		$form->get('submit')->setAttribute('value', 'Edit');
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$form->setInputFilter($category->getInputFilter());
			$form->setData($request->getPost());
		
			if ($form->isValid()) {
		        $this->getCategoryTable()->saveCategory($category);
				return $this->redirect()->toRoute('admin', array('action'=>'manage-video-category'
				                                                  ));
				exit;
				
			}else{
				echo "Form is invalid";
				exit;
			}
		}
		
		return array(
				'id' => $id,
				'editCategoryForm' => $form,
				'categoryList' => $categoryList,
		);
		
	
	}
	
	public function DeleteVideoCategoryAction(){

		return new ViewModel();
	}
	
	
	
	public function ManageVideosAction() {
		$form  = new VideosForm();
		$form->setOptionSelect($this->getVideosTable()->getCategoryArray());
		$form->initialize();
		$form->get('submit')->setAttribute('value', 'Add');
		$tempFile = null;
		
		$prg = $this->fileprg($form);
		if ($prg instanceof \Zend\Http\PhpEnvironment\Response) {
			return $prg; // Return PRG redirect response
		} elseif (is_array($prg)) {
			if ($form->isValid()) {
				$data = $form->getData();
				$video = new Videos();
				$video->title = $data["title"];
				$video->desc = $data["desc"];
				$video->video_path = $data["video-file"]["tmp_name"];
				$video->category_id = $data['category_id'];
				$video->thumbnail = $data["video-file"]["tmp_name"].".png";
				$this->getVideosTable()->saveVideo($video);
			  
				$this->flashmessenger()->addErrorMessage("Video added successfully");
				return $this->redirect()->toRoute('admin',array('action'=>'manage-videos'));
			} else {
				// Form not valid, but file uploads might be valid...
				// Get the temporary file information to show the user in the view
				$fileErrors = $form->get('video-file')->getMessages();
				if (empty($fileErrors)) {
					$tempFile = $form->get('video-file')->getValue();
				}
				
				$this->flashmessenger()->addErrorMessage("Invalid Form");
				return $this->redirect()->toRoute('admin',array('action'=>'manage-videos'));
			}
		}
	
		$videos = $this->getVideosTable()->getAllVideos();
		return new ViewModel(array('videos'=>$videos,
	                              'addVideoForm' => $form));
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
	
	public function getCategoryTable(){
	
		if (!$this->categoryTable) {
			$sm = $this->getServiceLocator();
			$this->categoryTable = $sm->get('Admin\Model\CategoryTable');
		}
		return $this->categoryTable;
	}
	
}
?>