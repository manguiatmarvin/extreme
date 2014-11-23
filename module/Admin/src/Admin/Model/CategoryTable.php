<?php

namespace Admin\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
use Zend\Filter\DateTimeFormatter;

class CategoryTable {
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway) {
		$this->tableGateway = $tableGateway;
	}
	
	public function getTableGateway() {
		return $this->tableGateway;
	}
	public function setTablegateway(TableGateway $tableGateway) {
		if (null == $this->tableGateway) {
			$this->tableGateway = $tableGateway;
		}
	}
	
	public function sayHello(){
		
		return "Hi Hello!";
	}
	
	
	public function getAllCategory(){
		$select = new Select('category');
		
		$paginatorAdapter = new DbSelect(
				// our configured select object
				$select,
				// the adapter to run it against
				$this->tableGateway->getAdapter(),
				// the result set to hydrate
				new ResultSet()
		);
		$paginator = new Paginator($paginatorAdapter);
		return $paginator;
	}
	
	public function saveCategory(Category $category){
		
		$data = array(
				'category_name'  => $category->category_name,
		);
		
		$id = (int) $category->id;
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getCategory($id)) {
				$this->tableGateway->update($data, array('id' => $id));
			} else {
				throw new \Exception('Category id does not exist');
			}
		}
		
	}
	
	
	public function getCategory($id){
		$id  = (int) $id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}

}