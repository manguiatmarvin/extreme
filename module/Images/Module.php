<?php 
namespace Images;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Images\Model\Images;
use Images\Model\ImagesTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;


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
						'Images\Model\ImagesTable' =>  function($sm) {
							$tableGateway = $sm->get('ImagesTableGateway');
							$table = new ImagesTable($tableGateway);
							return $table;
						},
						'ImagesTableGateway' => function ($sm) {
							$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype(new Images());
							return new TableGateway('images', $dbAdapter, null, $resultSetPrototype);
						},
				),
		);
	}
	
	

	
}
?>