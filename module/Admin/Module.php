<?php 
namespace Admin;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Videos\Model\Videos;
use Videos\Model\VideosTable;
use Admin\Model\CategoryTable;
use Admin\Model\Category;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
	public function getAutoloaderConfig()
	{
		return array(
				'Zend\Loader\ClassMapAutoloader' => array(
						__DIR__ . '/autoload_classmap.php',
				),
				'Zend\Loader\StandardAutoloader' => array(
						'namespaces' => array(
								__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
						),
				),
		);
	}

	public function getConfig()
	{
		return include __DIR__ . '/config/module.config.php';
	}
	
	public function getServiceConfig(){
				return array(
				'factories' => array(
						'Videos\Model\VideosTable' =>  function($sm) {
							$tableGateway = $sm->get('VideosTableGateway');
							$table = new VideosTable($tableGateway);
							return $table;
						},
						'VideosTableGateway' => function ($sm) {
							$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype(new Videos());
							return new TableGateway('video', $dbAdapter, null, $resultSetPrototype);
						},
						'Admin\Model\CategoryTable' =>  function($sm) {
							$tableGateway = $sm->get('CategoryTableGateway');
							$table = new CategoryTable($tableGateway);
							return $table;
						},
							
						'CategoryTableGateway' => function ($sm) {
							$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype(new Category());
							return new TableGateway('category', $dbAdapter, null, $resultSetPrototype);
						},
				),
		);
	}
	
	

	
}
?>