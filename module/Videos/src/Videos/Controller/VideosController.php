<?php
namespace Videos\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use MarvinFileUploadUtils\FileUploadUtils;



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
			//$this->getVideosTable()->UpdateVideoViews($videoToplay->id,$videoToplay->views);
			//TODO: get related videos using $videoToplay->title as search key;
		
		}
		catch (\Exception $ex) {
			//change this to 404
			return $this->redirect()->toRoute('videos');
		}
		
		return new ViewModel(array('playVideo'=>$videoToplay));
	}
	
	public function streamVideoAction(){
		$id = (int) $this->params()->fromRoute('id', 0);
		if (!$id) {
			return $this->redirect()->toRoute('videos');
		}
		
		try {
			$videoToplay = $this->getVideosTable()->getVideoSigle($id);
			$this->getVideosTable()->UpdateVideoViews($videoToplay->id,$videoToplay->views);
			//TODO: get related videos using $videoToplay->title as search key;
		
		}
		catch (\Exception $ex) {
			//change this to 404 or redirect to page that has so many ads
			//return 	$response->setStatusCode(404);
			return $this->redirect()->toRoute('videos');
		}
		
		$path = ROOT_PATH.'/data'.$videoToplay->file_path;
		return $this->streamFile($path);
	}
	
	
	private  function streamFile($fileName) {
		$fileUtils = new FileUploadUtils($fileName);
	
		$response = new \Zend\Http\Response\Stream();
		$response->setStream(fopen($fileName, 'r'));
	
		if(!is_file($fileName)){
			return 	$response->setStatusCode(404);
		}
		$outFile = uniqid();
	
		$response->setStatusCode(200);
		$headers = new \Zend\Http\Headers();
		$headers->addHeaderLine('Content-Type',$fileUtils->file_src_mime)
		->addHeaderLine('Content-Disposition', 'inline; filename="' . $outFile . '"') // use inline or attachemt 
		->addHeaderLine('Content-Length', filesize($fileName));
	
		$response->setHeaders($headers);
		return $response;
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