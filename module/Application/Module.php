<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
use Zend\Permissions\Acl\Acl;

class Module{
	
    public function onBootstrap(MvcEvent $e)
    {
    	$application         = $e->getApplication();
        $eventManager        = $application->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $this -> initAcl($e);
        $e -> getApplication() -> getEventManager() -> attach('route', array($this, 'checkAcl'));
    }

    
    
    public function initAcl(MvcEvent $e) {
    
    	$acl = new \Zend\Permissions\Acl\Acl();
    	$roles = include __DIR__ . '/config/module.acl.roles.php';
    	
    
    	
    	$allResources = array();
    	foreach ($roles as $role => $resources) {
    
    		$role = new \Zend\Permissions\Acl\Role\GenericRole($role);
    		$acl -> addRole($role);
    
    		$allResources = array_merge($resources, $allResources);
    
    		//adding resources
    		foreach ($resources as $resource) {
    			// Edit 4
    			if(!$acl ->hasResource($resource))
    				$acl -> addResource(new \Zend\Permissions\Acl\Resource\GenericResource($resource));
    		}
    		//adding restrictions
    		foreach ($resources as $resource) {
    			$acl -> allow($role, $resource);
    		}
    	}
    	//testing
    	//var_dump($acl->isAllowed('admin','home'));
    	//true
    
    	//setting to view
    	$e -> getViewModel() -> acl = $acl;
    
    }
    
    
    public function checkAcl(MvcEvent $e) {
    	$route = $e -> getRouteMatch() -> getMatchedRouteName();
    	
    	$auth = $e->getApplication()->getServiceManager()->get('AuthService')->getStorage ()->read ();
    	$e -> getViewModel() -> auth = $auth;
    	$e->getViewModel()->route = $route;
    	
    	if($auth==null){
    		$userRole = 'guest';
    	}else if($auth!=null){
    		$userRole  = $auth->role;
    		
    	}else{
    		$userRole = 'guest';
    	}
    	
    
    	if (!$e -> getViewModel() -> acl -> isAllowed($userRole, $route)) {
    		$response = $e -> getResponse();
    		//location to page or what ever
    		$response -> getHeaders() -> addHeaderLine('Location', $e -> getRequest() -> getBaseUrl() . '/404');
    		$response -> setStatusCode(404);
    
    	}
    }
    
    public function getConfig(){
        return include __DIR__ . '/config/module.config.php';
    }
    
    
    public function getServiceConfig() {
    	return array (
    
    			'factories' => array (
    
    					'SanAuth\Model\MyAuthStorage' => function ($sm) {
    						return new \SanAuth\Model\MyAuthStorage ( 'sms_storage' );
    					},
    					'AuthService' => function ($sm) {
    						$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
    						// I'm going to change the password encryption from Md5 to  BCrypt
    						//$dbTableAuthAdapter = new DbTableAuthAdapter ( $dbAdapter, 'users', 'user_name', 'pass_word', 'MD5(?)' );
    					
    						//     						if ($bcrypt->verify("iloveyou","\$2y\$10\$yRz2geYWuRg4bgK5v5pN3O89PVOpQa0sk7uGMBzD3n7sEVuy5GmCa")) {
    						//     							echo "The password is correct! \n";
    						//     						} else {
    						//     							echo "The password is NOT correct.\n";
    						//     						}
    					
    						$dbTableAuthAdapter = new DbTableAuthAdapter ( $dbAdapter, 'users', 'user_name', 'pass_word', '' );
    									
    								$authService = new AuthenticationService ();
    						$authService->setAdapter ( $dbTableAuthAdapter );
    						$authService->setStorage ( $sm->get('SanAuth\Model\MyAuthStorage'));
    					
    						return $authService;
    					},
    			),
    	);
    }

    public function getAutoloaderConfig(){
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                 'MarvinFileUploadUtils' => __DIR__ . '/../../vendor/MarvinFileUploadUtils',
                ),
            ),
        );
    }
}
