<?php
namespace Videos\Model;

// Add these import statements
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class Videos implements InputFilterAwareInterface
{
	public $id;
	public $title;
	public $desc;
	public $runtime;
	public $embed_code;
	public $video_src;
	public $thumbnail;
	public $uploaded;
	public $modified;
	public $views;
	public $category;
	public $video_path;
	
	
	//input filter
	private $inputFilter;
	

	public function exchangeArray($data)
	{
		$this->id     = (!empty($data['id'])) ? $data['id'] : null;
		$this->title = (!empty($data['title'])) ? $data['title'] : null;
		$this->desc = (!empty($data['desc'])) ? $data['desc'] : null;
		$this->runtime = (!empty($data['runtime'])) ? $data['runtime'] : null;
		$this->embed_code = (!empty($data['embed_code'])) ? $data['embed_code'] : null;
		$this->video_src = (!empty($data['video_src'])) ? $data['video_src'] : null;
		$this->thumbnail = (!empty($data['thumbnail'])) ? $data['thumbnail'] : null;
		$this->uploaded = (!empty($data['uploaded'])) ? $data['uploaded'] : null;
		$this->modified = (!empty($data['modified'])) ? $data['modified'] : null;
		$this->views = (!empty($data['views'])) ? $data['views'] : null;
		$this->category = (!empty($data['category'])) ? $data['category'] : null;
		$this->video_path = (!empty($data['video_path'])) ? $data['video_path'] : null;
		
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
	
	public function getInputFilter()
	{
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();
	
			$inputFilter->add(array(
					'name'     => 'id',
					'required' => true,
					'filters'  => array(
							array('name' => 'Int'),
					),
			));

	
			$inputFilter->add(array(
					'name'     => 'title',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 1,
											'max'      => 75,
									),
							),
					),
			));
			
			$inputFilter->add(array(
					'name'     => 'desc',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 1,
											'max'      => 75,
									),
							),
					),
			));
			
			
			$inputFilter->add(array(
					'name'     => 'runtime',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 1,
											'max'      => 75,
									),
							),
					),
			));
			
			
			$inputFilter->add(array(
					'name'     => 'embed_code',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 1,
											'max'      => 10,
									),
							),
					),
			));
			
			
			$inputFilter->add(array(
					'name'     => 'thumbnail',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 1,
											'max'      => 10,
									),
							),
					),
			));


	
			$this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}
	
	
}