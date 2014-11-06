<?php 
namespace Videos\Form;
use Zend\Form\Form;

class VideosForm extends Form{
	public function __construct($name = null)
	{
		parent::__construct('album');
		
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
		));
		$this->add(array(
				'name' => 'embed_code',
				'type' => 'Text',
				'options' => array(
						'label' => 'Embed Code',
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
	
}