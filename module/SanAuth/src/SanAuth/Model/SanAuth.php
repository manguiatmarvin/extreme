<?php
namespace SanAuth\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class SanAuth implements InputFilterAwareInterface
{
	public $id;
	public $users_id;
	public $user_name;
	public $role;
	public $email;

	private $inputFilter;
	

	public function exchangeArray($data)
	{
		$this->id     = (!empty($data['id'])) ? $data['id'] : null;
		$this->users_id = (!empty($data['users_id'])) ? $data['users_id'] : null;
		$this->user_name  = (!empty($data['user_name'])) ? $data['user_name'] : null;
		$this->email  = (!empty($data['email'])) ? $data['email'] : null;
		$this->role  = (!empty($data['role'])) ? $data['role'] : null;
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