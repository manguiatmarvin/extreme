<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Admin\Controller\Admin' => 'Admin\Controller\AdminController',
            
         ),
     ),

     // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'admin' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/admin[/][:action][/:id][/page/:page]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     	 'page' => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Admin\Controller\Admin',
                         'action'     => 'index',
                     ),
                 ),
             ),	
  
         ),
     ),
		'view_manager' => array (
				'template_map' => array (
						'layout/menu'  => __DIR__ . '/../view/layout/menu.phtml',
				),
				'template_path_stack' => array (
						'admin' => __DIR__ . '/../view' 
				)
				 
		),
 );
?>