<?php 
namespace Videos\Form;
use Zend\Form\Form;
use Zend\InputFilter;

class VideosForm extends Form{
	protected $optionSelect;
	
	public function __construct($name = null)
	{
		parent::__construct('video');
	}
	
	public function initialize(){	
		
		$this->add(array(
				'name' => 'id',
				'type' => 'Hidden',
		));
		
		$this->add(array(
				'name' => 'title',
				'type' => 'Text',
				'options' => array(
						'label' => 'Title',
				),
				'attributes' => array(
						'class'  => 'form-control',
						'placeholder'=>'Enter title ...',
				),
		));
		
		$this->add(array(
				'name' => 'desc',
				'type' => 'TextArea',
				'options' => array(
						'label' => 'Desc',
				),
				'attributes' => array(
						'class'  => 'form-control',
						'placeholder'=>'Enter Desc ...',
				),
		));
		
		$this->add(array(
				'name'    => 'category_id',
				'type'    => 'Zend\Form\Element\Select',
				'options' => array(
						'label'         => 'Category',
						'value_options' => $this->getOptionSelect(),
						'empty_option'  => '--select--'
				),
				'attributes' => array(
						'class'  => 'form-control',
				),
		
		));
		
		$this->add(array(
				'name' => 'runtime',
				'type' => 'Text',
				'options' => array(
						'label' => 'Runtime',
				),
				'attributes' => array(
						'class'  => 'form-control',
						'placeholder'=>'Enter runtime',
				),
		));
	
		$this->add(array(
				'name' => 'views',
				'type' => 'Text',
				'options' => array(
						'label' => 'views',
				),
				'attributes' => array(
						'class'  => 'form-control',
						'placeholder'=>'Enter runtime',
				),
		));

		
		$this->add(array(
				'name' => 'video_src',
				'type' => 'Text',
				'options' => array(
						'label' => 'Embed src',
				),
				'attributes' => array(
						'class'  => 'form-control',
						'placeholder'=>'Enter runtime',
				),
		));
		
		
		$this->add(array(
				'name' => 'video_path',
				'type' => 'Text',
				'options' => array(
						'label' => 'path',
				),
				'attributes' => array(
						'class'  => 'form-control',
						'placeholder'=>'Enter runtime',
				),
		));
		
		
		$this->add(array(
				'name' => 'publish',
				'type' => 'Checkbox',
				'options' => array(
						'label' => 'live',
				),
				'attributes' => array(
						'class'  => 'form-control',
						'placeholder'=>'Enter runtime',
				),
		));
		
		

		$this->add ( array (
				'name' => 'video-file',
				'type' => 'File',
				'options' => array (
						'label' => 'Video File'
				),
				'attributes' => array (
						'class' => 'form-control'
				)
		) );
		
		
		$this->add(array(
				'name' => 'submit',
				'type' => 'Submit',
				'attributes' => array(
						'value' => 'Go',
						'id' => 'submitbutton',
						'class'  => 'form-control',
				),
		));
		
		$this->addInputFilter();
	}
	
	
	
	public function addInputFilter()
	{
		$inputFilter = new InputFilter\InputFilter();
	
		// File Input
		$fileInput = new InputFilter\FileInput('video-file');
		$fileInput->setRequired(false);
		$fileInput->getFilterChain()->attachByName(
				'filerenameupload',
				array(
						'target'    => './data/uploads/avatar.mp4',
						'randomize' => true,
				)
		);
		$inputFilter->add($fileInput);
		
		
		
		
	
		$this->setInputFilter($inputFilter);
	}
	
	
	public function setOptionSelect($options){
		$this->optionSelect = $options;
	}
	
	public function getOptionSelect(){
		return $this->optionSelect;
	}
	
}