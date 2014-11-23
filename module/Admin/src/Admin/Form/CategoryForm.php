<?php 
namespace Admin\Form;
use Zend\Form\Form;
use Zend\InputFilter;

class CategoryForm extends Form{
	
	
	public function __construct($name = null)
	{
		// we want to ignore the name passed
		parent::__construct('category');
	
		$this->add(array(
				'name' => 'id',
				'type' => 'Hidden',
		));
		
		$this->add(array(
				'name' => 'category_name',
				'type' => 'Text',
				'options' => array(
						'label' => 'Category Name',
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