<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Images\Controller\Images' => 'Images\Controller\ImagesController',
            
         ),
     ),

     // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'images' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/images[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Images\Controller\Images',
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
						'images' => __DIR__ . '/../view' 
				)
				 
		),
 );
?>