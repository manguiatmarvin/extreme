<?php
namespace Admin\Model;

// Add these import statements
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class Admin implements InputFilterAwareInterface
{
	public $id;

	
	//input filter
	private $inputFilter;
	

	public function exchangeArray($data)
	{
		$this->id     = (!empty($data['id'])) ? $data['id'] : null;

	}
	
	
	// Add the following method:
	public function getArrayCopy()
	{
		return get_object_vars($this);
	}
	
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Not used");
	}
	
	public function getInputFilter(){
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();
	
			$inputFilter->add(array(
					'name'     => 'id',
					'required' => true,
					'filters'  => array(
							array('name' => 'Int'),
					),
			));


	
			$this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}
	
	
}