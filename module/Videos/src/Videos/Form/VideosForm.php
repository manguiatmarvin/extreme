<?php 
namespace Videos\Form;
use Zend\Form\Form;

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
				'name' => 'embed_code',
				'type' => 'TextArea',
				'options' => array(
						'label' => 'Embed Code',
				),
				'attributes' => array(
						'class'  => 'form-control',
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
		
		$this->add(array(
				'name' => 'submit',
				'type' => 'Submit',
				'attributes' => array(
						'value' => 'Go',
						'id' => 'submitbutton',
				),
		));
	}
	
	
	public function setOptionSelect($options){
		$this->optionSelect = $options;
	}
	
	public function getOptionSelect(){
		return $this->optionSelect;
	}
	
}