<?php 
namespace Videos;


use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
// Add these import statements:
use Videos\Model\Videos;
use Videos\Model\VideosTable;
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
				),
		);
	}
}
?>