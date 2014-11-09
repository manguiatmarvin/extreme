<?php
namespace SanAuth\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class SanAuth implements InputFilterAwareInterface
{
	public $id;
	public $users_id;
	public $username;

	private $inputFilter;
	

	public function exchangeArray($data)
	{
		$this->id     = (!empty($data['id'])) ? $data['id'] : null;
		$this->users_id = (!empty($data['users_id'])) ? $data['users_id'] : null;
		$this->username  = (!empty($data['username'])) ? $data['username'] : null;
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